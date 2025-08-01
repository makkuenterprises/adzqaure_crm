<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Message;

class ChatController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function handleChat(Request $request)
    {
        // 1. VALIDATE: Adjust validation to expect 'prompt' instead of 'message'.
        $request->validate([
            'prompt' => 'required|string|max:1000',
        ]);

        $userMessage = $request->input('prompt');

        // 2. MANAGE SESSION: Get or create the session_id from the Laravel session.
        // This is more secure and reliable than passing it from the client.
        $sessionId = $request->session()->get('chat_session_id');
        if (!$sessionId) {
            $sessionId = (string) Str::uuid();
            $request->session()->put('chat_session_id', $sessionId);
        }

        $userId = auth()->id(); // Works if the user is logged in.

        // 3. SAVE USER MESSAGE: (No changes here)
        Message::create([
            'session_id' => $sessionId,
            'user_id' => $userId,
            'role' => 'user',
            'content' => $userMessage,
        ]);

        // 4. GET HISTORY: Retrieve context for the conversation.
        // The previous logic was incorrect; it included the message we just added.
        // We should get history *before* the current message.
        $history = Message::where('session_id', $sessionId)
                            ->where('role', '!=', 'user') // Optional: only use model responses as context to save tokens
                            ->orderBy('created_at', 'desc') // Get the most recent
                            ->limit(10) // Limit context length
                            ->get()
                            ->reverse() // Put them back in chronological order
                            ->map(function ($msg) {
                                return ['role' => $msg->role, 'text' => $msg->content];
                            })
                            ->toArray();


        // 5. GET AI RESPONSE: (No changes here, it just works)
        $aiResponse = $this->geminiService->getResponse($userMessage, $history);

        // 6. SAVE AI RESPONSE: (No changes here)
        Message::create([
            'session_id' => $sessionId,
            'user_id' => $userId,
            'role' => 'model',
            'content' => $aiResponse,
        ]);

        // 7. RETURN RESPONSE: Adjust the JSON key to 'response' to match the frontend JS.
        return response()->json([
            'response' => $aiResponse,
        ]);
    }
}
