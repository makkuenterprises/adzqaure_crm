<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    protected $geminiService;

    /**
     * Use dependency injection to get the GeminiService instance.
     * Laravel's service container handles this automatically.
     */
    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    /**
     * Handle the incoming chat message from the frontend.
     */
    public function handle(Request $request)
    {
        // Use Laravel's validator for robust input checking.
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $message = $request->input('message');

        // Call the 'ask' method on the injected service instance.
        $reply = $this->geminiService->ask($message);

        return response()->json(['reply' => $reply]);
    }
}
