<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;

class PaymentHistoryController extends Controller
{
    public function showHistory($billId)
    {
        $bill = Bill::findOrFail($billId);
        $total_received = PaymentHistory::where('bill_id', $billId)->sum('received_amount') ?? 0;
        $payment_histories = PaymentHistory::where('bill_id', $billId)->latest()->paginate(10);

        return view('admin.sections.bill.history', compact('bill', 'payment_histories', 'total_received'));
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
}
