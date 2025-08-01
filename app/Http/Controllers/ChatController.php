<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
// We will use the base Client directly, not the Facade
use GeminiAPI\Client as GeminiClient;

class ChatController extends Controller
{
    public function chat(Request $request)
    {

        dd('THE CACHE IS CLEARED! THIS IS THE NEW CONTROLLER.');
        $request->validate(['prompt' => 'required|string']);

        try {
            // =================== THE DIRECT METHOD TEST ===================

            // 1. Manually create the Gemini Client with your key.
            //    REPLACE 'YOUR_GEMINI_API_KEY_HERE' with your actual key.
            $client = new GeminiClient("AIzaSyDEB6UjI_dkD-Y7ihTKh0yCTu9FW6ARMb8");

            // 2. Select the model and generate the text directly.
            //    We are hardcoding the correct model name here.
            $response = $client
                ->gemini('gemini-1.5-flash-latest') // Use the correct model
                ->generateContent($request->input('prompt'));

            // =============================================================

            // Return the successful response
            return response()->json(['response' => $response->text()]);

        } catch (\Exception $e) {
            // If it fails, log the real error and return a generic one.
            Log::error('Direct Method Gemini API Error: ' . $e->getMessage());
            return response()->json(['error' => 'The AI service failed to connect.'], 500);
        }
    }
}
