<?php

declare(strict_types=1);

return [
    'api_key' => env('GEMINI_API_KEY'),
    'model' => 'gemini-1.5-flash-latest', // <-- VERIFY THIS LINE
    'base_url' => env('GEMINI_BASE_URL'),
];
