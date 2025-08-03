<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi; // The package for the API call
use App\Models\WhatsappTemplate; // The model to update
use Throwable;

class WhatsAppSyncTemplates extends Command
{
    /**
     * The name and signature of the console command.
     * We give it a unique name to call it later.
     */
    protected $signature = 'whatsapp:sync-templates';

    /**
     * The console command description.
     */
    protected $description = 'Fetches approved WhatsApp message templates from Meta and updates the local database';

    public function handle()
    {
        $this->info('Starting WhatsApp template sync...');

        try {
            // Initialize the WhatsApp Cloud API with config from .env
            $whatsapp_cloud_api = new WhatsAppCloudApi(config('whatsapp-cloud-api'));
            $waba_id = config('whatsapp-cloud-api.business_account_id');

            if (!$waba_id) {
                $this->error('WhatsApp Business Account ID is not set in your configuration.');
                return 1; // Return a non-zero exit code for failure
            }

            // Construct the API endpoint URL
            $endpoint = '/' . $waba_id . '/message_templates?fields=name,components,status';

            // Make the API call to get the templates
            $response = $whatsapp_cloud_api->graphApi()->get($endpoint);
            $templatesData = json_decode($response->getBody(), true)['data'];

            $syncedCount = 0;

            // Loop through the templates returned by the API
            foreach ($templatesData as $template) {
                // We only want to store templates that are approved
                if ($template['status'] !== 'APPROVED') {
                    continue;
                }

                // Find the component with type 'BODY' to get the main text
                $bodyComponent = null;
                foreach ($template['components'] as $component) {
                    if ($component['type'] === 'BODY') {
                        $bodyComponent = $component;
                        break;
                    }
                }

                // Use updateOrCreate to avoid duplicates.
                // It finds a template by 'name' or creates a new one.
                WhatsappTemplate::updateOrCreate(
                    [
                        'name' => $template['name'] // The unique condition to find the template
                    ],
                    [
                        'display_name' => str_replace('_', ' ', ucfirst($template['name'])), // A user-friendly name
                        'body_text' => $bodyComponent['text'] ?? 'No body text found.', // The template body
                        'placeholders' => isset($bodyComponent['example']) ? json_encode($bodyComponent['example']['body_text'][0]) : null,
                    ]
                );
                $syncedCount++;
            }

            $this->info("Sync complete! Found and updated/created {$syncedCount} approved templates.");
            return 0; // Return 0 for success

        } catch (Throwable $e) {
            // Catch any API or database errors
            $this->error('An error occurred during template sync: ' . $e->getMessage());
            return 1;
        }
    }
}
