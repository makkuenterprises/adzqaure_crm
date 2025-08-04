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
        return redirect()->route('admin.view.lead.manager.list')
            ->with('error', 'Connection cancelled or an error occurred with Meta.');
    }

    try {
        // --- Steps 1, 2, 3: Exchange code for token and get IDs (This part is correct) ---
        $response = Http::get('https://graph.facebook.com/v20.0/oauth/access_token', [
            'client_id' => config('services.meta.app_id'),
            'client_secret' => config('services.meta.app_secret'),
            'redirect_uri' => route('meta.callback'),
            'code' => $request->input('code'),
        ]);
        $response->throw();
        $accessTokenData = $response->json();
        $userAccessToken = $accessTokenData['access_token'];

        $businessResponse = Http::get('https://graph.facebook.com/v20.0/me/businesses', ['access_token' => $userAccessToken]);
        $businessResponse->throw();
        $wabaId = $businessResponse->json()['data'][0]['id'];

        $phoneNumbersResponse = Http::get("https://graph.facebook.com/v20.0/{$wabaId}/phone_numbers", ['access_token' => $userAccessToken]);
        $phoneNumbersResponse->throw();
        $phoneNumberId = $phoneNumbersResponse->json()['data'][0]['id'];

        // --- Step 4: Save credentials and set the new active connection ---

        // Deactivate any other existing active connection.
        // The update() method on the Query Builder finds and saves in one step.
        // It does NOT require a ->save() call. This is the corrected line.
        Admin::where('is_whatsapp_active', true)->update(['is_whatsapp_active' => false]);

        // Now, get the current admin model instance to update it.
        $admin = auth()->guard('admin')->user();
        $admin->whatsapp_business_account_id = $wabaId;
        $admin->whatsapp_phone_number_id = $phoneNumberId;
        $admin->whatsapp_access_token = encrypt($userAccessToken);
        $admin->is_whatsapp_active = true;

        // Because $admin is an Eloquent Model INSTANCE, we use save() here.
        $admin->save();

        // Redirect back with a success message
        return redirect()->route('admin.view.lead.manager.list')
            ->with('success', 'Successfully connected to WhatsApp! This is now the active connection for the CRM.');

    } catch (\Exception $e) {
        Log::error('Meta Integration Failed: ' . $e->getMessage());
        return redirect()->route('admin.view.lead.manager.list')
            ->with('error', 'An unexpected error occurred while connecting your account. Please try again.');
    }
}
}
