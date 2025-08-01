<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiService;

class ChatController extends Controller
{
    public function handle(Request $request)
    {
        $message = $request->input('message');

        if (!$message) {
            return response()->json(['reply' => 'Please enter a message.'], 400);
        }

        $gemini = new GeminiService();
        $reply = $gemini->ask($message);

        return response()->json(['reply' => $reply]);
    }
}
