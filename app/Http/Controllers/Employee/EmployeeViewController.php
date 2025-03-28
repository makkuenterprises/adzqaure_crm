<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Lead;
use App\Models\Group;
use App\Models\Campaign;


/*
|--------------------------------------------------------------------------
| Employee View Controller
|--------------------------------------------------------------------------
|
| View operations for employee are handled from this controller.
|
*/

interface EmployeeView
{
    public function viewDashboard();
    public function viewSetting();
    public function viewAccountSetting();

    public function viewCampaignList();
    public function viewCampaignPreview($id);
}

class EmployeeViewController extends Controller implements EmployeeView
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    /** View Dashboard **/
    public function viewDashboard()
    {
        $lead_id = Lead::where('employee_id',auth()->user()->id)->pluck('id');    
        $camping_id = Lead::where('employee_id',auth()->user()->id)->pluck('campaign_id');       
        $campaigns = Campaign::whereIn('id',$camping_id)->get();
        return view('employee.sections.dashboard', ['campaigns' => $campaigns,'lead_id'=>$lead_id]);
    }

    /** View Setting **/
    public function viewSetting()
    {
        return view('employee.sections.setting.setting');
    }

    /** View Account Setting **/
    public function viewAccountSetting()
    {
        return view('employee.sections.setting.account');
    }

    /** View Campaign List **/
    public function viewCampaignList()
    {
        $lead_id = Lead::where('employee_id',auth()->user()->id)->pluck('id');    
        $camping_id = Lead::where('employee_id',auth()->user()->id)->pluck('campaign_id');       
        $campaigns = Campaign::whereIn('id',$camping_id)->get();
        return view('employee.sections.campaign.campaign-list', ['campaigns' => $campaigns,'lead_id'=>$lead_id]);
    }

    /** View Campaign Preview **/
    public function viewCampaignPreview($id)
    {
        
        $campaign = Campaign::find($id);
        $lead_id = Lead::where('employee_id',auth()->user()->id)->pluck('id');  
        $leads = Lead::where('campaign_id', $id)->whereIn('id',$lead_id)->get();
        return view('employee.sections.campaign.campaign-preview', ['campaign' => $campaign, 'leads' => $leads]);
    }
}