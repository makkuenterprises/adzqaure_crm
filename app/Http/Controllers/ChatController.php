<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GeminiAPI\Laravel\Facades\Gemini;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate(['prompt' => 'required|string']);

        try {
            $response = Gemini::generateText($request->input('prompt'));
            return response()->json(['response' => $response]);

        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage());
            return response()->json(['error' => 'The AI service is currently unavailable.'], 500);
        }
    }
}
