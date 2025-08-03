<?php

namespace App\Http\Controllers;

use App\Models\Remark;
use App\Models\LeadsManager;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use Netflie\WhatsAppCloudApi\Message\Template\Component;
use Illuminate\Http\Request;

class LeadRemarkController extends Controller
{
    public function showRemarks($leadId)
    {
        $lead = LeadsManager::findOrFail($leadId);
        $remarks = Remark::where('leads_manager_id', $leadId)->latest()->paginate(10);

        return view('admin.sections.leadsmanager.remarks', compact('lead', 'remarks'));
    }

    public function storeRemark(Request $request, $leadId)
{
    if ($request->comment_type === 'appointment') {
        $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        $dateFormatted = \Carbon\Carbon::parse($request->appointment_date)->format('d M Y');
        $timeFormatted = \Carbon\Carbon::parse($request->appointment_time)->format('h:i A');

        $comment = "📅 Appointment booked for {$dateFormatted} at {$timeFormatted}";

        Remark::create([
            'leads_manager_id' => $leadId,
            'type' => 'appointment',
            'comment' => $comment,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
        ]);
    } else {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Remark::create([
            'leads_manager_id' => $leadId,
            'type' => 'remark',
            'comment' => $request->comment,
        ]);
    }

    return redirect()->back()->with('success', 'Remark added successfully!');
}

public function sendMessage(Request $request, Lead $lead)
    {
        $request->validate([
            'template_name' => 'required|string',
            // Add validation for your template's dynamic content
        ]);

        // Initialize the API with credentials from your .env file
        $whatsapp_cloud_api = new WhatsAppCloudApi([
            'from_phone_number_id' => config('whatsapp-cloud-api.from_phone_number_id'),
            'access_token' => config('whatsapp-cloud-api.access_token'),
        ]);

        // Example of sending a template with a dynamic name
        // 'hello_world' is the template name from your Meta Business Manager
        // 'en_US' is the language code
        $component_header = []; // No header in this example
        $component_body = [
            [
                'type' => 'text',
                'text' => $lead->name, // Dynamic content for placeholder {{1}}
            ],
        ];
        $component_buttons = []; // No buttons in this example

        $components = new Component($component_header, $component_body, $component_buttons);

        try {
            $whatsapp_cloud_api->sendTemplate(
                $lead->phone_number, // The recipient's phone number
                $request->template_name,
                'en_US', // The language of the template
                $components
            );

            // Add logic to log the message in your CRM
            // e.g., $lead->messages()->create([...]);

            return back()->with('success', 'Message sent successfully!');

        } catch (\Exception $e) {
            // Handle exceptions, e.g., API errors
            return back()->with('error', 'Failed to send message: ' . $e->getMessage());
        }
    }

}
