<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin; // We need the Admin model
use App\Models\WhatsappTemplate;
use Illuminate\Support\Facades\Http; // <-- NEW: Use Laravel's built-in HTTP client
use Illuminate\Support\Facades\Log;
use Throwable;

class WhatsAppSyncTemplates extends Command
{
    protected $signature = 'whatsapp:sync-templates';
    protected $description = 'Fetches WhatsApp templates from the CRM\'s currently active connection';

    public function handle()
    {
        $this->info('Searching for the active WhatsApp connection...');

        try {
            // --- Step 1: Find the single admin with the 'is_whatsapp_active' flag ---
            $activeAdmin = Admin::where('is_whatsapp_active', true)->first();

            if (!$activeAdmin || empty($activeAdmin->whatsapp_access_token)) {
                $this->error('No active and valid WhatsApp connection found. Please connect an account via the admin panel.');
                return 1;
            }

            $this->info("Found active connection for Admin ID: {$activeAdmin->id}. Starting sync...");

            // --- Step 2: Prepare credentials and endpoint URL ---
            $accessToken = decrypt($activeAdmin->whatsapp_access_token);
            $waba_id = $activeAdmin->whatsapp_business_account_id;
            $url = "https://graph.facebook.com/v20.0/{$waba_id}/message_templates";
            $params = [
                'fields' => 'name,components,status,category',
                'limit' => 200, // Get up to 200 templates
            ];

            // --- Step 3: Make the API call using Laravel's HTTP Client ---
            // This is the corrected section. It's cleaner and works directly.
            $response = Http::withToken($accessToken)->get($url, $params);

            // Check for any client (4xx) or server (5xx) errors
            $response->throw();

            // Decode the JSON response
            $templatesData = $response->json()['data'];


            // --- Step 4: Loop and sync templates to the database (this logic is unchanged) ---
            $syncedCount = 0;
            $skippedCount = 0;

            foreach ($templatesData as $template) {
                if ($template['status'] !== 'APPROVED') {
                    $skippedCount++;
                    continue;
                }

                $components = collect($template['components']);
                $bodyComponent = $components->firstWhere('type', 'BODY');
                $bodyText = data_get($bodyComponent, 'text', 'No body text found.');
                $examplePlaceholders = data_get($bodyComponent, 'example.body_text.0');

                WhatsappTemplate::updateOrCreate(
                    ['name' => $template['name']],
                    [
                        'display_name' => str_replace('_', ' ', ucfirst($template['name'])),
                        'category' => $template['category'],
                        'body_text' => $bodyText,
                        'placeholders' => $examplePlaceholders ? json_encode($examplePlaceholders) : null,
                        'status' => $template['status'],
                    ]
                );
                $syncedCount++;
            }

            $this->info("Sync complete! Synced: {$syncedCount} approved templates. Skipped: {$skippedCount}.");
            return 0; // Success

        } catch (Throwable $e) {
            Log::error('WhatsApp Template Sync Failed: ' . $e->getMessage());
            $this->error('An error occurred during template sync. Check the log file for details.');
            return 1; // Failure
        }
    }
}
