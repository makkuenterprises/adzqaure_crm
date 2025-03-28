<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Package;
use App\Models\Plan;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Group;
use App\Models\Lead;
use App\Models\Campaign;
use App\Models\Employee;
use Carbon\Carbon;
use Hash;
use DB;

/*
|--------------------------------------------------------------------------
| Admin API Controller
|--------------------------------------------------------------------------
|
| API operations for admin are handled from this controller.
|
*/
interface AdminAPI {
    
    public function handleEmployeeStatusUpdate(Request $request);
    public function handleLeadStatusUpdate(Request $request);
    public function handleGroupStatusUpdate(Request $request);
    public function handleCampaignStatusUpdate(Request $request);
    public function handleCustomerStatusUpdate(Request $request);
    public function handleProjectStatusUpdate(Request $request);
    public function handleAdminStatus(Request $request);
    public function handlePackagePaymentStatusUpdate(Request $request);
    public function handleGetPlansByCity(Request $request);
    public function handleBillStatusUpdate(Request $request);

}

class AdminAPIController extends Controller implements AdminAPI
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
    | Handle Parent Category Status Update
    |--------------------------------------------------------------------------
    */
    public function handleEmployeeStatusUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:employees'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $employee = Employee::find($request->id);
            $employee->status = ! (boolean)$employee->status;
            $employee->update();
            return response(['message' => 'Status updated','data' => $employee],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Lead Status Update
    |--------------------------------------------------------------------------
    */
    public function handleLeadStatusUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:leads'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $lead = Lead::find($request->id);
            $lead->status = ! (boolean)$lead->status;
            $lead->update();
            return response(['message' => 'Status updated','data' => $lead],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Group Status Update
    |--------------------------------------------------------------------------
    */
    public function handleGroupStatusUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:groups'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $group = Group::find($request->id);
            $group->status = ! (boolean)$group->status;
            $group->update();
            return response(['message' => 'Status updated','data' => $group],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Campaign Status Update
    |--------------------------------------------------------------------------
    */
    public function handleCampaignStatusUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:campaigns'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $campaign = Campaign::find($request->id);
            $campaign->status = ! (boolean)$campaign->status;
            $campaign->update();
            return response(['message' => 'Status updated','data' => $campaign],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Campaign Status Update
    |--------------------------------------------------------------------------
    */
    public function handleCustomerStatusUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:customers'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $customer = Customer::find($request->id);
            $customer->status = ! (boolean)$customer->status;
            $customer->update();
            return response(['message' => 'Status updated','data' => $customer],200);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Handle Project Status Update
    |--------------------------------------------------------------------------
    */
    public function handleProjectStatusUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:projects'],
            'status' => ['required','string','min:3','max:10']
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $project = Project::find($request->id);
            $project->status = $request->status;
            $project->update();
            return response(['message' => 'Status updated','data' => $project],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Bill Status Update
    |--------------------------------------------------------------------------
    */
    public function handleBillStatusUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:bills'],
            'payment_status' => ['required','string','min:1','max:10']
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $bill = Bill::find($request->id);
            $bill->payment_status = $request->payment_status;
            $bill->update();
            return response(['message' => 'Status updated','data' => $bill],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Admin Status
    |--------------------------------------------------------------------------
    */
    public function handleAdminStatus(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:admins'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $admin = Admin::find($request->id);
            $admin->status = ! (boolean)$admin->status;
            $admin->update();
            return response(['message' => 'Status updated','data' => $admin],200);
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | Handle Package Payment Status Update
    |--------------------------------------------------------------------------
    */
    public function handlePackagePaymentStatusUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => ['required','exists:packages'],
            'payment_status' => ['required','string']
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            $package = Package::find($request->id);
            $package->payment_status = $request->payment_status;
            $package->update();
            return response(['message' => 'Status updated','data' => $package],200);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Get Plan By City
    |--------------------------------------------------------------------------
    */
    public function handleGetPlansByCity(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'city' => ['required','string','min:1','max:250'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages(), 500);
        }
        else {
            if ($request->plan_id) {
                $plan = Plan::find($request->plan_id);
                return response(['status' => true,'data' => $plan],200);
            }
            else {
                $plans = Plan::where('city',$request->city)->get();
                return response(['status' => true,'data' => $plans],200);
            }
        }
    }
}