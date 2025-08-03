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
        // First, check for errors. If the user clicked "Cancel", Meta sends an error.
        if ($request->has('error')) {
            Log::error('Meta Callback Error: ' . $request->input('error_description', 'User cancelled the request.'));
            return redirect()->route('admin.view.lead.manager.list') // Redirect back to the leads page
                ->with('error', 'Connection cancelled or an error occurred with Meta.');
        }

        // Use a try-catch block for robust error handling during the API calls
        try {
            // --- Step 1: Exchange the temporary code for a long-lived access token ---
            $response = Http::get('https://graph.facebook.com/v20.0/oauth/access_token', [
                'client_id' => config('services.meta.app_id'),
                'client_secret' => config('services.meta.app_secret'),
                'redirect_uri' => route('meta.callback'),
                'code' => $request->input('code'),
            ]);

            // If the request for the token fails, throw an exception
            $response->throw();

            $accessTokenData = $response->json();
            $userAccessToken = $accessTokenData['access_token'];

            // --- Step 2: Get the user's WhatsApp Business Account ID (WABA ID) ---
            $businessResponse = Http::get('https://graph.facebook.com/v20.0/me/businesses', [
                'access_token' => $userAccessToken,
            ]);
            $businessResponse->throw();
            // Assuming the user connects their first business account found
            $wabaId = $businessResponse->json()['data'][0]['id'];

            // --- Step 3: Get the Phone Number ID associated with that WABA ID ---
            $phoneNumbersResponse = Http::get("https://graph.facebook.com/v20.0/{$wabaId}/phone_numbers", [
                'fields' => 'id,display_phone_number', // Get ID and the number itself for logging/display
                'access_token' => $userAccessToken,
            ]);
            $phoneNumbersResponse->throw();
            // Assuming the first phone number found is the one to be used
            $phoneNumberId = $phoneNumbersResponse->json()['data'][0]['id'];

            // --- Step 4: Save the credentials securely to the logged-in admin's record ---
            $admin = auth()->guard('admin')->user();

            $admin->whatsapp_business_account_id = $wabaId;
            $admin->whatsapp_phone_number_id = $phoneNumberId;
            $admin->whatsapp_access_token = encrypt($userAccessToken); // <-- ALWAYS encrypt tokens before saving
            $admin->save();

            // Redirect back with a success message
            return redirect()->route('admin.view.lead.manager.list')
                ->with('success', 'Successfully connected to WhatsApp!');

        } catch (\Exception $e) {
            // Log the detailed error for debugging
            Log::error('Meta Integration Failed: ' . $e->getMessage());
            // Redirect back with a generic error message for the user
            return redirect()->route('admin.view.lead.manager.list')
                ->with('error', 'An unexpected error occurred while connecting your account. Please try again.');
        }
    }
}
