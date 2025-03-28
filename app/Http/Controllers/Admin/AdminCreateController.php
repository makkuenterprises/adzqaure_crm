<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\DomainHosting;
use App\Models\Package;
use App\Models\Password;
use App\Models\Plan;
use App\Models\Project;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LeadsImport;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Group;
use App\Models\Campaign;
use App\Models\Lead;
use Carbon\Carbon;
use Storage, Hash;
use DB;


/*
|--------------------------------------------------------------------------
| Admin Create Controller
|--------------------------------------------------------------------------
|
| Create operations for admin are handled from this controller.
|
*/

interface AdminCreate
{
    public function handleEmployeeCreate(Request $request);
    public function handleLeadImport(Request $request);
    public function handleLeadCreate(Request $request);
    public function handleGroupCreate(Request $request);
    public function handleCampaignCreate(Request $request);
    public function handleCustomerCreate(Request $request);
    public function handleProjectCreate(Request $request);
    public function handlePaymentCreate(Request $request);
    public function handleBillCreate(Request $request);
    public function handleBillDuplicate(Request $request, $id);
    public function handleAdminCreate(Request $request);
    public function handleDomainHostingCreate(Request $request);
    public function handlePasswordCreate(Request $request);
    public function handlePlanCreate(Request $request);
    public function handlePackageCreate(Request $request);
}

