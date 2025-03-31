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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportGroup;
use App\Models\Employee;
use App\Models\Lead;
use App\Models\Group;
use App\Models\Campaign;
use App\Models\Admin;
use PDF;
use Carbon\Carbon; // Make sure to import Carbon


/*
|--------------------------------------------------------------------------
| Admin View Controller
|--------------------------------------------------------------------------
|
| View operations for admin are handled from this controller.
|
*/

interface AdminView
{
    public function viewDashboard();
    public function viewSetting();
    public function viewAccountSetting();
    public function viewCompanyDetailsSetting();
    public function viewMailCredentialsSetting();

    public function viewEmployeeList();
    public function viewEmployeeCreate();
    public function viewEmployeeUpdate($id);

    public function viewLeadList();
    public function viewLeadImport();
    public function viewLeadCreate();

    public function viewGroupList();
    public function viewGroupCreate();
    public function viewGroupUpdate($id);
    public function viewGroupPreview($id);

    public function viewCampaignList();
    public function viewCampaignCreate();
    public function viewCampaignUpdate($id);
    public function viewCampaignPreview($id);

    public function viewCustomerList();
    public function viewCustomerCreate();
    public function viewCustomerUpdate($id);
    public function viewCustomerPreview($id);

    public function viewProjectList();
    public function viewProjectCreate();
    public function viewProjectUpdate($id);
    public function viewProjectPreview($id);

    public function viewPaymentList();
    public function viewPaymentCreate();
    public function viewPaymentUpdate($id);

    public function viewBillList();
    public function viewBillCreate();
    public function viewBillUpdate($id);
    public function handleBillInvoiceDownload($id);

    public function viewAdminList();
    public function viewAdminCreate();
    public function viewAdminUpdate($id);

    public function viewDomainHostingList();
    public function viewDomainHostingCreate();
    public function viewDomainHostingUpdate($id);

    public function viewPasswordList();
    public function viewPasswordCreate();
    public function viewPasswordUpdate($id);

    public function viewPlanList(Request $request);
    public function viewPlanCreate();
    public function viewPlanUpdate($id);

    public function viewPackageList();
    public function viewPackageCreate();
    public function viewPackageUpdate($id);
    public function viewPackageRenew($id);
}

