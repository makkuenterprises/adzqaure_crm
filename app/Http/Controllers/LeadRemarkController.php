<?php

namespace App\Http\Controllers;

use App\Models\Remark;
use App\Models\LeadsManager;
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

}
