<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Models\Bill;
use App\Models\Lead;
use App\Models\Plan;
use App\Models\Admin;
use App\Models\Group;
use App\Models\LeadsManager;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Service;
use App\Models\Campaign;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Password;
use Illuminate\Http\Request;
use App\Models\DomainHosting;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Admin Delete Controller
|--------------------------------------------------------------------------
|
| Delete operations for admin are handled from this controller.
|
*/

interface AdminDelete
{
    public function handleEmployeeDelete($id);
    public function handleGroupDelete($id);
    public function handleLeadManagerDelete($id);
    public function handleLeadDelete($id);
    public function handleRoleDelete($id);
    public function handleCustomerDelete($id);
    public function handleProjectDelete($id);
    public function handlePaymentDelete($id);
    public function handleAdminDelete($id);
    public function handleDomainHostingDelete($id);
    public function handlePasswordDelete($id);
    public function handlePlanDelete($id);
    public function handlePackageDelete($id);
    public function handleScDelete($id);
    public function handleSDelete($id);
}

class AdminDeleteController extends Controller implements AdminDelete
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Employee Delete
    |--------------------------------------------------------------------------
    */
    public function handleEmployeeDelete($id)
    {

        $employee = Employee::find($id);
        if (!is_null($employee->profile)) {
            Storage::delete($employee->profile);
        }
        $employee->delete();
        return redirect()->route('admin.view.employee.list')->with('message', [
            'status' => 'success',
            'title' => 'Employee Deleted',
            'description' => 'The employee is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Group Delete
    |--------------------------------------------------------------------------
    */
    public function handleGroupDelete($id)
    {
        foreach (Lead::where('group_id', $id)->get() as $lead) {
            $this->handleLeadDelete($lead->id);
        }
        $group = Group::find($id);
        $group->delete();
        return redirect()->route('admin.view.group.list')->with('message', [
            'status' => 'success',
            'title' => 'Group Deleted',
            'description' => 'The group is successfully deleted'
        ]);
    }

    // Role Delete
    public function handleRoleDelete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.view.role.list')->with('success', 'Role deleted successfully.');
    }


     /*
    |--------------------------------------------------------------------------
    | Handle Leads Manager Delete
    |--------------------------------------------------------------------------
    */
    public function handleLeadManagerDelete($id)
    {
        $lead = LeadsManager::find($id);
        $lead->delete();
        return redirect()->route('admin.view.lead.manager.list')->with('message', [
            'status' => 'success',
            'title' => 'Lead Deleted',
            'description' => 'The Lead is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Lead Delete
    |--------------------------------------------------------------------------
    */
    public function handleLeadDelete($id)
    {
        $lead = Lead::find($id);
        $lead->delete();
        return redirect()->back()->with('message', [
            'status' => 'success',
            'title' => 'Lead Deleted',
            'description' => 'The lead is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Campaign Delete
    |--------------------------------------------------------------------------
    */
    public function handleCampaignDelete($id)
    {
        $campaign = Campaign::find($id);
        $campaign->delete();
        return redirect()->back()->with('message', [
            'status' => 'success',
            'title' => 'Campaign Deleted',
            'description' => 'The campaign is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Customer Delete
    |--------------------------------------------------------------------------
    */
    public function handleCustomerDelete($id)
    {
        foreach (Project::where('customer_id', $id)->get() as $project) {
            $this->handleProjectDelete($project->id);
        }
        $customer = Customer::find($id);
        if (!is_null($customer->profile)) {
            Storage::delete($customer->profile);
        }
        $customer->delete();
        return redirect()->back()->with('message', [
            'status' => 'success',
            'title' => 'Customer Deleted',
            'description' => 'The customer is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Project Delete
    |--------------------------------------------------------------------------
    */
    public function handleProjectDelete($id)
    {
        foreach (Payment::where('project_id', $id)->get() as $payment) {
            $this->handlePaymentDelete($payment->id);
        }
        $project = Project::find($id);
        $project->delete();
        return redirect()->back()->with('message', [
            'status' => 'success',
            'title' => 'Project Deleted',
            'description' => 'The project is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Payment Delete
    |--------------------------------------------------------------------------
    */
    public function handlePaymentDelete($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        return redirect()->back()->with('message', [
            'status' => 'success',
            'title' => 'Payment Deleted',
            'description' => 'The payment is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Bill Delete
    |--------------------------------------------------------------------------
    */
    public function handleBillDelete($id)
    {
        $bill = Bill::find($id);
        $bill->delete();
        return redirect()->back()->with('message', [
            'status' => 'success',
            'title' => 'Bill Deleted',
            'description' => 'The bill is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Admin Delete
    |--------------------------------------------------------------------------
    */
    public function handleAdminDelete($id)
    {
        $admin = Admin::find($id);
        if (!is_null($admin->profile)) {
            Storage::delete($admin->profile);
        }
        $admin->delete();
        return redirect()->route('admin.view.admin.list')->with('message', [
            'status' => 'success',
            'title' => 'Admin Access Deleted',
            'description' => 'The admin access is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Domain Hosting Delete
    |--------------------------------------------------------------------------
    */
    public function handleDomainHostingDelete($id)
    {
        $domain_hosting = DomainHosting::find($id);
        $domain_hosting->delete();
        return redirect()->route('admin.view.domain.hosting.list')->with('message', [
            'status' => 'success',
            'title' => 'Domain Hosting Deleted',
            'description' => 'The domain hosting is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Password Delete
    |--------------------------------------------------------------------------
    */
    public function handlePasswordDelete($id)
    {
        $password = Password::find($id);
        $password->delete();
        return redirect()->route('admin.view.password.list')->with('message', [
            'status' => 'success',
            'title' => 'Password Deleted',
            'description' => 'The password is successfully deleted'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Plan Delete
    |--------------------------------------------------------------------------
    */
    // public function handlePlanDelete($id)
    // {

    //     $plan = Plan::find($id);

    //     $plan->delete();
    //     return redirect()->route('admin.view.plan.list')->with('message', [
    //         'status' => 'success',
    //         'title' => 'Plan Deleted',
    //         'description' => 'The plan is successfully deleted'
    //     ]);
    // }

    public function handlePlanDelete($id)
    {
        $plan = Plan::find($id);
        if ($plan) {
            $plan->packages()->delete();
            $plan->delete();
            return redirect()->route('admin.view.plan.list')->with('message', [
                'status' => 'success',
                'title' => 'Plan Deleted',
                'description' => 'The plan is successfully deleted'
            ]);
        } else {
            return redirect()->route('admin.view.plan.list')->with('message', [
                'status' => 'error',
                'title' => 'Plan Not Found',
                'description' => 'The plan you are trying to delete does not exist.'
            ]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Handle Package Delete
    |--------------------------------------------------------------------------
    */
    public function handlePackageDelete($id)
    {
        $package = Package::find($id);
        $package->delete();
        return redirect()->route('admin.view.package.list')->with('message', [
            'status' => 'success',
            'title' => 'Package Deleted',
            'description' => 'The package is successfully deleted'
        ]);
    }

    public function handleScDelete($id)
    {
        $serviceCategory = ServiceCategory::find($id);
        $serviceCategory->delete();
        return redirect()->route('admin.view.service-category.list')->with('message', [
            'status' => 'success',
            'title' => 'Service Category Deleted',
            'description' => 'The Service Category is successfully deleted'
        ]);
    }


    public function handleSDelete($id)
    {

        $service = Service::findOrFail($id);

        foreach ($service->documents as $document) {
            $filePath = public_path('admin_new/service_document/' . $document->document_file);


            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $document->delete();
        }
        $service->delete();
        return redirect()->route('admin.view.service.list')->with('message', [
            'status' => 'success',
            'title' => 'Service Deleted',
            'description' => 'The service and its documents were successfully deleted.'
        ]);
    }
}
