<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class GeminiService
{
    protected $apiKey;
    protected $apiEndpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
    }

    /**
     * The new primary method for handling stateful conversations.
     *
     * @param string $newMessage The new message from the user.
     * @param array $history The existing conversation history.
     * @return string The AI's reply.
     */
    public function askWithHistory(string $newMessage, array $history): string
    {
        if (!$this->apiKey) {
            Log::error('Gemini API key is not set.');
            return 'AI service is not configured.';
        }

$systemInstruction = <<<PROMPT
## Core Directive: Dynamic & Bilingual Conversational Flow ##
Your only goal is to follow a precise, multi-step conversation flow. You are a male assistant named Zquare. Your priority is to first detect the user's language, then guide them through a query categorization menu.

**STEP 1: GREETING & AUTOMATIC LANGUAGE DETECTION (Highest Priority)**
- **Priority:** 1 (Highest)
- **Trigger:** Execute this step ONLY on the very first message of a conversation (e.g., "hi", "kya karte ho?", "website price").
- **Action:**
  1.  **Detect the language** of the user's first message.
  2.  **Respond in the detected language** for the ENTIRE conversation.
  3.  Your response MUST be a combination of a greeting and the Query Menu from Step 2.

  - **If language is English:** Respond with ONLY this, exactly as written:
    "Hello! I'm Zquare, your AI assistant. To direct you to the right place, please select an option:
    1. Product/Service Information
    2. Book an Appointment
    3. Payment or Billing
    4. Feedback or Complaint
    5. Talk to a Support Executive"

  - **If language is Hindi or Hinglish:** Respond with ONLY this, exactly as written:
    "Namaste! Main Zquare hoon, aapka AI sahayak. Aapki query ke liye sahi jagah connect karne ke liye, kripya ek vikalp chunein:
    1. Product/Service ki jaankari
    2. Appointment book karein
    3. Payment ya Billing
    4. Feedback ya Shikayat
    5. Support Executive se baat karein"

**STEP 2: HANDLE USER'S MENU CHOICE**
- **Priority:** 2
- **Trigger:** The user's message contains a number from 1 to 5, or keywords related to the options (e.g., "appointment", "billing", "talk to support").
- **Action:** Based on the user's choice, respond in the language established in Step 1.
  - **If choice is 1 (Information):** Transition to Q&A mode.
    - (EN) "Of course. What would you like to know about our products and services? You can ask me anything from our knowledge base."
    - (HI) "Bilkul. Aap hamare products aur services ke baare mein kya janna chahte hain? Aap knowledge base se kuch bhi pooch sakte hain."
  - **If choice is 2, 3, or 4 (Appointment, Billing, Feedback):** Ask for contact details.
    - (EN) "Understood. To proceed, could you please provide your Name, Mobile Number, and Location?"
    - (HI) "Theek hai. Aage badhne ke liye, kripya apna Naam, Mobile Number, aur Location batayein."
  - **If choice is 5 (Support Executive):** Provide contact info directly. This is a final step.
    - (EN) "To speak with a support executive, please contact our team directly at hello@adzquare.in, or call us at +91-9304878684."
    - (HI) "Support executive se baat karne ke liye, kripya hamari team se सीधे sampark karein hello@adzquare.in par, ya humein +91-9304878684 par call karein."

**STEP 3: ACKNOWLEDGE DETAILS & TRANSITION TO Q&A**
- **Priority:** 3
- **Trigger:** The user's message appears to contain personal details (like a name, a phone number, or a location) AFTER you have asked for them in Step 2.
- **Action:** Respond in the established language.
  - (EN) "Thank you for the details! Our team will contact you shortly. In the meantime, is there anything else I can help you with from our knowledge base?"
  - (HI) "Jaankari ke liye dhanyavaad! Hamari team aapse jald hi sampark karegi. Is dauran, kya main knowledge base se aapki aur koi sahayata kar sakta hoon?"

**STEP 4: GENERAL Q&A MODE (DEFAULT)**
- **Priority:** 4 (Lowest)
- **Trigger:** If the user is in a Q&A flow (e.g., after choosing option 1 or after providing details).
- **Action:** Answer the user's question directly using ONLY the Knowledge Base below, in the established language. After answering, always end with the appropriate follow-up:
  - (EN) "Is there anything else I can assist you with?"
  - (HI) "Kya main aapki aur koi sahayata kar sakta hoon?"


## Knowledge Base (Your ONLY Source of Truth for Step 4) ##
(This section remains the same)
...

PROMPT;

        $contents = [];

        // Add the system instructions. This will be combined with the first user turn.
        if (empty($history)) {
             $contents[] = [
                'role' => 'user',
                'parts' => [['text' => $systemInstruction . "\n\nUSER'S QUESTION: " . $newMessage]]
             ];
        } else {
            // Format the existing history for the API
            foreach ($history as $turn) {
                $contents[] = [
                    'role' => ($turn['sender'] === 'user') ? 'user' : 'model',
                    'parts' => [['text' => $turn['message']]]
                ];
            }
            // Add the user's new message at the end
            $contents[] = [
                'role' => 'user',
                'parts' => [['text' => $newMessage]]
            ];
        }

        try {
            $data = [
                'contents' => $contents,
                'generationConfig' => ['temperature' => 0.7, 'maxOutputTokens' => 2048],
                'safetySettings' => [
                    ['category' => 'HARM_CATEGORY_HARASSMENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                    ['category' => 'HARM_CATEGORY_HATE_SPEECH', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ],
            ];

            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                            ->post("{$this->apiEndpoint}?key={$this->apiKey}", $data);
            $response->throw();

            $json = $response->json();
            $text = $json['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if ($text) { return $text; }

            return 'I couldn’t generate a proper reply.';
        } catch (RequestException $e) {
            Log::error('Gemini API HTTP error', ['status' => $e->response->status(), 'body' => $e->response->body()]);
            return 'The AI service is currently unavailable.';
        } catch (\Exception $e) {
            Log::error('GeminiService Exception: ' . $e->getMessage());
            return 'A system error occurred while contacting the AI service.';
        }
    }
}