class AdminCreateController extends Controller implements AdminCreate
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
    | Handle Employee Create
    |--------------------------------------------------------------------------
    */
    public function handleEmployeeCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'min:1', 'max:250'],
            'lastname' => ['required', 'string', 'min:1', 'max:250'],
            'email' => ['required', 'string', 'min:1', 'max:250', 'unique:employees'],
            'email_official' => ['nullable', 'string', 'min:1', 'max:250'],
            'phone' => ['required', 'numeric', 'digits_between:10,20', 'unique:employees'],
            'phone_alternate' => ['nullable', 'numeric', 'digits_between:10,20'],
            'role' => ['required', 'string'],
            'home' => ['required', 'string'],
            'street' => ['required', 'string'],
            'city' => ['required', 'string'],
            'pincode' => ['required', 'string'],
            'state' => ['required', 'string'],
            'country' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $employee = new Employee();
            $employee->firstname = $request->input('firstname');
            $employee->lastname = $request->input('lastname');
            $employee->name = ucfirst($request->firstname) . ' ' . ucfirst($request->lastname);
            $employee->email = $request->input('email');
            $employee->email_official = $request->input('email_official');
            $employee->phone = $request->input('phone');
            $employee->phone_alternate = $request->input('phone_alternate');
            $employee->role = $request->input('role');
            $employee->home = $request->input('home');
            $employee->street = $request->input('street');
            $employee->city = $request->input('city');
            $employee->pincode = $request->input('pincode');
            $employee->state = $request->input('state');
            $employee->country = $request->input('country');
            $employee->password = Hash::make($request->input('password'));
            $result = $employee->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Team member created',
                    'description' => 'Team member is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occcured',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Employee Create
    |--------------------------------------------------------------------------
    */
    public function handleLeadCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'email' => ['required', 'string', 'min:1', 'max:250'],
            'phone' => ['required', 'numeric', 'digits_between:10,20'],
            'address' => ['required', 'string', 'min:1', 'max:1000'],
            'group_id' => ['required', 'exists:groups,id']

        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $lead = new Lead();
            $lead->name = $request->input('name');
            $lead->email = $request->input('email');
            $lead->phone = $request->input('phone');
            $lead->address = $request->input('address');
            $lead->group_id = $request->input('group_id');
            $lead->status = false;
            $result = $lead->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Lead created',
                    'description' => 'Lead is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occcured',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Employee Import
    |--------------------------------------------------------------------------
    */
    public function handleLeadImport(Request $request)
    {
        Excel::import(new LeadsImport, $request->lead_file);
        return redirect()->route('admin.view.lead.list')->with('message', [
            'status' => 'success',
            'title' => 'Lead Imported Successfully',
            'description' => 'Imported Successfully.'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Group Create
    |--------------------------------------------------------------------------
    */
    public function handleGroupCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $group = new Group();
            $group->name = $request->input('name');
            $result = $group->save();

            if ($result) {
                return redirect()->route('admin.view.group.list')->with('message', [
                    'status' => 'success',
                    'title' => 'Group created',
                    'description' => 'Group is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occcured',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Campaign Create
    |--------------------------------------------------------------------------
    */
    public function handleCampaignCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'lead_count' => ['required', 'numeric'],
            'group_id' => ['required'],
            'employee_id' => ['required'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $campaign = new Campaign();
            $campaign->name = $request->input('name');
            $result = $campaign->save();
            $id = $campaign->id;

            Lead::where('campaign_id', null)->where('employee_id', null)->where('group_id', $request->group_id)->limit($request->lead_count)
                ->update([
                    'employee_id' => $request->employee_id,
                    'campaign_id' => $id,
                ]);

            if ($result) {
                return redirect()->route('admin.view.campaign.list')->with('message', [
                    'status' => 'success',
                    'title' => 'Campaign created',
                    'description' => 'Campaign is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occurred',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Customer Create
    |--------------------------------------------------------------------------
    */
    public function handleCustomerCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'email' => ['nullable', 'string', 'min:1', 'max:250', 'unique:customers'],
            'phone' => ['nullable', 'numeric', 'unique:customers'],
            'phone_alternate' => ['nullable', 'numeric'],
            'whatsapp' => ['nullable', 'numeric'],
            'company_name' => ['nullable', 'string'],
            'website' => ['nullable', 'string'],
            'street' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'pincode' => ['nullable', 'string'],
            'state' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'profile' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $customer = new Customer();
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->phone = $request->input('phone');
            $customer->phone_alternate = $request->input('phone_alternate');
            $customer->whatsapp = $request->input('whatsapp');
            $customer->company_name = $request->input('company_name');
            $customer->website = $request->input('website');
            $customer->street = $request->input('street');
            $customer->city = $request->input('city');
            $customer->pincode = $request->input('pincode');
            $customer->state = $request->input('state');
            $customer->country = $request->input('country');

            if ($request->other_name) {
                $other = [];
                for ($i = 0; $i < count($request->input('other_name')); $i++) {
                    array_push($other, [
                        'name' => $request->other_name[$i],
                        'value'  => $request->other_value[$i],
                    ]);
                }
                $customer->other = json_encode($other);
            } else {
                $customer->other = null;
            }

            if ($request->hasFile('profile')) {
                $customer->profile = $request->file('profile')->store('customers');
            }
            $result  = $customer->save();

            if ($result) {
                return redirect()->route('admin.view.customer.list')->with('message', [
                    'status' => 'success',
                    'title' => 'Customer created',
                    'description' => 'Customer is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occurred',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Project Create
    |--------------------------------------------------------------------------
    */
    public function handleProjectCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'project_link' => ['nullable', 'string'],
            'resource_link' => ['nullable', 'string'],
            'start_date' => ['nullable', 'string'],
            'end_date' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'pending_amount' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $project = new Project();
            $project->customer_id = $request->input('customer_id');
            $project->name = $request->input('name');
            $project->project_link = $request->input('project_link');
            $project->resource_link = $request->input('resource_link');
            $project->start_date = $request->input('start_date');
            $project->end_date = $request->input('end_date');
            $project->amount = $request->input('amount');
            $project->pending_amount = $request->input('pending_amount');
            $project->status = $request->input('status');
            $result  = $project->save();

            if ($result) {
                return redirect()->route('admin.view.customer.preview', ['id' => $request->input('customer_id')])->with('message', [
                    'status' => 'success',
                    'title' => 'Project created',
                    'description' => 'Project is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occurred',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Payment Create
    |--------------------------------------------------------------------------
    */
    public function handlePaymentCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'type' => ['required', 'string', 'min:1', 'max:250'],
            'amount' => ['required', 'numeric'],
            'remark' => ['nullable', 'string'],
            'method' => ['required', 'string'],
            'date' => ['required', 'string']
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $payment = new Payment();
            if ($request->input('project_id')) {
                $project = Project::find($request->input('project_id'));
                $payment->customer_id = $project->customer_id;
                $payment->project_id = $project->id;
            }
            $payment->type = $request->input('type');
            $payment->amount = $request->input('amount');
            $payment->remark = $request->input('remark');
            $payment->method = $request->input('method');
            $payment->date = $request->input('date');
            $result  = $payment->save();

            if ($result) {
                return redirect()->route('admin.view.payment.list')->with('message', [
                    'status' => 'success',
                    'title' => 'Payment created',
                    'description' => 'Payment is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occurred',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Bill Create
    |--------------------------------------------------------------------------
    */
    public function handleBillCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'customer_id' => ['required'],
            'total' => ['required', 'numeric'],
            'bill_date' => ['required', 'string'],
            'due_date' => ['required', 'string'],
            'invoice_currency' => ['required', 'string'],
            'payment_status' => ['required', 'string'],
            'bill_note' => ['nullable', 'string'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            if (!$request->input('bill_item_name')) {
                return redirect()->back()->with('message', [
                    'status' => 'warning',
                    'title' => 'Please Add Items',
                    'description' => 'You did not added any items in the bill.'
                ]);
            }

            $items = [];

            for ($i = 0; $i < count($request->input('bill_item_name')); $i++) {
                array_push($items, [
                    'bill_item_name' => $request->bill_item_name[$i],
                    'bill_item_quantity'  => $request->bill_item_quantity[$i],
                    'bill_item_price'  => $request->bill_item_price[$i],
                    'bill_item_total'  => $request->bill_item_total[$i],
                ]);
            }

            $bill = new Bill();
            $bill->customer_id = $request->input('customer_id');
            $bill->items = json_encode($items);
            if ($request->apply_gst) {
                $bill->tax = $request->input('tax');
            }
            $bill->payment_status = $request->input('payment_status');
            $bill->total = $request->input('total');
            $bill->bill_date = $request->input('bill_date');
            $bill->due_date = $request->input('due_date');
            $bill->invoice_currency = $request->input('invoice_currency');
            $bill->bill_note = $request->input('bill_note');
            $result = $bill->save();

            if ($result) {
                return redirect()->route('admin.view.bill.list')->with('message', [
                    'status' => 'success',
                    'title' => 'Bill Created',
                    'description' => 'Bill is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occurred',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Handle Bill Duplicate
    |--------------------------------------------------------------------------
    */
    public function handleBillDuplicate(Request $request, $id)
    {
        $duplicate_bill = Bill::find($id)->replicate();
        $result = $duplicate_bill->save();

        if ($result) {
            return redirect()->route('admin.view.bill.update', ['id' => $duplicate_bill->id])->with('message', [
                'status' => 'success',
                'title' => 'Bill Duplicated',
                'description' => 'Bill is successfully duplicated.'
            ]);
        } else {
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occurred',
                'description' => 'There is an internal server issue please try again.'
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Admin Create
    |--------------------------------------------------------------------------
    */
    public function handleAdminCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'email' => ['required', 'string', 'min:1', 'max:250', 'unique:admins'],
            'phone' => ['required', 'numeric', 'unique:admins'],
            'role' => ['required', 'string', 'min:1', 'max:250'],
            'password' => ['required', 'string', 'min:6', 'max:20', 'confirmed'],
            'profile' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->phone = $request->input('phone');
            $admin->role = $request->input('role');
            $admin->password = Hash::make($request->input('password'));
            if ($request->hasFile('profile')) {
                $admin->profile = $request->file('profile')->store('admins');
            }
            $result = $admin->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Admin Access Created',
                    'description' => 'Admin access is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occcured',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Domain Hosting Create
    |--------------------------------------------------------------------------
    */
    public function handleDomainHostingCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'customer_id' => ['nullable', 'string', 'min:1', 'max:250'],

            'domain_name' => ['nullable', 'string', 'min:1', 'max:250'],
            'domain_purchase' => ['nullable'],
            // 'domain_expiry' => ['nullable'],
            'domain_provider' => ['nullable', 'string', 'min:1', 'max:250'],
            'domain_renewal_price' => ['nullable', 'numeric'],

            'hosting_purchase' => ['nullable'],
            // 'hosting_expiry' => ['nullable'],
            'hosting_provider' => ['nullable', 'string', 'min:1', 'max:250'],
            'hosting_renewal_price' => ['nullable', 'numeric'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $domain_hosting = new DomainHosting();
            $domain_hosting->customer_id = $request->input('customer_id');
            $domain_hosting->domain_name = $request->input('domain_name');
            $domain_hosting->domain_purchase = $request->input('domain_purchase');
            // $domain_hosting->domain_expiry = $request->input('domain_expiry');
            $domain_hosting->domain_provider = $request->input('domain_provider');
            $domain_hosting->domain_renewal_price = $request->input('domain_renewal_price');
            $domain_hosting->hosting_purchase = $request->input('hosting_purchase');
            // $domain_hosting->hosting_expiry = $request->input('hosting_expiry');
            $domain_hosting->hosting_provider = $request->input('hosting_provider');
            $domain_hosting->hosting_renewal_price = $request->input('hosting_renewal_price');
            $result = $domain_hosting->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Domain Hosting Created',
                    'description' => 'Domain hosting is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occcured',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Password Create
    |--------------------------------------------------------------------------
    */
    public function handlePasswordCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'customer_id' => ['nullable', 'string', 'min:1', 'max:250'],
            'username' => ['nullable', 'string', 'min:1', 'max:250'],
            'email' => ['nullable', 'string', 'min:1', 'max:250'],
            'phone' => ['nullable', 'string', 'min:1', 'max:250'],
            'password' => ['nullable', 'string', 'min:1', 'max:250'],
            'type' => ['required', 'string', 'min:1', 'max:250'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $password = new Password();
            $password->customer_id = $request->input('customer_id');
            $password->username = $request->input('username');
            $password->email = $request->input('email');
            $password->phone = $request->input('phone');
            $password->password = $request->input('password');
            $password->type = $request->input('type');
            $result = $password->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Password Created',
                    'description' => 'Password is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occcured',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Plan Create
    |--------------------------------------------------------------------------
    */
    public function handlePlanCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'city' => ['required', 'string', 'min:1', 'max:250'],
            'summary' => ['nullable', 'string', 'min:1', 'max:500'],
            'duration' => ['required', 'numeric'],
            'price_regular' => ['required', 'numeric'],
            'price_offer' => ['nullable', 'numeric'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $plan = new Plan();
            $plan->name = $request->input('name');
            $plan->city = $request->input('city');
            $plan->summary = $request->input('summary');
            $plan->duration = $request->input('duration');
            $plan->price_regular = $request->input('price_regular');
            $plan->price_offer = $request->input('price_offer');
            $result = $plan->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Plan Created',
                    'description' => 'Plan is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occcured',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Package Create
    |--------------------------------------------------------------------------
    */
    public function handlePackageCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'customer_id' => ['required'],
            'plan_id' => ['required'],
            'start_date' => ['required', 'string', 'min:1', 'max:250'],
            'end_date' => ['required', 'string', 'min:1', 'max:250'],
            'payment_status' => ['required', 'string', 'min:1', 'max:250'],
            'status' => ['required', 'string', 'min:1', 'max:250'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            $package = new Package();
            $package->customer_id = $request->input('customer_id');
            $package->plan_id = $request->input('plan_id');
            $package->start_date = $request->input('start_date');
            $package->end_date = $request->input('end_date');
            $package->payment_status = $request->input('payment_status');
            $package->status = $request->input('status');
            $result = $package->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Package Created',
                    'description' => 'Package is successfully created.'
                ]);
            } else {
                return redirect()->back()->with('message', [
                    'status' => 'error',
                    'title' => 'An error occcured',
                    'description' => 'There is an internal server issue please try again.'
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Package Bill Create
    |--------------------------------------------------------------------------
    */
    public function handlePackageBillCreate(Request $request, $id)
    {
        $package = Package::find($id);

        $plan = Plan::find($package->plan_id);

        $price = is_null($plan->price_offer) ? $plan->price_regular : $plan->price_offer;

        $items = [];

        array_push($items, [
            'bill_item_name' => $plan->name,
            'bill_item_quantity'  => 1,
            'bill_item_price'  => $price,
            'bill_item_total'  => $price,
        ]);


        $bill = new Bill();
        $bill->package_id = $package->id;
        $bill->payment_for = "Package";
        $bill->customer_id = $package->customer_id;
        $bill->items = json_encode($items);
        $bill->payment_status = 'Pending';
        $bill->total = $price;
        $bill->bill_date = Carbon::now();;
        $bill->due_date = Carbon::now()->addDays(5);
        $result = $bill->save();

        if ($result) {
            return redirect()->route('admin.view.bill.list')->with('message', [
                'status' => 'success',
                'title' => 'Bill Created',
                'description' => 'Bill is successfully created.'
            ]);
        } else {
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occurred',
                'description' => 'There is an internal server issue please try again.'
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Package Create
    |--------------------------------------------------------------------------
    */
    public function handleDomainHostingBillCreate(Request $request, $id)
    {
        $domain_hosting = DomainHosting::find($id);

        $items = [];

        $total = 0;

        if (!is_null($domain_hosting->domain_expiry)) {
            if (Carbon::now()->diffInDays($domain_hosting->domain_expiry, false) <= 10) {
                array_push($items, [
                    'bill_item_name' => "Domain Renewal (" . $domain_hosting->domain_name . ")",
                    'bill_item_quantity'  => 1,
                    'bill_item_price'  => $domain_hosting->domain_renewal_price,
                    'bill_item_total'  => $domain_hosting->domain_renewal_price,
                ]);
                $total += $domain_hosting->domain_renewal_price;
            }
        }

        if (!is_null($domain_hosting->hosting_expiry)) {
            if (Carbon::now()->diffInDays($domain_hosting->hosting_expiry, false) <= 10) {
                array_push($items, [
                    'bill_item_name' => "Hosting Renewal",
                    'bill_item_quantity'  => 1,
                    'bill_item_price'  => $domain_hosting->hosting_renewal_price,
                    'bill_item_total'  => $domain_hosting->hosting_renewal_price,
                ]);
                $total += $domain_hosting->hosting_renewal_price;
            }
        }

        if (count($items) == 0) {
            return redirect()->back()->with('message', [
                'status' => 'warning',
                'title' => 'Please Add Items',
                'description' => 'You did not added any items in the bill.'
            ]);
        }

        $bill = new Bill();
        $bill->domain_hosting_id = $domain_hosting->id;
        $bill->payment_for = "Domain Hosting";
        $bill->customer_id = $domain_hosting->customer_id;
        $bill->items = json_encode($items);
        $bill->payment_status = 'Pending';
        $bill->total = $total;
        $bill->bill_date = Carbon::now();;
        $bill->due_date = Carbon::now()->addDays(5);
        $result = $bill->save();

        if ($result) {
            return redirect()->route('admin.view.bill.list')->with('message', [
                'status' => 'success',
                'title' => 'Bill Created',
                'description' => 'Bill is successfully created.'
            ]);
        } else {
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'An error occurred',
                'description' => 'There is an internal server issue please try again.'
            ]);
        }
    }
}