<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ChatApiController extends Controller
{
    /**
     * Customer fetches their active chat history thread (GET /v1/customer/chat/messages)
     */
    public function getCustomerMessages(Request $request)
    {
        $customer = $request->user();

        $messages = Message::where('customer_id', $customer->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'status' => 'success',
            'messages' => $messages
        ], 200);
    }

    /**
     * Customer sends a message (Text, Image Base64, or Voice Base64) (POST /v1/customer/chat/messages)
     */
    public function sendCustomerMessage(Request $request)
    {
        $customer = $request->user();

        $validator = Validator::make($request->all(), [
            'message' => 'nullable|string',
            'type' => 'required|in:text,image,voice',
            'image_base64' => 'nullable|string',
            'voice_base64' => 'nullable|string',
            'voice_duration' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $type = $request->type;
        $mediaUrl = null;

        // --- CASE 1: PROCESSING BASE64 IMAGE UPLOAD ---
        if ($type === 'image' && $request->filled('image_base64')) {
            $imageData = $request->input('image_base64');

            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $match)) {
                try {
                    $extension = strtolower($match[1]); // png, jpeg, webp
                    $rawBinary = base64_decode(substr($imageData, strpos($imageData, ',') + 1));

                    $fileName = time() . '_' . uniqid() . '.' . $extension;
                    $directory = public_path('chat/images');

                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0755, true);
                    }

                    File::put($directory . '/' . $fileName, $rawBinary);

                    // Construct the absolute secure URL to return to Flutter
                    $mediaUrl = asset('chat/images/' . $fileName);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to process image payload: ' . $e->getMessage()
                    ], 400);
                }
            }
        }

        // --- CASE 2: PROCESSING BASE64 VOICE NOTE UPLOAD ---
        if ($type === 'voice' && $request->filled('voice_base64')) {
            $voiceData = $request->input('voice_base64');

            if (preg_match('/^data:audio\/(\w+);base64,/', $voiceData, $match)) {
                try {
                    $extension = strtolower($match[1]); // aac, mp3, m4a
                    $rawBinary = base64_decode(substr($voiceData, strpos($voiceData, ',') + 1));

                    $fileName = time() . '_' . uniqid() . '.' . $extension;
                    $directory = public_path('chat/voice');

                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0755, true);
                    }

                    File::put($directory . '/' . $fileName, $rawBinary);

                    $mediaUrl = asset('chat/voice/' . $fileName);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to process voice note payload: ' . $e->getMessage()
                    ], 400);
                }
            }
        }

        // Create the message row inside SQL database
        $newMessage = Message::create([
            'customer_id' => $customer->id,
            'sender_type' => 'customer',
            'message' => $request->message ?? '',
            'type' => $type,
            'media_url' => $mediaUrl,
            'voice_duration' => $request->voice_duration,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Message delivered.',
            'data' => $newMessage
        ], 201);
    }
}
