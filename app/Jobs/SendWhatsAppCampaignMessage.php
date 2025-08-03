<?php

namespace App\Jobs;

use App\Models\CampaignLead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use Netflie\WhatsAppCloudApi\Message\Template\Component;
use Throwable;

class SendWhatsAppCampaignMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $campaignLead;

    public function __construct(CampaignLead $campaignLead)
    {
        $this->campaignLead = $campaignLead->withoutRelations();
    }

    public function handle()
    {
        // Eager load relationships for this job instance
        $this->campaignLead->load(['campaign.template', 'lead']);

        $campaign = $this->campaignLead->campaign;
        $lead = $this->campaignLead->lead;
        $template = $campaign->template;

        try {
            $whatsapp_cloud_api = new WhatsAppCloudApi(config('whatsapp-cloud-api'));

            // --- Build Dynamic Components ---
            // Example: template with a dynamic body variable like "Hello {{1}}, ..."
            $body_components = [];
            if ($lead->name) {
                $body_components[] = ['type' => 'text', 'text' => $lead->name];
            }
            // Add more logic here for other placeholders based on campaign->dynamic_data

            $components = new Component([], $body_components, []);

            // Send the API request
            $whatsapp_cloud_api->sendTemplate(
                $lead->phone_number,
                $template->name,
                'en_US', // This should be dynamic in a real app
                $components
            );

            // Mark as sent on success
            $this->campaignLead->update(['status' => 'sent']);

        } catch (Throwable $e) {
            // Mark as failed and log the reason
            $this->campaignLead->update([
                'status' => 'failed',
                'failed_reason' => $e->getMessage()
            ]);
        }
    }
}
