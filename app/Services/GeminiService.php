<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    public function ask($message)
    {
        $apiKey = env('GEMINI_API_KEY');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => 'You are a helpful customer support agent for our Laravel website.'],
                        ['text' => $message],
                    ]
                ]
            ]
        ]);

        return $response->json('candidates.0.content.parts.0.text') ?? 'Sorry, I could not understand that.';
    }
}
