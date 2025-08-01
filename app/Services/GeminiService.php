<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class GeminiService
{
    protected $apiKey;
    protected $apiEndpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
    }

    public function ask($message)
    {
        if (!$this->apiKey) {
            Log::error('Gemini API key is not set.');
            return 'AI service is not configured. Please add GEMINI_API_KEY to your .env file.';
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("{$this->apiEndpoint}?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => 'You are a helpful customer support agent.'],
                            ['text' => $message],
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.9,
                    'topK' => 1,
                    'topP' => 1,
                    'maxOutputTokens' => 2048,
                    'stopSequences' => [],
                ],
            ]);

            // This will automatically throw an exception for HTTP errors (4xx or 5xx)
            $response->throw();

            $json = $response->json();

            // Log the successful response for debugging purposes
            Log::info('Gemini API response:', $json);

            // Safely access the response text
            $text = $json['candidates'][0]['content']['parts'][0]['text'] ?? null;

            return $text ?: 'The AI returned a response I couldn’t understand.';

        } catch (RequestException $e) {
            // Log the detailed error from the API
            Log::error('Gemini API HTTP error', [
                'status' => $e->response->status(),
                'body' => $e->response->body(),
            ]);
            return 'The AI service is currently unavailable. Please try again later.';
        } catch (\Exception $e) {
            Log::error('GeminiService Exception: ' . $e->getMessage());
            return 'A system error occurred while contacting the AI service.';
        }
    }
}
