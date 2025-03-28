<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Group;
use App\Models\Campaign;
use App\Models\Lead;
use Carbon\Carbon;
use Storage;
use Hash;
use DB;

/*
|--------------------------------------------------------------------------
| Employee Update Controller
|--------------------------------------------------------------------------
|
| Update operations for employee are handled from this controller.
|
*/

interface EmployeeUpdate
{
    public function handleAccountInformationUpdate(Request $request);
    public function handleAccountPasswordUpdate(Request $request);   
}

class EmployeeUpdateController extends Controller implements EmployeeUpdate
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

    /*
    |--------------------------------------------------------------------------
    | Handle Account Information Update
    |--------------------------------------------------------------------------
    */
    public function handleAccountInformationUpdate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:1', 'max:250'],
            'email' => ['required', 'string', 'min:1', 'max:250', Rule::unique('employees')->ignore(auth()->user('employee')->id, 'id')],
            'phone' => ['required', 'numeric', 'digits_between:10,20', Rule::unique('employees')->ignore(auth()->user('employee')->id, 'id')],
            'profile' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp'],
            'account_password' => ['required', 'string', 'min:1', 'max:250'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            if (Hash::check($request->input('account_password'), auth()->user('employee')->password)) {

                $employee = Employee::find(auth()->user('employee')->id);
                $employee->name = $request->input('name');
                $employee->email = $request->input('email');
                $employee->phone = $request->input('phone');
                if ($request->hasFile('profile')) {
                    if (!is_null(auth()->user('employee')->profile))
                        Storage::delete(auth()->user('employee')->profile);
                    $employee->profile = $request->file('profile')->store('employees');
                }
                $result = $employee->update();

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
            if (Hash::check($request->input('current_password'), auth()->user('employee')->password)) {

                $employee = Employee::find(auth()->user('employee')->id);
                $employee->password = Hash::make($request->input('password'));
                $result = $employee->update();

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
}
