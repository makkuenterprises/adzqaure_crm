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

    public function ask($message)
    {
        if (!$this->apiKey) {
            Log::error('Gemini API key is not set.');
            return 'AI service is not configured. Please add GEMINI_API_KEY to your .env file.';
        }

        // --- START: EXPERT-LEVEL SEQUENTIAL CONVERSATION PROMPT ---

        $systemPrompt = <<<PROMPT
## Core Directive: Sequential Conversational Flow ##
Your only goal is to follow a precise, multi-step conversation flow. You have no memory of past turns, so you must analyze the user's CURRENT message to determine which step you are on. Follow these steps in order of priority.

**STEP 1: INITIAL CONTACT & LANGUAGE SELECTION**
- **Priority:** 1 (Highest)
- **Trigger:** Execute this step ONLY if the user's message is a simple greeting (e.g., "hi", "hello"), a general inquiry (e.g., "what do you do?", "what services do you offer?"), or any message that is clearly the start of a new conversation.
- **Action:** Your response MUST be ONLY this, exactly as written. This is the ONLY time you will introduce yourself.
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

        // --- END: EXPERT-LEVEL SEQUENTIAL CONVERSATION PROMPT ---


        try {
            $data = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $systemPrompt],
                            ['text' => "Customer Query: " . $message],
                        ]
                    ]
                ],
                'generationConfig' => [
                    // A lower temperature forces the AI to stick to the script more reliably.
                    'temperature' => 0.2,
                    'topK' => 1,
                    'topP' => 1,
                    'maxOutputTokens' => 2048,
                    'stopSequences' => [],
                ],
                'safetySettings' => [
                    ['category' => 'HARM_CATEGORY_HARASSMENT', 'threshold' => 'BLOCK_ONLY_HIGH'],
                    ['category' => 'HARM_CATEGORY_HATE_SPEECH', 'threshold' => 'BLOCK_ONLY_HIGH'],
                    ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT', 'threshold' => 'BLOCK_ONLY_HIGH'],
                    ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_ONLY_HIGH'],
                ],
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("{$this->apiEndpoint}?key={$this->apiKey}", $data);

            $response->throw();

            $json = $response->json();
            Log::info('Gemini API response:', $json);

            $text = $json['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if ($text) {
                return $text;
            }

            if (isset($json['candidates'][0]['finishReason']) && $json['candidates'][0]['finishReason'] === 'SAFETY') {
                Log::warning('Gemini response was blocked due to safety reasons.', ['response' => $json]);
                return 'My response was blocked by safety filters. Please rephrase your question.';
            }

            return 'I couldn’t generate a proper reply.';

        } catch (RequestException $e) {
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
