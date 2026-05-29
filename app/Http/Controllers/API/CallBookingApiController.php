<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CallBooking;
use Illuminate\Support\Facades\Validator;

class CallBookingApiController extends Controller
{
    /**
     * 1. Customer: View own booked calls list
     */
    public function getCustomerBookings(Request $request)
    {
        $customer = $request->user();

        $bookings = CallBooking::where('customer_id', $customer->id)
            ->orderBy('scheduled_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'bookings' => $bookings
        ]);
    }

    /**
     * 2. Customer: Book a new support call
     */
    public function bookCall(Request $request)
    {
        $customer = $request->user();

        $validator = Validator::make($request->all(), [
            'scheduled_at' => 'required|date|after:now', // Must be scheduled in the future
            'topic' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $booking = CallBooking::create([
            'customer_id' => $customer->id,
            'scheduled_at' => $request->scheduled_at,
            'topic' => $request->topic,
            'status' => 'Pending',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Call booked successfully.',
            'booking' => $booking
        ], 201);
    }

    /**
     * 3. Employee: View all booked calls schedule
     */
    /**
     * 3. Employee: View all booked calls schedule (With Debug Info)
     */
    public function getEmployeeBookings()
    {
        try {
            $bookings = CallBooking::with('customer')
                ->orderBy('scheduled_at', 'desc')
                ->get();

            return response()->json([
                'status' => 'success',
                'bookings' => $bookings
            ]);

        } catch (\Exception $e) {
            // Returns the exact SQL/PHP error message to your browser's network tab
            return response()->json([
                'status' => 'error',
                'debug_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    /**
     * 4. Employee: Update call status & add follow-up remarks
     */
    public function updateBookingStatus(Request $request, $id)
    {
        $booking = CallBooking::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Pending,Completed,Cancelled',
            'employee_remarks' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $booking->update([
            'status' => $request->status,
            'employee_remarks' => $request->employee_remarks,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Call status updated successfully.',
            'booking' => $booking
        ]);
    }
}
