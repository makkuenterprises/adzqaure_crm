<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class EmployeePaymentController extends Controller
{
   /** View Payment List **/
    public function viewPaymentList()
    {
        $payments = Payment::all();
        return view('employee.sections.payment.payment-list', ['payments' => $payments]);
    }

    /** View Payment Create **/
    public function viewPaymentCreate()
    {
        return view('employee.sections.payment.payment-create');
    }

    /** View Payment Update **/
    public function viewPaymentUpdate($id)
    {
        $payment = Payment::find($id);
        return view('employee.sections.payment.payment-update', ['payment' => $payment]);
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
                return redirect()->route('employee.view.payment.list')->with('message', [
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


}
