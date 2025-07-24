<?php

namespace App\Http\Controllers\Employee;

use PDF;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Customer;
use App\Models\CompanyDetail;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Validator;

class EmployeeBillController extends Controller
{
    /** View Bill List **/
    public function viewBillList()
    {

        $paymentHistory = PaymentHistory::all();
        $bills = Bill::with('paymentHistories')->latest()->paginate(10);
        $bills = Bill::orderBy('created_at', 'desc')->paginate(10);
        return view('employee.sections.bill.bill-list', ['bills' => $bills, 'paymentHistory' => $paymentHistory]);
    }

    /** View Bill Create **/
    public function viewBillCreate()
    {

        $customers = Customer::where('status', true)->get();
        $serviceCategories = ServiceCategory::orderBy('name')->get();
        $allServices = Service::orderBy('service_name')->get();
        $allServicesGrouped = $allServices->groupBy('service_category_id');
        $allServicesForLookup = $allServices->keyBy('id');

        return view('employee.sections.bill.bill-create', compact(
            'customers',
            'serviceCategories',
            'allServicesGrouped',
            'allServicesForLookup'
        ));
    }

    /** View Bill Update **/
    public function viewBillUpdate($id)
    {

        $bill = Bill::find($id);
        $customers = Customer::where('status', true)->get();
        $serviceCategories = ServiceCategory::all();
        $services = Service::all();
        return view('employee.sections.bill.bill-update', compact('customers', 'serviceCategories', 'services'));
    }


    /** View Bill Invoice Download **/
    public function handleBillInvoiceDownload($id)
    {
        $bill = Bill::find($id);
        $customer = Customer::find($bill->customer_id);
        $company = CompanyDetail::query();
        $bill_invoice = PDF::loadView('employee.documents.bill-template', ['bill' => $bill, 'customer' => $customer, 'company' => $company]);
        return $bill_invoice->download('Invoice-' . $bill->id . '-adzquare-' . str_replace(' ', '-', strtolower($customer->company_name)) . '.pdf');
        // return view('admin.documents.bill-template',['bill' => $bill, 'customer' => $customer, 'company' => $company]);
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
            'discount_percentage' => ['nullable', 'numeric', 'min:0'], // <-- ADDED: Validation for discount percentage
            'discount_amount' => ['nullable', 'numeric', 'min:0'],
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

            // --- Calculation & Saving Logic ---
            $total = (float)($request->input('total') ?? 0);
            $discountAmount = (float)($request->input('discount_amount') ?? 0);
            $tax = (float)($request->input('tax') ?? 0);
            $netPayable = $total - $discountAmount + $tax; // Calculate net payable

            $bill = new Bill();
            $bill->customer_id = $request->input('customer_id');
            $bill->items = json_encode($items);
            if ($request->apply_gst) {
                $bill->tax = $request->input('tax');
            }
            $bill->payment_status = $request->input('payment_status');
            $bill->total = $request->input('total');
            $bill->discount_percentage = $request->input('discount_percentage') ?? 0;
            $bill->discount_amount = $request->input('discount_amount') ?? 0;
            $bill->net_payable = $netPayable; // <-- SAVE THE CALCULATED NET PAYABLE
            $bill->bill_date = $request->input('bill_date');
            $bill->due_date = $request->input('due_date');
            $bill->invoice_currency = $request->input('invoice_currency');
            $bill->bill_note = $request->input('bill_note');
            $result = $bill->save();

            if ($result) {
                return redirect()->route('employee.view.bill.list')->with('message', [
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
            return redirect()->route('employee.view.bill.update', ['id' => $duplicate_bill->id])->with('message', [
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


    public function showHistory($billId)
    {
        $bill = Bill::findOrFail($billId);
        $total_received = PaymentHistory::where('bill_id', $billId)->sum('received_amount') ?? 0;
        $payment_histories = PaymentHistory::where('bill_id', $billId)->latest()->paginate(10);

        return view('employee.sections.bill.history', compact('bill', 'payment_histories', 'total_received'));
    }

   // In your PaymentHistoryController.php

public function storeHistory(Request $request, $billId)
{
    $bill = Bill::findOrFail($billId);

    // 1. Calculate the total remaining balance. We only use this for validation.
    $due_amount = max(0, $bill->net_payable - $bill->received_amount);

    if ($due_amount <= 0) {
        return redirect()->back()->with('error', 'This bill is already fully paid.');
    }

    // 2. Validate the user's input against the total remaining balance.
    $validatedData = $request->validate([
        // We are validating the 'received_amount' from the FORM INPUT
        'received_amount' => "required|numeric|min:0.01|max:{$due_amount}",
        'payment_method' => 'nullable|string|max:255',
        'notes' => 'nullable|string|max:1000',
    ], [
        'received_amount.max' => 'The received amount cannot be greater than the due amount of ₹' . number_format($due_amount, 2),
    ]);


    // 3. Create the history record using THE VALIDATED DATA FROM THE REQUEST.
    PaymentHistory::create([
        'bill_id' => $bill->id,
        // THIS IS THE KEY: Use the validated 'received_amount', NOT $due_amount
        'received_amount' => $validatedData['received_amount'], // <-- Using the amount from the form (e.g., 1000)
        'payment_method' => $validatedData['payment_method'],
        'notes' => $validatedData['notes'],
    ]);

    // 4. Update the master bills table using THE VALIDATED DATA FROM THE REQUEST.
    $bill->increment(
        'received_amount',
        $validatedData['received_amount'] // <-- Using the amount from the form (e.g., 1000)
    );

    // --- LOGIC TO UPDATE STATUS ---
    // 5. Refresh the bill model to get the latest data from the database.
    $bill->refresh();

    // 6. Check if the bill is now fully paid.
    if ($bill->received_amount >= $bill->net_payable) {
        $bill->payment_status = 'Paid'; // Make sure your column name is 'payment_status' or 'status'
        $bill->save();
    }

    return redirect()->back()->with('success', 'Payment of ₹' . $validatedData['received_amount'] . ' added successfully.');
}

public function settleBill(Request $request, $billId)
    {
        $bill = Bill::findOrFail($billId);

        // 1. Calculate the actual remaining due amount to be settled.
        $settlementAmount = max(0, $bill->net_payable - $bill->received_amount);

        // 2. Safety check: if there's nothing to settle, do nothing.
        if ($settlementAmount <= 0) {
            return redirect()->back()->with('info', 'This bill is already paid or settled.');
        }

        // 3. Log this settlement action in the payment history for auditing.
        PaymentHistory::create([
            'bill_id' => $bill->id,
            'received_amount' => $settlementAmount, // Storing the settled amount here for consistency
            'payment_method' => 'SETTLEMENT', // A clear flag to identify this transaction type
            'notes' => "Invoice settled. Remaining due of ₹" . number_format($settlementAmount, 2) . " written off.",
        ]);

        // 4. Update the master bill:
        // - Increment the discount amount by the settled amount.
        // - Set the status to 'Paid'.
        $bill->increment('discount_amount', $settlementAmount);
        $bill->payment_status = 'Settled';
        $bill->save();

        return redirect()->back()->with('success', 'Invoice has been successfully settled.');
    }


}
