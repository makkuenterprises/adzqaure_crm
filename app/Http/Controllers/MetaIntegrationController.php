<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MetaIntegrationController extends Controller
{
    public function redirectToMeta()
    {
        $fb = new \Facebook\Facebook([
            'app_id' => config('services.meta.app_id'),
            'app_secret' => config('services.meta.app_secret'),
            'default_graph_version' => 'v20.0', // Use a current API version
        ]);

        $helper = $fb->getRedirectLoginHelper();

        // These are the permissions your app needs from the user
        $permissions = [
            'whatsapp_business_management',
            'whatsapp_business_messaging',
            'business_management' // To get business account details
        ];

        $loginUrl = $helper->getLoginUrl(config('services.meta.redirect_uri'), $permissions);

        // Redirect the user to Meta's authorization page
        return redirect()->away($loginUrl);
    }

    public function handleMetaCallback(Request $request)
{
    // Check if the user denied the request
    if ($request->has('error')) {
        return redirect('/')->with('error', 'The connection to Meta was cancelled.');
    }

    // --- Exchange Authorization Code for a User Access Token ---
    $response = Http::get('https://graph.facebook.com/v20.0/oauth/access_token', [
        'client_id' => config('services.meta.app_id'),
        'client_secret' => config('services.meta.app_secret'),
        'redirect_uri' => config('services.meta.redirect_uri'),
        'code' => $request->input('code'),
    ]);

    $accessTokenData = $response->json();
    $userAccessToken = $accessTokenData['access_token'];

    // --- Get the user's WhatsApp Business Account ID (WABA ID) ---
    $businessAccountResponse = Http::get('https://graph.facebook.com/v20.0/me/businesses', [
        'access_token' => $userAccessToken,
    ]);

    // Assuming the user has only one business account, get the first one
    $wabaId = $businessAccountResponse->json()['data'][0]['id'];

    // --- Get Phone Number IDs associated with the WABA ID ---
    $phoneNumbersResponse = Http::get("https://graph.facebook.com/v20.0/{$wabaId}/phone_numbers", [
        'access_token' => $userAccessToken,
    ]);

    $phoneNumbers = $phoneNumbersResponse->json()['data'];

    // For this example, let's just get the first phone number ID.
    // In a real application, you might want to let the user choose which number to connect.
    $phoneNumberId = $phoneNumbers[0]['id'];

    // --- Exchange the User Access Token for a Permanent Page Access Token ---
    // Note: The concept of a non-expiring token is tied to a System User, which is more complex.
    // For a simpler flow, you get a long-lived user token (lasts 60 days) and will need to refresh it.
    // The most robust solution involves a more advanced setup with System Users.
    // Let's assume for now we use the long-lived token.

    // --- Securely Store the Credentials for the User ---
    // IMPORTANT: Encrypt the access token before saving it to the database.
    $user = auth()->user(); // Get the currently logged-in CRM user
    $user->update([
        'whatsapp_business_account_id' => $wabaId,
        'whatsapp_phone_number_id' => $phoneNumberId,
        'whatsapp_access_token' => encrypt($userAccessToken), // Always encrypt tokens!
    ]);

    return redirect('/dashboard')->with('success', 'Successfully connected to WhatsApp!');
}
}
