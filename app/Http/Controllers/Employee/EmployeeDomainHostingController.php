<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\DomainHosting;
use Carbon\Carbon;

class EmployeeDomainHostingController extends Controller
{

    public function viewDomainHostingList()
    {
        $domain_hostings = DomainHosting::orderBy('created_at', 'desc')->paginate(10);
        $domain_hostings->getCollection()->transform(function ($domain_hosting) {
            $domain_hosting->domain_expiry = Carbon::parse($domain_hosting->domain_purchase)->addYear();
            $domain_hosting->hosting_expiry = Carbon::parse($domain_hosting->hosting_purchase)->addYear();

            return $domain_hosting;
        });

        // Return the view with the paginated domain hostings
        return view('employee.sections.domain-hosting.domain-hosting-list', [
            'domain_hostings' => $domain_hostings
        ]);
    }




    /** View Domain Hosting Create **/
    public function viewDomainHostingCreate()
    {
        $customers = Customer::where('status', true)->get();
        return view('employee.sections.domain-hosting.domain-hosting-create', [
            'customers' => $customers
        ]);
    }

    /** View Domain Hosting Update **/
    public function viewDomainHostingUpdate($id)
    {
        $domain_hosting = DomainHosting::find($id);
        $customers = Customer::where('status', true)->get();
        return view('employee.sections.domain-hosting.domain-hosting-update', [
            'domain_hosting' => $domain_hosting,
            'customers' => $customers
        ]);
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
    | Handle Domain Hosting Delete
    |--------------------------------------------------------------------------
    */
    public function handleDomainHostingDelete($id)
    {
        $domain_hosting = DomainHosting::find($id);
        $domain_hosting->delete();
        return redirect()->route('employee.view.domain.hosting.list')->with('message', [
            'status' => 'success',
            'title' => 'Domain Hosting Deleted',
            'description' => 'The domain hosting is successfully deleted'
        ]);
    }


}
