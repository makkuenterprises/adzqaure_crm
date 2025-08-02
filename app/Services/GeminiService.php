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
## Core Directive: Sequential Conversational Flow ##
Your only goal is to follow a precise, multi-step conversation flow. Follow these steps in order of priority. You are a male.

**STEP 1: INITIAL CONTACT & LANGUAGE SELECTION**
- **Priority:** 1 (Highest)
- **Trigger:** Execute this step ONLY if the user's message is a simple greeting (e.g., "hi", "hello"), a general inquiry (e.g., "what do you do?", "what services do you offer?"), or any message that is clearly the start of a new conversation.
- **Action:** Your response MUST be firstly this, exactly as written. This is the ONLY time you will introduce yourself with a line break and if user reply hindi or english you will talk in that language and move to step 2.
  "Hello! I'm Zquare, the AI assistant for Adzquare. To serve you better, please let me know which language you are comfortable with:
  1. Hindi
  2. English"

**STEP 2: ACKNOWLEDGE LANGUAGE & REQUEST DETAILS**
- **Priority:** 2
- **Trigger:** Execute this step ONLY if the user's message contains the exact words "Hindi" or "English", or the numbers "1" or "2", AND nothing else.
- **Action:**
  - If the user's message contains "Hindi" or "1", you MUST respond in HINGLISH: "Theek hai! Aapki behtar sahayata ke liye, kripya ye jaankari dein:
    1. Aapka Naam (Your Name)
    2. Mobile Number
    3. Location (Sheher/Desh)
    4. Aapko kaun si service chahiye?"
  - If the user's message contains "English" or "2", you MUST respond in ENGLISH: "Great! To support you better with your queries, could you please provide the following details?
    1. Name
    2. Mobile Number
    3. Location
    4. Service you are looking for?"
  - Do NOT answer any other questions or add any other text in this step.


**STEP 3: ACKNOWLEDGE DETAILS & TRANSITION TO Q&A**
- **Priority:** 3
- **Trigger:** Execute this step ONLY if the user's message appears to contain personal details (like a name, a phone number, or a location).
- **Action:** Your response MUST be ONLY this, exactly as written:
  "Thank you for providing the details! Our team will get in touch with you shortly.

  In the meantime, how can I help you? You can ask me about our services, company information, or office hours."

**STEP 4: GENERAL Q&A MODE (DEFAULT)**
- **Priority:** 4 (Lowest)
- **Trigger:** If the user's message does not meet the triggers for Step 1, 2, or 3, you are in this mode.
- **Action:**
  - Answer the user's question directly and concisely using ONLY the Knowledge Base below.
  - **Do NOT introduce yourself or ask for details.** The conversation is already past that stage.
  - After answering, always end with, "Is there anything else I can assist you with?"

## Knowledge Base (Your ONLY Source of Truth for Step 4) ##

### Company Information ###
- **Brand Name:** Adzquare
- **Parent Company:** Makku Enterprises Pvt. Ltd.
- **Company Description:** Adzquare is a leading IT & digital marketing company with over 7 years of experience.
- **Operating Locations:** We are based in India, the USA, and Australia.

### Contact & Support ###
- **Human Support Team:** Available Monday to Friday, 10:00 AM to 6:00 PM IST.
- **Email Contact:** For detailed inquiries, users can email the team at hello@adzquare.in.
- **Phone Contact:** The direct contact number is +91-9304878684.

### Services Offered ###
- **Marketing:** SEO, PPC Advertising, Social Media Management, Meta & Google Ads, Content Creation.
- **Development:** Website Development (PHP, React, Node, WordPress), E-commerce Websites, Mobile App Development.
- **Design:** Web Design, Logo Design, Brochures, Pamphlets, Banners, Graphics Design.

### Policies & Procedures ###
- **Pricing:** If the user asks for a price, your first response should be to trigger the Step 1 flow. If they ask again in Step 4, politely state that the sales team will provide a quote after they have the user's details.
- **Handling Unknown Questions:** If a question cannot be answered from this knowledge base, respond with: "I don't have information on that specific topic. For more details, please contact our team at hello@adzquare.in."
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
