<?php

return [
    /*
    |--------------------------------------------------------------------------
    | WhatsApp Cloud API Access Token
    |--------------------------------------------------------------------------
    |
    | Your Facebook App's permanent access token.
    |
    */
    'access_token' => env('WHATSAPP_CLOUD_API_ACCESS_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | WhatsApp Cloud API from phone number ID
    |--------------------------------------------------------------------------
    |
    | Your WhatsApp Business phone number ID.
    |
    */
    'from_phone_number_id' => env('WHATSAPP_CLOUD_API_FROM_PHONE_NUMBER_ID'),

    /*
    |--------------------------------------------------------------------------
    | WhatsApp Business Account ID
    |--------------------------------------------------------------------------
    |
    | Your WhatsApp Business Account ID.
    | Required for fetching templates.
    |
    */
    'business_account_id' => env('WHATSAPP_BUSINESS_ACCOUNT_ID'),

    /*
    |--------------------------------------------------------------------------
    | Graph API Version
    |--------------------------------------------------------------------------
    |
    | The Graph API version to use.
    |
    */
    'graph_api_version' => env('WHATSAPP_CLOUD_API_GRAPH_API_VERSION', 'v15.0'),

    /*
    |--------------------------------------------------------------------------
    | Webhook Configurations
    |--------------------------------------------------------------------------
    |
    | The following settings are used to configure the webhook endpoint.
    |
    */
    'webhook' => [
        /*
        |--------------------------------------------------------------------------
        | Webhook Route
        |--------------------------------------------------------------------------
        |
        | The route that will be used to receive incoming webhook requests.
        |
        */
        'url' => '/webhook/whatsapp',

        /*
        |--------------------------------------------------------------------------
        | Webhook Verify Token
        |--------------------------------------------------------------------------
        |
        | The verify token used to validate the webhook.
        |
        */
        'verify_token' => env('WHATSAPP_CLOUD_API_WEBHOOK_VERIFY_TOKEN'),
    ],

];
