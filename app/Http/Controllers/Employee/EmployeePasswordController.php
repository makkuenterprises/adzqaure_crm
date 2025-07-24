<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EmployeePasswordController extends Controller
{
        public function viewPasswordList(Request $request)
    {

        $customerId = $request->input('customer_id');
        if ($customerId) {
            $passwords = Password::where('customer_id', $customerId)->paginate(10);
        } else {
            $passwords = Password::paginate(10);
        }
        $customers = DB::table('customers')->get();

        return view('employee.sections.password.password-list', [
            'passwords' => $passwords,
            'customers' => $customers
        ]);
    }


    /** View Password Create **/
    public function viewPasswordCreate()
    {

        $customers = Customer::where('status', true)->get();
        return view('employee.sections.password.password-create', [
            'customers' => $customers
        ]);
    }

    /** View Password Update **/
    public function viewPasswordUpdate($id)
    {
        $password = Password::find($id);
        $customers = Customer::where('status', true)->get();
        return view('employee.sections.password.password-update', [
            'password' => $password,
            'customers' => $customers
        ]);
    }


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
    | Handle Password Delete
    |--------------------------------------------------------------------------
    */
    public function handlePasswordDelete($id)
    {
        $password = Password::find($id);
        $password->delete();
        return redirect()->route('employee.view.password.list')->with('message', [
            'status' => 'success',
            'title' => 'Password Deleted',
            'description' => 'The password is successfully deleted'
        ]);
    }


}
