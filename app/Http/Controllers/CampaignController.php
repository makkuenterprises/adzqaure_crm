<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use App\Jobs\SendWhatsAppCampaignMessage;
use App\Models\Campaign;
use App\Models\LeadsManager;
use App\Models\WhatsappTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    /**
     * List all campaigns.
     */
    public function index()
    {
        $campaigns = Campaign::withCount('campaignLeads')->latest()->paginate(20);
        return view('admin.sections.campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form to create a new campaign.
     */
    public function create(Request $request)
    {
        $request->validate(['lead_ids' => 'required|array|min:1']);
        $lead_ids = $request->input('lead_ids');

        // Fetch leads using the correct LeadsManager model
        $leads = LeadsManager::whereIn('id', $lead_ids)->get();
        // $templates = WhatsappTemplate::all();

        return view('admin.sections.campaigns.create', compact('leads', 'templates'));
    }

    /**
     * Store the campaign and dispatch jobs.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp_template_id' => 'required|exists:whatsapp_templates,id',
            'lead_ids' => 'required|array',
        ]);

        // Use a transaction to ensure data integrity
        $campaign = DB::transaction(function () use ($request) {
            $campaign = Campaign::create([
                'name' => $request->name,
                'whatsapp_template_id' => $request->whatsapp_template_id,
                'status' => 'processing',
                'dynamic_data' => [],
            ]);

            foreach ($request->lead_ids as $lead_id) {
                $campaign->campaignLeads()->create(['lead_id' => $lead_id]);
            }

            return $campaign;
        });

        // Dispatch jobs for each lead
        foreach ($campaign->campaignLeads as $campaignLead) {
            SendWhatsAppCampaignMessage::dispatch($campaignLead);
        }

        return redirect()->route('campaigns.show', $campaign)->with('success', 'Campaign started! Messages are being sent in the background.');
    }

    /**
     * Show the status of a single campaign.
     */
    public function show(Campaign $campaign)
    {
        $campaign->load('campaignLeads.lead');
        return view('admin.sections.campaigns.show', compact('campaign'));
    }

    /**
     * Sync WhatsApp templates from the Facebook API.
     */
    public function syncTemplates()
    {
        try {
            // Call the artisan command and capture the exit code
            $exitCode = Artisan::call('whatsapp:sync-templates');

            if ($exitCode === 0) {
                return redirect()->back()->with('success', 'WhatsApp templates have been synced successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to sync templates. Please check the logs.');
            }

        } catch (\Throwable $e) {
            // Caught using the correct global Throwable backslash prefix
            return redirect()->back()->with('error', 'An error occurred while trying to run the sync process: ' . $e->getMessage());
        }
    }
}
