<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    public function ask($message)
    {
        try {
            $apiKey = env('GEMINI_API_KEY');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => 'You are a helpful customer support agent.'],
                            ['text' => $message],
                        ]
                    ]
                ]
            ]);

            if (!$response->successful()) {
                Log::error('Gemini API HTTP error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return 'AI service is currently unavailable.';
            }

            $json = $response->json();

            // Optional: Log entire response for debugging
            Log::info('Gemini API response:', $json);

            $text = $json['candidates'][0]['content']['parts'][0]['text'] ?? null;

            return $text ?: 'I couldn’t generate a proper reply.';
        } catch (\Exception $e) {
            Log::error('GeminiService Exception: ' . $e->getMessage());
            return 'Something went wrong while contacting AI.';
        }
    }
}
