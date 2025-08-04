<?php

namespace App\Http\Controllers;

use App\Models\Admin; // <-- IMPORTANT: Make sure it's using your Admin model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MetaIntegrationController extends Controller
{
    /**
     * Build the Meta authorization URL and redirect the user to it.
     */


    public function redirectToMeta()
    {

        // Fetch your App ID from the config/services.php file
        $appId = config('services.meta.app_id');

        // Generate the callback URL using the route name for reliability
        $redirectUri = route('meta.callback');

        // Define the permissions your app needs
        $permissions = [
            'whatsapp_business_management',
            'whatsapp_business_messaging',
            'business_management',
        ];

        $scope = implode(',', $permissions);

        // Construct the final login URL
        $loginUrl = "https://www.facebook.com/v20.0/dialog/oauth?client_id={$appId}&redirect_uri={$redirectUri}&scope={$scope}&response_type=code";

        // Send the user to the external URL
        return redirect()->away($loginUrl);
    }

    /**
     * Handle the callback from Meta after user authorization.
     */
    public function handleMetaCallback(Request $request)
{
   
    // First, check for errors.
    if ($request->has('error')) {
        Log::error('Meta Callback Error: ' . $request->input('error_description', 'User cancelled the request.'));
        return redirect()->route('admin.view.lead.manager.list')->with('error', 'Connection cancelled or an error occurred with Meta.');
    }

    try {
        // --- Step 1: Exchange code for token ---
        $response = Http::get('https://graph.facebook.com/v20.0/oauth/access_token', [
            'client_id' => config('services.meta.app_id'),
            'client_secret' => config('services.meta.app_secret'),
            'redirect_uri' => route('meta.callback'),
            'code' => $request->input('code'),
        ]);
        $response->throw();
        $userAccessToken = data_get($response->json(), 'access_token');
        if (!$userAccessToken) { throw new \Exception('Access Token was not found in the Meta response.'); }

        // --- Step 2: Get the User's primary Business ID ---
        $businessResponse = Http::get('https://graph.facebook.com/v20.0/me/businesses', ['access_token' => $userAccessToken]);
        $businessResponse->throw();
        $businessId = data_get($businessResponse->json(), 'data.0.id');
        if (!$businessId) { throw new \Exception('The primary Meta Business ID was not found.'); }

        // =========================================================================
        //  START: NEW CORRECTED LOGIC TO GET THE WABA ID
        // =========================================================================

        // --- Step 3: Use the Business ID to get the WhatsApp Business Account (WABA) ID ---
        $wabaResponse = Http::get("https://graph.facebook.com/v20.0/{$businessId}/whatsapp_business_accounts", [
            'access_token' => $userAccessToken
        ]);
        $wabaResponse->throw();
        $wabaId = data_get($wabaResponse->json(), 'data.0.id');
        if (!$wabaId) { throw new \Exception('The WhatsApp Business Account ID (WABA ID) linked to your business was not found.'); }

        // =========================================================================
        //  END: NEW CORRECTED LOGIC
        // =========================================================================

        // --- Step 4: Use the WABA ID to get the Phone Number ID ---
        $phoneNumbersResponse = Http::get("https://graph.facebook.com/v20.0/{$wabaId}/phone_numbers", [
            'access_token' => $userAccessToken
        ]);
        $phoneNumbersResponse->throw();
        $phoneNumberId = data_get($phoneNumbersResponse->json(), 'data.0.id');
        if (!$phoneNumberId) { throw new \Exception('Phone Number ID was not found for the connected WABA.'); }

        // --- Step 5: Save credentials and set active connection ---
        Admin::where('is_whatsapp_active', true)->update(['is_whatsapp_active' => false]);
        $admin = auth()->guard('admin')->user();
        $admin->whatsapp_business_account_id = $wabaId;
        $admin->whatsapp_phone_number_id = $phoneNumberId;
        $admin->whatsapp_access_token = encrypt($userAccessToken);
        $admin->is_whatsapp_active = true;
        $admin->save();

        return redirect()->route('admin.view.lead.manager.list')
            ->with('success', 'Successfully connected to WhatsApp! This is now the active connection for the CRM.');

    } catch (\Exception $e) {
        Log::error('Meta Integration Failed: ' . $e->getMessage());
        return redirect()->route('admin.view.lead.manager.list')
            ->with('error', 'An unexpected error occurred. Please check the system logs for details.');
    }
}
}
