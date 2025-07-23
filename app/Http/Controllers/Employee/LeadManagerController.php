<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadsManager;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class LeadManagerController extends Controller
{
    public function viewLeadManagerList(Request $request)
    {
        $query = LeadsManager::query();

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $leads_manager = $query->latest()->paginate(15);
        $leads_manager->appends(request()->query());

        return view('employee.sections.leadsmanager.leadsmanager-list', ['leads_manager' => $leads_manager]);
    }

    /** View Group Update **/
    public function viewLeadManagerUpdate($id)
    {
        $leads_manager = LeadsManager::where('id', $id)->first();
        $status = ['Hot Lead', 'Interested', 'Dead Lead'];
        return view('employee.sections.leadsmanager.leadsmanager-update', ['status' => $status, 'leads_manager' => $leads_manager]);
    }

    /** View Lead Manager Import **/
    public function viewLeadManagerImport()
    {


        return view('employee.sections.leadsmanager.leadsmanager-import');
    }

    /** View Leads Manager Create **/
    public function viewLeadManagerCreate()
    {

        $status = ['Hot Lead', 'Interested', 'Dead Lead'];
        return view('employee.sections.leadsmanager.leadsmanager-create', [
        'status' => $status
    ]);
    }

    public function handleLeadManagerCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'email' => ['required', 'string', 'min:1', 'max:250'],
            'phone' => ['required', 'numeric', 'digits_between:10,20'],
            'address' => ['required', 'string', 'min:1', 'max:1000'],
            'status' => ['required', 'in:Hot Lead,Interested,Dead Lead'],

        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $lead = new LeadsManager();
            $lead->name = $request->input('name');
            $lead->email = $request->input('email');
            $lead->phone = $request->input('phone');
            $lead->address = $request->input('address');
            $lead->status = $request->input('status');

            if ($lead->save()) {
            return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Lead created',
                    'description' => 'Lead is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occurred',
                    'description' => 'There is an internal server issue, please try again.'
                ]);
            }
                }
    }

    public function handleLeadsManagerUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required'],
            'phone' => ['required'],

        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            $leads_manager = LeadsManager::where('id', $id)->first();
            $leads_manager->name = $request->input('name');
            $leads_manager->email = $request->input('email');
            $leads_manager->phone = $request->input('phone');
            $leads_manager->address = $request->input('address');
            $leads_manager->status = $request->input('status');
            $leads_manager->remarks = $request->input('remarks');
            $result = $leads_manager->save();

            // Handle the new remark
            if ($request->filled('new_remark')) {
                // This is the beautiful, clean way to do it!
                $leads_manager->remarks()->create([
                    'comment' => $request->input('new_remark')
                ]);
            }

            if ($result) {
                return redirect()->route('employee.view.lead.manager.list')->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occurred',
                    'description' => 'There is an internal server issue, please try again.'
                ]);
            }

        }
    }

    public function handleLeadManagerDelete($id)
    {
        $lead = LeadsManager::find($id);
        $lead->delete();
        return redirect()->route('employee.view.lead.manager.list')->with('message', [
            'status' => 'success',
            'title' => 'Lead Deleted',
            'description' => 'The Lead is successfully deleted'
        ]);
    }

}
