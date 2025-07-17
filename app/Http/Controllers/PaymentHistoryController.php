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

    public function storeHistory(Request $request, $billId)
    {
        $bill = Bill::findOrFail($billId);

        $request->validate([
            'received_amount' => 'required|numeric|min:0.01',
            'payment_method' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        PaymentHistory::create([
            'bill_id' => $bill->id,
            'received_amount' => $request->received_amount,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Payment added successfully.');
    }
}
