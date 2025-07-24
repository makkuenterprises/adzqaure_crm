<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeCustomerController extends Controller
{
        /** View Customer List **/
    public function viewCustomerList()
    {

        $customers = Customer::where('type', 'customer')->orderBy('created_at', 'desc')->paginate(10);
        $totalCustomers = Customer::where('type', 'customer')->count();
        $activeCustomers = Customer::where('status', 1)->where('type', 'customer')->count();
        $inactiveCustomers = Customer::where('status', 0)->where('type', 'customer')->count();
        return view('employee.sections.customer.customer-list', [
            'customers' => $customers,
            'totalCustomers' => $totalCustomers,
            'activeCustomers' => $activeCustomers,
            'inactiveCustomers' => $inactiveCustomers,
        ]);
    }


    /** View Customer Create **/
    public function viewCustomerCreate()
    {
        return view('employee.sections.customer.customer-create');
    }

    /** View Customer Update **/
    public function viewCustomerUpdate($id)
    {
        $customer = Customer::find($id);
        return view('employee.sections.customer.customer-update', ['customer' => $customer]);
    }

    /** View Customer Preview **/
    public function viewCustomerPreview($id)
    {
        // $customer = Customer::find($id);
        // $projects = Project::where('customer_id', $id)->get();
        $customer = Customer::findOrFail($id);
        $projects = $customer->projects()->paginate(5);
        $bills = $customer->bills()->paginate(10, ['*'], 'bills_page');
        $domainHostings = $customer->domainHostings()->paginate(10, ['*'], 'dh_page');
        $passwords = $customer->passwords()->paginate(10, ['*'], 'passwords_page');
        return view('employee.sections.customer.customer-preview', ['customer' => $customer, 'projects' => $projects, 'bills' => $bills, 'domainHostings' => $domainHostings, 'passwords' => $passwords]);
    }

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

            // Call Google Apps Script API to create space
            // $scriptUrl = "https://script.google.com/macros/s/AKfycbzUBCEw9xXe60L1EHV-pwLPJyr6wfQFmQ9YEOiUIQyZOIY00PsYrb3ZmRgDsAcwg75AeA/exec";
            // $response = Http::post($scriptUrl, ['customerName' => $customer->name]);

            // if ($response->successful()) {
            //     $spaceId = $response->json(); // Get space ID
            //     $chatUrl = "https://mail.google.com/chat/#chat/space/" . $spaceId;

            //     // Save the space URL in the database
            //     $customer->google_chat_space_url = $chatUrl;
            //     $customer->save();
            // }

            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('employee/customers'), $filename);
                $customer->profile =  $filename;
            }

            $result = $customer->save();


            if ($result) {
                return redirect()->route('employee.view.customer.list')->with('message', [
                    'status' => 'success',
                    'title' => 'Customer created',
                    // 'chat_url' => $chatUrl,
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
                if ($customer->profile && file_exists(public_path('employee/customers/' . $customer->profile))) {
                    unlink(public_path('employee/customers/' . $customer->profile));
                }
                $file = $request->file('profile');
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('employee/customers'), $filename);
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


}
