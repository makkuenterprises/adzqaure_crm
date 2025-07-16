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
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Remark::create([
            'leads_manager_id' => $leadId,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Remark added successfully!');
    }
}
