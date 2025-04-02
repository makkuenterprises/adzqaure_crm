<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\CompanyDetail;
use App\Models\Customer;
use App\Models\DomainHosting;
use App\Models\MailCredential;
use App\Models\Package;
use App\Models\Password;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Group;
use App\Models\ServiceCategory;
use App\Models\CrmSetting;
use App\Models\Campaign;
use App\Models\Lead;
use Carbon\Carbon;
use Storage;
use Illuminate\Support\Facades\Hash;
use DB;



/*
|--------------------------------------------------------------------------
| Admin Update Controller
|--------------------------------------------------------------------------
|
| Update operations for admin are handled from this controller.
|
*/

interface AdminUpdate
{
    public function handleAccountInformationUpdate(Request $request);
    public function handleAccountPasswordUpdate(Request $request);
    public function handleEmployeeUpdate(Request $request, $id);
    public function handleGroupUpdate(Request $request, $id);
    public function handleCampaignUpdate(Request $request, $id);
    public function handleCustomerUpdate(Request $request, $id);
    public function handleProjectUpdate(Request $request, $id);
    public function handlePaymentUpdate(Request $request, $id);
    public function handleCompanyDetailsUpdate(Request $request);
    public function handleMailCredentialsUpdate(Request $request);
    public function handleBillUpdate(Request $request, $id);
    public function handleAdminUpdate(Request $request, $id);
    public function handleDomainHostingUpdate(Request $request, $id);
    public function handlePlanUpdate(Request $request, $id);
    public function handlePackageUpdate(Request $request, $id);
    public function handleScUpdate(Request $request, $id);
    public function handleCrmUpdate(Request $request);
    public function changeStatus($id, $status);
}