class AdminViewController extends Controller implements AdminView
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

    /** View Dashboard **/
    public function viewDashboard()
    {

        return view('admin.sections.dashboard');
    }

    /** View Setting **/
    public function viewSetting()
    {

        return view('admin.sections.setting.setting');
    }

    /** View Account Setting **/
    public function viewAccountSetting()
    {

        return view('admin.sections.setting.account');
    }

    /** View Company Details Setting **/
    public function viewCompanyDetailsSetting()
    {
        // $company_details = CompanyDetail::find(30);
        $company_details = CompanyDetail::first();

        return view('admin.sections.setting.company-details', compact('company_details'));
    }

    /** View Mail Credentials Setting **/
    public function viewMailCredentialsSetting()
    {

        $mail_credentials = MailCredential::query();
        return view('admin.sections.setting.mail-credentials', ['mail_credentials' => $mail_credentials]);
    }

    /** View Employee List **/
    public function viewEmployeeList()
    {

        $employees = Employee::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.sections.employee.employee-list', ['employees' => $employees]);
    }

    /** View Employeee Create **/
    public function viewEmployeeCreate()
    {
        return view('admin.sections.employee.employee-create');
    }

    /** View Employee Update **/
    public function viewEmployeeUpdate($id)
    {
        $employee = Employee::where('id', $id)->first();
        return view('admin.sections.employee.employee-update', ['employee' => $employee]);
    }

    /** View Lead List **/
    public function viewLeadList()
    {
        $leads = Lead::all();
        return view('admin.sections.lead.lead-list', ['leads' => $leads]);
    }

    /** View Lead Import **/
    public function viewLeadImport()
    {

        $groups = Group::all();
        $employees = Employee::all();
        return view('admin.sections.lead.lead-import', ['groups' => $groups, 'employees' => $employees]);
    }

    /** View Lead Create **/
    public function viewLeadCreate()
    {

        $groups = Group::all();
        $employees = Employee::all();
        return view('admin.sections.lead.lead-create', ['groups' => $groups, 'employees' => $employees]);
    }

    /** View Group List **/
    public function viewGroupList()
    {
        // $groups = Group::all();
        $groups = Group::paginate(10);

        return view('admin.sections.group.group-list', ['groups' => $groups]);
    }

    /** View Group Create **/
    public function viewGroupCreate()
    {
        return view('admin.sections.group.group-create');
    }

    /** View Group Update **/
    public function viewGroupUpdate($id)
    {
        $group = Group::where('id', $id)->first();
        $leads = Lead::where('group_id', $id)->get();
        return view('admin.sections.group.group-update', ['group' => $group, 'leads' => $leads]);
    }

    /** View Group Preview **/
    public function viewGroupPreview($id)
    {
        $group = Group::where('id', $id)->first();
        $leads = Lead::where('group_id', $id)->get();
        return view('admin.sections.group.group-preview', ['group' => $group, 'leads' => $leads]);
    }

    /** View Campaign List **/
    public function viewCampaignList()
    {

        $campaigns = Campaign::all();
        return view('admin.sections.campaign.campaign-list', ['campaigns' => $campaigns]);
    }

    /** View Campaign Create **/
    public function viewCampaignCreate()
    {
        $groups = Group::where('status', true)->get();
        $employees = Employee::where('status', true)->get();
        return view('admin.sections.campaign.campaign-create', ['groups' => $groups, 'employees' => $employees]);
    }

    /** View Campaign Update **/
    public function viewCampaignUpdate($id)
    {
        $campaign = Campaign::find($id);
        $groups = Group::where('status', true)->get();
        $employees = Employee::where('status', true)->get();
        $leads = Lead::where('campaign_id', $id)->get();
        return view('admin.sections.campaign.campaign-update', ['campaign' => $campaign, 'groups' => $groups, 'employees' => $employees, 'leads' => $leads]);
    }

    /** View Campaign Preview **/
    public function viewCampaignPreview($id)
    {
        $campaign = Campaign::find($id);
        $leads = Lead::where('campaign_id', $id)->get();
        return view('admin.sections.campaign.campaign-preview', ['campaign' => $campaign, 'leads' => $leads]);
    }

    /** View Group Export **/
    public function viewGroupExport($id)
    {
        $group = Group::find($id);
        if (!$group) {
            return redirect()->back()->with('error', 'Group not found');
        }

        $date = now()->format('Y-m-d');
        $filename = $group->name . '_export_' . $date . '.xlsx';


        return Excel::download(new ExportGroup($id), $filename);
    }

    /** View Customer List **/
    public function viewCustomerList()
    {

        $customers = Customer::orderBy('created_at', 'desc')->paginate(10);
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::where('status', 1)->count();
        $inactiveCustomers = Customer::where('status', 0)->count();
        return view('admin.sections.customer.customer-list', [
            'customers' => $customers,
            'totalCustomers' => $totalCustomers,
            'activeCustomers' => $activeCustomers,
            'inactiveCustomers' => $inactiveCustomers,
        ]);
    }


    /** View Customer Create **/
    public function viewCustomerCreate()
    {
        return view('admin.sections.customer.customer-create');
    }

    /** View Customer Update **/
    public function viewCustomerUpdate($id)
    {
        $customer = Customer::find($id);
        return view('admin.sections.customer.customer-update', ['customer' => $customer]);
    }

    /** View Customer Preview **/
    public function viewCustomerPreview($id)
    {
        $customer = Customer::find($id);
        $projects = Project::where('customer_id', $id)->get();
        return view('admin.sections.customer.customer-preview', ['customer' => $customer, 'projects' => $projects]);
    }

    /** View Project List **/
    public function viewProjectList()
    {
        $projects = Project::all();
        return view('admin.sections.project.project-list', ['projects' => $projects]);
    }

    /** View Project Create **/
    public function viewProjectCreate()
    {

        return view('admin.sections.project.project-create');
    }

    /** View Project Update **/
    public function viewProjectUpdate($id)
    {
        $project = Project::find($id);
        return view('admin.sections.project.project-update', ['project' => $project]);
    }

    /** View Project Preview **/
    public function viewProjectPreview($id)
    {
        $project = Project::find($id);
        $payments = Payment::where('project_id', $id)->get();
        $credit_amount = Payment::where('project_id', $id)->where('type', 'Credit')->sum('amount');
        $debit_amount = Payment::where('project_id', $id)->where('type', 'Debit')->sum('amount');
        return view('admin.sections.project.project-preview', [
            'project' => $project,
            'payments' => $payments,
            'credit_amount' => $credit_amount,
            'debit_amount' => $debit_amount
        ]);
    }

    /** View Payment List **/
    public function viewPaymentList()
    {
        $payments = Payment::all();
        return view('admin.sections.payment.payment-list', ['payments' => $payments]);
    }

    /** View Payment Create **/
    public function viewPaymentCreate()
    {
        return view('admin.sections.payment.payment-create');
    }

    /** View Payment Update **/
    public function viewPaymentUpdate($id)
    {
        $payment = Payment::find($id);
        return view('admin.sections.payment.payment-update', ['payment' => $payment]);
    }

    /** View Bill List **/
    public function viewBillList()
    {
        $bills = Bill::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.sections.bill.bill-list', ['bills' => $bills]);
    }

    /** View Bill Create **/
    public function viewBillCreate()
    {

        $customers = Customer::where('status', true)->get();
        return view('admin.sections.bill.bill-create', ['customers' => $customers]);
    }

    /** View Bill Update **/
    public function viewBillUpdate($id)
    {

        $bill = Bill::find($id);
        $customers = Customer::where('status', true)->get();
        return view('admin.sections.bill.bill-update', ['bill' => $bill, 'customers' => $customers]);
    }

    /** View Bill Invoice Download **/
    public function handleBillInvoiceDownload($id)
    {
        $bill = Bill::find($id);
        $customer = Customer::find($bill->customer_id);
        $company = CompanyDetail::query();
        $bill_invoice = PDF::loadView('admin.documents.bill-template', ['bill' => $bill, 'customer' => $customer, 'company' => $company]);
        return $bill_invoice->download('Invoice-' . $bill->id . '-makku-enterprises-' . str_replace(' ', '-', strtolower($customer->company_name)) . '.pdf');
        // return view('admin.documents.bill-template',['bill' => $bill, 'customer' => $customer, 'company' => $company]);
    }

    /** View Admin List **/
    public function viewAdminList()
    {
        $admins = Admin::where('id', '!=', auth()->user()->id)->paginate(2);
        return view('admin.sections.admin.admin-list', [
            'admins' => $admins
        ]);
    }

    /** View Admin Create **/
    public function viewAdminCreate()
    {
        return view('admin.sections.admin.admin-create');
    }

    /** View Admin Update **/
    public function viewAdminUpdate($id)
    {
        $admin = Admin::find($id);
        return view('admin.sections.admin.admin-update', [
            'admin' => $admin
        ]);
    }

    /** View Domain Hosting List **/
    // public function viewDomainHostingList()
    // {
    //     $domain_hostings = DomainHosting::all();

    //     dd($domain_hostings);

    //     // dd($domain_hostings);
    //     return view('admin.sections.domain-hosting.domain-hosting-list', [
    //         'domain_hostings' => $domain_hostings
    //     ]);
    // }


    public function viewDomainHostingList()
    {
        $domain_hostings = DomainHosting::all();
        $domain_hostings = $domain_hostings->map(function ($domain_hosting) {
            $domain_hosting->domain_expiry = Carbon::parse($domain_hosting->domain_purchase)->addYear();
            $domain_hosting->hosting_expiry = Carbon::parse($domain_hosting->hosting_purchase)->addYear();

            return $domain_hosting;
        });

        return view('admin.sections.domain-hosting.domain-hosting-list', [
            'domain_hostings' => $domain_hostings
        ]);
    }


    /** View Domain Hosting Create **/
    public function viewDomainHostingCreate()
    {
        $customers = Customer::where('status', true)->get();
        return view('admin.sections.domain-hosting.domain-hosting-create', [
            'customers' => $customers
        ]);
    }

    /** View Domain Hosting Update **/
    public function viewDomainHostingUpdate($id)
    {
        $domain_hosting = DomainHosting::find($id);
        $customers = Customer::where('status', true)->get();
        return view('admin.sections.domain-hosting.domain-hosting-update', [
            'domain_hosting' => $domain_hosting,
            'customers' => $customers
        ]);
    }

    /** View Password List **/
    public function viewPasswordList()
    {
        $passwords = Password::all();
        return view('admin.sections.password.password-list', [
            'passwords' => $passwords
        ]);
    }

    /** View Password Create **/
    public function viewPasswordCreate()
    {

        $customers = Customer::where('status', true)->get();
        return view('admin.sections.password.password-create', [
            'customers' => $customers
        ]);
    }

    /** View Password Update **/
    public function viewPasswordUpdate($id)
    {
        $password = Password::find($id);
        $customers = Customer::where('status', true)->get();
        return view('admin.sections.password.password-update', [
            'password' => $password,
            'customers' => $customers
        ]);
    }

    /** View Plan List **/
    public function viewPlanList(Request $request)
    {
        if ($request->city && $request->city != "All") {
            $plans = Plan::where('city', $request->city)->get();
            return view('admin.sections.plan.plan-list', [
                'plans' => $plans
            ]);
        } else {
            $plans = Plan::all();
            return view('admin.sections.plan.plan-list', [
                'plans' => $plans
            ]);
        }
    }

    /** View Plan Create **/
    public function viewPlanCreate()
    {
        return view('admin.sections.plan.plan-create');
    }

    /** View Plan Update **/
    public function viewPlanUpdate($id)
    {
        $plan = Plan::find($id);
        return view('admin.sections.plan.plan-update', [
            'plan' => $plan
        ]);
    }

    /** View Package List **/
    public function viewPackageList()
    {
        $packages = Package::all();
        return view('admin.sections.package.package-list', [
            'packages' => $packages
        ]);
    }

    /** View Package Create **/
    public function viewPackageCreate()
    {
        return view('admin.sections.package.package-create');
    }

    /** View Package Update **/
    public function viewPackageUpdate($id)
    {
        $package = Package::find($id);
        $bills = Bill::where('package_id', $id)->get();
        return view('admin.sections.package.package-update', [
            'package' => $package,
            'bills' => $bills
        ]);
    }

    /** View Package Renew **/
    public function viewPackageRenew($id)
    {
        $package = Package::find($id);
        return view('admin.sections.package.package-renew', [
            'package' => $package
        ]);
    }

    public function viewCompanyPaymentCreate()
    {
        return view('admin.sections.company-payment.payment-create');
    }
}