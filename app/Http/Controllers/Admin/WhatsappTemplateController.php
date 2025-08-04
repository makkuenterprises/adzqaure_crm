<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsappTemplate; // Your template model
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Artisan; // To run the sync command

class WhatsappTemplateController extends Controller
{
    /**
     * Display a list of all synced WhatsApp templates.
     */
    public function index()
    {
        $templates = WhatsappTemplate::latest()->paginate(20); // Get latest templates, 20 per page
        return view('admin.whatsapp_templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new template.
     */
    public function create()
    {
        // We will build this view next
        return view('admin.whatsapp_templates.create');
    }

    /**
     * Trigger the Artisan command to sync templates from Meta.
     */
    public function sync()
    {
        try {
            // Call the Artisan command programmatically
            Artisan::call('whatsapp:sync-templates');

            // Get the output from the command
            $output = Artisan::output();

            return redirect()->route('admin.whatsapp-templates.index')
                ->with('success', 'Template sync initiated successfully! Check results: <br><pre>' . $output . '</pre>');

        } catch (\Exception $e) {
            return redirect()->route('admin.whatsapp-templates.index')
                ->with('error', 'Failed to initiate template sync: ' . $e->getMessage());
        }
    }

    // We will add the store() method later

    public function store(Request $request)
    {
        // 1. Validate the form input
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9_]+$/'],
            'category' => 'required|in:MARKETING,UTILITY,AUTHENTICATION',
            'body_text' => 'required|string',
            'body_example' => 'nullable|string',
        ], [
            'name.regex' => 'The template name can only contain lowercase letters, numbers, and underscores.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 2. Find the active admin and their credentials
        $activeAdmin = Admin::where('is_whatsapp_active', true)->first();
        if (!$activeAdmin) {
            return redirect()->back()->with('error', 'No active WhatsApp connection found in the CRM.');
        }

        // 3. Construct the API payload for Meta
        $components = [
            [
                'type' => 'BODY',
                'text' => $request->body_text
            ]
        ];

        // If an example is provided, add it to the body component
        if ($request->filled('body_example')) {
            $components[0]['example'] = [
                'body_text' => [
                    explode(',', $request->body_example)
                ]
            ];
        }

        $payload = [
            'name' => $request->name,
            'language' => 'en_US', // Or make this selectable
            'category' => $request->category,
            'components' => $components
        ];

        // 4. Make the API call
        try {
            $accessToken = decrypt($activeAdmin->whatsapp_access_token);
            $waba_id = $activeAdmin->whatsapp_business_account_id;
            $url = "https://graph.facebook.com/v20.0/{$waba_id}/message_templates";

            $response = Http::withToken($accessToken)->post($url, $payload);

            if ($response->failed()) {
                // If Meta returns an error, show it to the user
                $error = $response->json()['error']['message'] ?? 'An unknown error occurred.';
                return redirect()->back()->with('error', 'Meta API Error: ' . $error)->withInput();
            }

            // 5. On success, redirect back with a success message
            return redirect()->route('admin.whatsapp-templates.index')
                ->with('success', 'Template submitted successfully! Please use "Sync Templates Now" in a few minutes to see its status.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }
}