class AdminUpdateController extends Controller implements AdminUpdate
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
    | Handle Account Information Update
    |--------------------------------------------------------------------------
    */
    public function handleAccountInformationUpdate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'email' => ['required', 'string', 'min:1', 'max:250', Rule::unique('admins')->ignore(auth()->user()->id, 'id')],
            'phone' => ['required', 'numeric', 'digits_between:10,20', Rule::unique('admins')->ignore(auth()->user()->id, 'id')],
            'profile' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp'],
            'account_password' => ['required', 'string', 'min:1', 'max:250'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            if (Hash::check($request->input('account_password'), auth()->user()->password)) {

                $admin = Admin::find(auth()->user()->id);
                $admin->name = $request->input('name');
                $admin->email = $request->input('email');
                $admin->phone = $request->input('phone');

                if ($request->hasFile('profile')) {
                    $profileFileName = $request->file('profile')->getClientOriginalName();
                    $destinationPath = public_path('admin/profile');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $request->file('profile')->move($destinationPath, $profileFileName);
                    $admin->profile = $profileFileName;
                }
                $result = $admin->update();

                if ($result) {
                    return redirect()->back()->with('message', [
                        'status' => 'success',
                        'title' => 'Changes Saved',
                        'description' => 'The changes are successfully saved'
                    ]);
                } else {
                    return redirect()->back()->with('message', [
                        'status' => 'error',
                        'title' => 'An error occcured',
                        'description' => 'There is an internal server issue please try again.'
                    ]);
                }
            } else {
                return redirect()->back()->withErrors(['account_password' => 'Incorrect password']);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle CRM Settings Update
    |--------------------------------------------------------------------------
    */
    public function handleCrmUpdate(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'crm_name' => ['required', 'string', 'min:1', 'max:250'],
            'round_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'text_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'favicon' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:512'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $destinationPath = 'admin/crm_logo';

        $crmSettings = CrmSetting::first();

        if (!$crmSettings) {
            $crmSettings = new CrmSetting();
        }

        if (!$crmSettings) {
            return redirect()->back()->withErrors(['crm_settings' => 'CRM settings not found.']);
        }


        $crmSettings->crm_name = $request->crm_name;

        if ($request->hasFile('round_logo')) {
            $roundLogoFile = $request->file('round_logo');
            $roundLogoName = time() . '_round_' . uniqid() . '.' . $roundLogoFile->getClientOriginalExtension();

            if ($crmSettings->round_logo && file_exists(public_path($destinationPath . '/' . $crmSettings->round_logo))) {
                unlink(public_path($destinationPath . '/' . $crmSettings->round_logo));
            }

            $roundLogoFile->move(public_path($destinationPath), $roundLogoName);
            $crmSettings->round_logo = $roundLogoName;
        }

        if ($request->hasFile('text_logo')) {
            $textLogoFile = $request->file('text_logo');
            $textLogoName = time() . '_text_' . uniqid() . '.' . $textLogoFile->getClientOriginalExtension();

            if ($crmSettings->text_logo && file_exists(public_path($destinationPath . '/' . $crmSettings->text_logo))) {
                unlink(public_path($destinationPath . '/' . $crmSettings->text_logo));
            }

            $textLogoFile->move(public_path($destinationPath), $textLogoName);
            $crmSettings->text_logo = $textLogoName;
        }

        if ($request->hasFile('favicon')) {
            $faviconFile = $request->file('favicon');
            $faviconName = time() . '_favicon_' . uniqid() . '.' . $faviconFile->getClientOriginalExtension();

            if ($crmSettings->favicon && file_exists(public_path($destinationPath . '/' . $crmSettings->favicon))) {
                unlink(public_path($destinationPath . '/' . $crmSettings->favicon));
            }

            $faviconFile->move(public_path($destinationPath), $faviconName);
            $crmSettings->favicon = $faviconName;
        }

        // Save updates manually
        $result = $crmSettings->save();

        if ($result) {
            return redirect()->back()->with('message', [
                'status' => 'success',
                'title' => 'Changes Saved',
                'description' => 'The changes have been successfully saved.',
            ]);
        } else {
            return redirect()->back()->with('message', [
                'status' => 'error',
                'title' => 'Error Occurred',
                'description' => 'An internal server issue occurred. Please try again.',
            ]);
        }
    }
    /*
    |--------------------------------------------------------------------------
    | Handle Account Password Update
    |--------------------------------------------------------------------------
    */
    public function handleAccountPasswordUpdate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'current_password' => ['required', 'string', 'min:1', 'max:250'],
            'password' => ['required', 'string', 'min:6', 'max:20', 'confirmed'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            if (Hash::check($request->input('current_password'), auth()->user()->password)) {

                $admin = Admin::find(auth()->user()->id);
                $admin->password = Hash::make($request->input('password'));
                $result = $admin->update();

                if ($result) {
                    return redirect()->back()->with('message', [
                        'status' => 'success',
                        'title' => 'Password Updated',
                        'description' => 'The password is successfully updated'
                    ]);
                } else {
                    return redirect()->back()->with('message', [
                        'status' => 'error',
                        'title' => 'An error occcured',
                        'description' => 'There is an internal server issue please try again.'
                    ]);
                }
            } else {
                return redirect()->back()->withErrors(['current_password' => 'Incorrect password']);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Employee Update
    |--------------------------------------------------------------------------
    */
    public function handleEmployeeUpdate(Request $request, $id)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'min:1', 'max:250'],
            'lastname' => ['required', 'string', 'min:1', 'max:250'],
            'email' => ['required', 'string', 'min:1', 'max:250', Rule::unique('employees')->ignore($id, 'id')],
            'email_official' => ['nullable', 'string', 'min:1', 'max:250'],
            'phone' => ['required', 'numeric', 'digits_between:10,20', Rule::unique('employees')->ignore($id, 'id')],
            'phone_alternate' => ['nullable', 'numeric', 'digits_between:10,20'],
            'role' => ['required', 'string'],
            'home' => ['required', 'string'],
            'street' => ['required', 'string'],
            'city' => ['required', 'string'],
            'pincode' => ['required', 'string'],
            'state' => ['required', 'string'],
            'country' => ['required', 'string'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {


            $employee = Employee::where('id', $id)->first();
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
            if ($request->input('password')) {
                $employee->password = Hash::make($request->input('password'));
            }

            $result = $employee->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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
    | Handle Group Update
    |--------------------------------------------------------------------------
    */
    public function handleGroupUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            $group = Group::where('id', $id)->first();
            $group->name = $request->input('name');
            $result = $group->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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
    | Handle Campaign Update
    |--------------------------------------------------------------------------
    */
    public function handleCampaignUpdate(Request $request, $id)
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

            $campaign = Campaign::find($id);
            $campaign->name = $request->input('name');
            $result = $campaign->update();

            Lead::where('campaign_id', null)->where('employee_id', null)->where('group_id', $request->group_id)->limit($request->lead_count)
                ->update([
                    'employee_id' => $request->employee_id,
                    'campaign_id' => $id,
                ]);

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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
    | Handle Customer Update
    |--------------------------------------------------------------------------
    */
    public function handleCustomerUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'email' => ['nullable', 'string', 'min:1', 'max:250', Rule::unique('customers')->ignore($id, 'id')],
            'phone' => ['nullable', 'numeric', Rule::unique('customers')->ignore($id, 'id')],
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

            $customer = Customer::find($id);
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
                if ($customer->profile && file_exists(public_path('admin/customers/' . $customer->profile))) {
                    unlink(public_path('admin/customers/' . $customer->profile));
                }
                $file = $request->file('profile');
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('admin/customers'), $filename);
                $customer->profile = $filename;
            }

            $result = $customer->update();


            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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
    | Handle Project Update
    |--------------------------------------------------------------------------
    */
    public function handleProjectUpdate(Request $request, $id)
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

            $project = Project::find($id);
            $project->name = $request->input('name');
            $project->project_link = $request->input('project_link');
            $project->resource_link = $request->input('resource_link');
            $project->start_date = $request->input('start_date');
            $project->end_date = $request->input('end_date');
            $project->amount = $request->input('amount');
            $project->pending_amount = $request->input('pending_amount');
            $project->status = $request->input('status');
            $result  = $project->update();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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
    | Handle Payment Update
    |--------------------------------------------------------------------------
    */
    public function handlePaymentUpdate(Request $request, $id)
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

            $payment = Payment::find($id);
            $payment->type = $request->input('type');
            $payment->amount = $request->input('amount');
            $payment->remark = $request->input('remark');
            $payment->method = $request->input('method');
            $payment->date = $request->input('date');
            $result  = $payment->update();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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
    | Handle Company Details Update
    |--------------------------------------------------------------------------
    */
    // public function handleCompanyDetailsUpdate(Request $request)
    // {
    //     // dd($request->all());
    //     $validation = Validator::make($request->all(), [
    //         'company_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,webp,png'],
    //         'company_name' => ['nullable', 'string'],
    //         'company_email' => ['nullable', 'string'],
    //         'company_phone' => ['nullable', 'numeric'],
    //         'company_phone_alternate' => ['nullable', 'numeric'],
    //         'company_website' => ['nullable', 'string'],
    //         'company_account_type' => ['nullable', 'string'],
    //         'company_account_no' => ['nullable', 'string'],
    //         'company_account_holder' => ['nullable', 'string'],
    //         'company_account_ifsc' => ['nullable', 'string'],
    //         'company_account_branch' => ['nullable', 'string'],
    //         'company_account_vpa' => ['nullable', 'string'],
    //         'billing_tax_percentage' => ['nullable', 'string'],
    //         'company_address_street' => ['nullable', 'string'],
    //         'company_address_city' => ['nullable', 'string'],
    //         'company_address_pincode' => ['nullable', 'string'],
    //         'company_address_state' => ['nullable', 'string'],
    //         'company_address_country' => ['nullable', 'string'],
    //         'company_social_media_facebook' => ['nullable', 'string'],
    //         'company_social_media_twitter' => ['nullable', 'string'],
    //         'company_social_media_instagram' => ['nullable', 'string'],
    //         'company_social_media_linkedin' => ['nullable', 'string'],
    //         'company_social_media_youtube' => ['nullable', 'string'],
    //         'company_gst_number' => ['nullable', 'string'],

    //     ]);

    //     if ($validation->fails()) {
    //         return redirect()->back()->withErrors($validation)->withInput();
    //     } else {

    //         if ($request->hasFile('company_logo')) {
    //             CompanyDetail::where('name', 'company_logo')->update(['value' => $request->file('company_logo')->store('company')]);
    //         }
    //         CompanyDetail::where('name', 'company_name')->update(['value' => $request->input('company_name')]);
    //         CompanyDetail::where('name', 'company_email')->update(['value' => $request->input('company_email')]);
    //         CompanyDetail::where('name', 'company_phone')->update(['value' => $request->input('company_phone')]);
    //         CompanyDetail::where('name', 'company_phone_alternate')->update(['value' => $request->input('company_phone_alternate')]);
    //         CompanyDetail::where('name', 'company_website')->update(['value' => $request->input('company_website')]);
    //         CompanyDetail::where('name', 'company_account_type')->update(['value' => $request->input('company_account_type')]);
    //         CompanyDetail::where('name', 'company_account_no')->update(['value' => $request->input('company_account_no')]);
    //         CompanyDetail::where('name', 'company_account_holder')->update(['value' => $request->input('company_account_holder')]);
    //         CompanyDetail::where('name', 'company_account_ifsc')->update(['value' => $request->input('company_account_ifsc')]);
    //         CompanyDetail::where('name', 'company_account_branch')->update(['value' => $request->input('company_account_branch')]);
    //         CompanyDetail::where('name', 'company_account_vpa')->update(['value' => $request->input('company_account_vpa')]);
    //         CompanyDetail::where('name', 'billing_tax_percentage')->update(['value' => $request->input('billing_tax_percentage')]);
    //         CompanyDetail::where('name', 'company_address_street')->update(['value' => $request->input('company_address_street')]);
    //         CompanyDetail::where('name', 'company_address_city')->update(['value' => $request->input('company_address_city')]);
    //         CompanyDetail::where('name', 'company_address_pincode')->update(['value' => $request->input('company_address_pincode')]);
    //         CompanyDetail::where('name', 'company_address_state')->update(['value' => $request->input('company_address_state')]);
    //         CompanyDetail::where('name', 'company_address_country')->update(['value' => $request->input('company_address_country')]);
    //         CompanyDetail::where('name', 'company_social_media_facebook')->update(['value' => $request->input('company_social_media_facebook')]);
    //         CompanyDetail::where('name', 'company_social_media_twitter')->update(['value' => $request->input('company_social_media_twitter')]);
    //         CompanyDetail::where('name', 'company_social_media_instagram')->update(['value' => $request->input('company_social_media_instagram')]);
    //         CompanyDetail::where('name', 'company_social_media_linkedin')->update(['value' => $request->input('company_social_media_linkedin')]);
    //         CompanyDetail::where('name', 'company_social_media_youtube')->update(['value' => $request->input('company_social_media_youtube')]);

    //         CompanyDetail::where('name', 'company_gst_number')->update(['value' => $request->input('company_gst_number')]);


    //         return redirect()->back()->with('message', [
    //             'status' => 'success',
    //             'title' => 'Changes Saved',
    //             'description' => 'The changes are successfully saved'
    //         ]);
    //     }
    // }



    public function handleCompanyDetailsUpdate(Request $request)
    {
        // Validate the request data
        $validation = Validator::make($request->all(), [
            'company_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,webp,png'],
            'brand_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,webp,png'],
            'company_name' => ['nullable', 'string'],
            'brand_name' => ['nullable', 'string'],
            'company_email' => ['nullable', 'string'],
            'company_phone' => ['nullable', 'numeric'],
            'company_phone_alternate' => ['nullable', 'numeric'],
            'company_website' => ['nullable', 'string'],
            'company_account_type' => ['nullable', 'string'],
            'company_account_no' => ['nullable', 'string'],
            'company_account_holder' => ['nullable', 'string'],
            'company_account_ifsc' => ['nullable', 'string'],
            'company_account_branch' => ['nullable', 'string'],
            'company_account_vpa' => ['nullable', 'string'],
            'billing_tax_percentage' => ['nullable', 'string'],
            'company_address_street' => ['nullable', 'string'],
            'company_address_city' => ['nullable', 'string'],
            'company_address_pincode' => ['nullable', 'string'],
            'company_address_state' => ['nullable', 'string'],
            'company_address_country' => ['nullable', 'string'],
            'company_social_media_facebook' => ['nullable', 'string'],
            'company_social_media_twitter' => ['nullable', 'string'],
            'company_social_media_instagram' => ['nullable', 'string'],
            'company_social_media_linkedin' => ['nullable', 'string'],
            'company_social_media_youtube' => ['nullable', 'string'],
            // 'company_gst_number' => ['nullable', 'string'],
            'company_gst_number' => ['nullable', 'string', 'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z1-9]{1}[Z]{1}[0-9A-Z]{1}$/'],

        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        // Get the current company details to update
        $companyDetails = CompanyDetail::first();

        if (!$companyDetails) {
            $companyDetails = new CompanyDetail();
        }
        // Handle company logo upload
        if ($request->hasFile('company_logo')) {
            $logoFileName = $request->file('company_logo')->getClientOriginalName();
            $destinationPath = public_path('admin/company_logo');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $request->file('company_logo')->move($destinationPath, $logoFileName);
            $companyDetails->company_logo =  $logoFileName;
        }

        // Handle brand logo upload
        if ($request->hasFile('brand_logo')) {
            $logoFileName = $request->file('brand_logo')->getClientOriginalName();
            $destinationPath = public_path('admin/brand_logo');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $request->file('brand_logo')->move($destinationPath, $logoFileName);
            $companyDetails->brand_logo =  $logoFileName;
        }

        // Update other fields
        $companyDetails->brand_name = $request->input('brand_name', $companyDetails->brand_name);
        $companyDetails->company_name = $request->input('company_name', $companyDetails->company_name);
        $companyDetails->company_email = $request->input('company_email', $companyDetails->company_email);
        $companyDetails->company_phone = $request->input('company_phone', $companyDetails->company_phone);
        $companyDetails->company_phone_alternate = $request->input('company_phone_alternate', $companyDetails->company_phone_alternate);
        $companyDetails->company_website = $request->input('company_website', $companyDetails->company_website);
        $companyDetails->company_account_type = $request->input('company_account_type', $companyDetails->company_account_type);
        $companyDetails->company_account_no = $request->input('company_account_no', $companyDetails->company_account_no);
        $companyDetails->company_account_holder = $request->input('company_account_holder', $companyDetails->company_account_holder);
        $companyDetails->company_account_ifsc = $request->input('company_account_ifsc', $companyDetails->company_account_ifsc);
        $companyDetails->company_account_branch = $request->input('company_account_branch', $companyDetails->company_account_branch);
        $companyDetails->company_account_vpa = $request->input('company_account_vpa', $companyDetails->company_account_vpa);
        $companyDetails->billing_tax_percentage = $request->input('billing_tax_percentage', $companyDetails->billing_tax_percentage);
        $companyDetails->company_address_street = $request->input('company_address_street', $companyDetails->company_address_street);
        $companyDetails->company_address_city = $request->input('company_address_city', $companyDetails->company_address_city);
        $companyDetails->company_address_pincode = $request->input('company_address_pincode', $companyDetails->company_address_pincode);
        $companyDetails->company_address_state = $request->input('company_address_state', $companyDetails->company_address_state);
        $companyDetails->company_address_country = $request->input('company_address_country', $companyDetails->company_address_country);
        $companyDetails->company_social_media_facebook = $request->input('company_social_media_facebook', $companyDetails->company_social_media_facebook);
        $companyDetails->company_social_media_twitter = $request->input('company_social_media_twitter', $companyDetails->company_social_media_twitter);
        $companyDetails->company_social_media_instagram = $request->input('company_social_media_instagram', $companyDetails->company_social_media_instagram);
        $companyDetails->company_social_media_linkedin = $request->input('company_social_media_linkedin', $companyDetails->company_social_media_linkedin);
        $companyDetails->company_social_media_youtube = $request->input('company_social_media_youtube', $companyDetails->company_social_media_youtube);
        $companyDetails->company_gst_number = $request->input('company_gst_number', $companyDetails->company_gst_number);

        // Save the company details
        $companyDetails->save();

        return redirect()->back()->with('message', [
            'status' => 'success',
            'title' => 'Changes Saved',
            'description' => 'The changes are successfully saved'
        ]);
    }




    /*
    |--------------------------------------------------------------------------
    | Handle Mail Credentials Update
    |--------------------------------------------------------------------------
    */
    public function handleMailCredentialsUpdate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'mail_host' => ['nullable', 'string'],
            'mail_port' => ['nullable', 'string'],
            'mail_username' => ['nullable', 'string'],
            'mail_password' => ['nullable', 'string'],
            'mail_encryption' => ['nullable', 'string'],
            'mail_address' => ['nullable', 'string'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            MailCredential::where('name', 'mail_host')->update(['value' => $request->input('mail_host')]);
            MailCredential::where('name', 'mail_port')->update(['value' => $request->input('mail_port')]);
            MailCredential::where('name', 'mail_username')->update(['value' => $request->input('mail_username')]);
            MailCredential::where('name', 'mail_password')->update(['value' => $request->input('mail_password')]);
            MailCredential::where('name', 'mail_encryption')->update(['value' => $request->input('mail_encryption')]);
            MailCredential::where('name', 'mail_address')->update(['value' => $request->input('mail_address')]);

            return redirect()->back()->with('message', [
                'status' => 'success',
                'title' => 'Changes Saved',
                'description' => 'The changes are successfully saved'
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Bill Update
    |--------------------------------------------------------------------------
    */
    public function handleBillUpdate(Request $request, $id)
    {

        $validation = Validator::make($request->all(), [
            'customer_id' => ['required'],
            'total' => ['required', 'numeric'],
            'bill_date' => ['required', 'string'],
            'due_date' => ['required', 'string'],
            'invoice_currency' => ['required', 'string'],
            'bill_note' => ['nullable', 'string'],
            'payment_status' => ['nullable', 'string'],
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

            $bill = Bill::find($id);
            $bill->customer_id = $request->input('customer_id');
            $bill->items = json_encode($items);
            if ($request->apply_gst) {
                $bill->tax = $request->input('tax');
            } else {
                $bill->tax = null;
            }
            $bill->payment_status = $request->input('payment_status');
            $bill->total = $request->input('total');
            $bill->bill_date = $request->input('bill_date');
            $bill->due_date = $request->input('due_date');
            $bill->invoice_currency = $request->input('invoice_currency');
            $bill->bill_note = $request->input('bill_note');
            $result = $bill->update();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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
    | Handle Admin Update
    |--------------------------------------------------------------------------
    */
    public function handleAdminUpdate(Request $request, $id)
    {

        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'email' => ['required', 'string', 'min:1', 'max:250', Rule::unique('admins')->ignore($id, 'id')],
            'phone' => ['required', 'numeric', Rule::unique('admins')->ignore($id, 'id')],
            'role' => ['required', 'string', 'min:1', 'max:250'],
            'profile' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {

            if ($request->input('password_change')) {
                if ($request->input('password') != $request->input('password_confirmation')) {
                    return redirect()->back()->withErrors(['password' => 'The password confirmation does not match.'])->withInput();
                }
            }

            $admin = Admin::find($id);
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->phone = $request->input('phone');
            $admin->role = $request->input('role');
            if ($request->input('password')) {
                $admin->password = Hash::make($request->input('password'));
            }

            if ($request->hasFile('profile')) {
                $profileFileName = $request->file('profile')->getClientOriginalName();
                $destinationPath = public_path('admin/profile');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $request->file('profile')->move($destinationPath, $profileFileName);

                $admin->profile = $profileFileName;
            }

            $result = $admin->update();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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
    | Handle Domain Hosting Update
    |--------------------------------------------------------------------------
    */
    public function handleDomainHostingUpdate(Request $request, $id)
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

            $domain_hosting = DomainHosting::find($id);
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
            $result = $domain_hosting->update();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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
    | Handle Password Update
    |--------------------------------------------------------------------------
    */
    public function handlePasswordUpdate(Request $request, $id)
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

            $password = Password::find($id);
            $password->customer_id = $request->input('customer_id');
            $password->username = $request->input('username');
            $password->email = $request->input('email');
            $password->phone = $request->input('phone');
            $password->password = $request->input('password');
            $password->type = $request->input('type');
            $result = $password->update();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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
    | Handle Plan Update
    |--------------------------------------------------------------------------
    */
    public function handlePlanUpdate(Request $request, $id)
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

            $plan = Plan::find($id);
            $plan->name = $request->input('name');
            $plan->city = $request->input('city');
            $plan->summary = $request->input('summary');
            $plan->duration = $request->input('duration');
            $plan->price_regular = $request->input('price_regular');
            $plan->price_offer = $request->input('price_offer');
            $result = $plan->update();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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
    | Handle Package Update
    |--------------------------------------------------------------------------
    */
    public function handlePackageUpdate(Request $request, $id)
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

            $package = Package::find($id);
            $package->customer_id = $request->input('customer_id');
            $package->plan_id = $request->input('plan_id');
            $package->start_date = $request->input('start_date');
            $package->end_date = $request->input('end_date');
            $package->payment_status = $request->input('payment_status');
            $package->status = $request->input('status');
            $result = $package->update();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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
    | Handle Package Renew
    |--------------------------------------------------------------------------
    */
    public function handlePackageRenew(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'renew_date' => ['required', 'string', 'min:1', 'max:250'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            $package = Package::find($id);
            $plan = Plan::find($package->plan_id);
            $package->start_date = $request->input('renew_date');
            $package->end_date = Carbon::create($request->input(('renew_date')))->addDays($plan->duration);
            $result = $package->update();

            if ($result) {
                return redirect()->route('admin.view.package.list')->with('message', [
                    'status' => 'success',
                    'title' => 'Package Renewed',
                    'description' => 'The package is successfully renewed'
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



    public function handleScUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            $service_cat = ServiceCategory::where('id', $id)->first();
            $service_cat->name = $request->input('name');
            $result = $service_cat->save();

            if ($result) {
                return redirect()->back()->with('message', [
                    'status' => 'success',
                    'title' => 'Changes Saved',
                    'description' => 'The changes are successfully saved'
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

    public function changeStatus($id, $status)
    {
        $validStatuses = ['OnProgress', 'Pending', 'Closed'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status');
        }
        $project = Project::findOrFail($id);
        if ($project->status === 'Pending' && $status === 'OnProgress') {
            $project->status = 'OnProgress';
        } elseif ($project->status === 'OnProgress' && $status === 'Closed') {
            $project->status = 'Closed';
        }

        $result = $project->save();


        if ($result) {
            return redirect()->back()->with('message', [
                'status' => 'success',
                'title' => 'Changes Saved',
                'description' => 'The status are successfully saved'
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