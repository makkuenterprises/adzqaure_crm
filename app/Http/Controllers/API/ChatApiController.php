<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class ChatApiController extends Controller
{
    /**
     * 1. Customer: Fetch own chat messages (With Debug Info)
     */
    public function getCustomerMessages(Request $request)
    {
        try {
            $customer = $request->user();

            // Mark all incoming employee/admin messages in this thread as Read
            ChatMessage::where('customer_id', $customer->id)
                ->where('sender_type', '!=', 'customer')
                ->update(['is_read' => true]);

            $messages = ChatMessage::where('customer_id', $customer->id)
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json([
                'status' => 'success',
                'messages' => $messages
            ]);

        } catch (\Exception $e) {
            // Returns the exact error message (e.g. missing import, typo) directly to your browser
            return response()->json([
                'status' => 'error',
                'debug_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    /**
     * 2. Customer: Send message (Support Text, Image, Voice, Document, or Location)
     */
    public function sendCustomerMessage(Request $request)
    {
        $customer = $request->user();

        $validator = Validator::make($request->all(), [
            'message_type' => 'required|in:text,image,voice,document,location',
            'message' => 'nullable|required_if:message_type,text,location|string',
            'file' => 'nullable|required_if:message_type,image,voice,document|file|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $filePath = null;
        $fileName = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('uploads/chat');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $uniqueName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $uniqueName);
            $filePath = 'uploads/chat/' . $uniqueName;
        }

        $chatMessage = ChatMessage::create([
            'customer_id' => $customer->id,
            'sender_type' => 'customer',
            'sender_id' => $customer->id,
            'message_type' => $request->message_type,
            'message' => $request->message,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'is_read' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Message sent successfully.',
            'data' => $chatMessage // <-- Passed securely under 'data'
        ], 201);
    }

    /**
     * 3. Employee: List active customer chat threads
     */
    public function getEmployeeChatRooms()
    {
        // Lists all customers along with their last message received
        $rooms = Customer::select('id', 'name', 'email', 'profile')
            ->get()
            ->map(function ($customer) {
                $lastMsg = ChatMessage::where('customer_id', $customer->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                $unreadCount = ChatMessage::where('customer_id', $customer->id)
                    ->where('sender_type', 'customer')
                    ->where('is_read', false)
                    ->count();

                $customer->last_message = $lastMsg;
                $customer->unread_count = $unreadCount;
                return $customer;
            })->filter(function ($customer) {
                return !is_null($customer->last_message); // Only display rooms that have chats
            })->values();

        return response()->json([
            'status' => 'success',
            'rooms' => $rooms
        ]);
    }

    /**
     * 4. Employee: Get messages with a specific customer
     */
    public function getEmployeeMessages($customerId)
    {
        // Mark all customer messages in this thread as Read
        ChatMessage::where('customer_id', $customerId)
            ->where('sender_type', 'customer')
            ->update(['is_read' => true]);

        $messages = ChatMessage::where('customer_id', $customerId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'status' => 'success',
            'messages' => $messages
        ]);
    }

    /**
     * 5. Employee: Send reply to customer
     */
    public function sendEmployeeMessage(Request $request, $customerId)
    {
        $employee = $request->user();

        $validator = Validator::make($request->all(), [
            'message_type' => 'required|in:text,image,voice,document,location',
            'message' => 'nullable|required_if:message_type,text,location|string',
            'file' => 'nullable|required_if:message_type,image,voice,document|file|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $filePath = null;
        $fileName = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('uploads/chat');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $uniqueName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $uniqueName);
            $filePath = 'uploads/chat/' . $uniqueName;
        }

        $chatMessage = ChatMessage::create([
            'customer_id' => $customerId,
            'sender_type' => $employee->type ?? 'employee', // Fallback to employee type
            'sender_id' => $employee->id,
            'message_type' => $request->message_type,
            'message' => $request->message,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'is_read' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Message sent successfully.',
            'data' => $chatMessage // <-- Passed securely under 'data'
        ], 201);
    }
}
