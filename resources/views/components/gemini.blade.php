<!-- Self-contained Gemini Chat Component - v4 (Markdown & Close Button) -->
<div>
    <!-- START: NEW CONTAINER FOR THE BUTTON AND LABEL -->
    <div class="gemini-floating-container" id="gemini-floating-container">
        <!-- New "Let's Chat" Label -->
        <div class="gemini-chat-label">
            Let's Chat
        </div>
        <!-- The Floating Chat Button (now inside the container) -->
        <div class="gemini-chat-button" id="gemini-chat-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white">
                <path d="M11 21h-1l1-7H7.5c-.58 0-.57-.32-.38-.66l.19-.34L13 3h1l-1 7h3.5c.49 0 .56.33.4.66l-.16.34L11 21z"/>
            </svg>
        </div>
    </div>
    <!-- END: NEW CONTAINER -->

    <!-- The Chat Window -->
    <div class="gemini-chat-window" id="gemini-chat-window">
        <div class="gemini-chat-header">
            <div class="gemini-chat-header-title">
                <img src="https://www.gstatic.com/images/branding/product/2x/gemini_48dp.png" alt="Gemini" class="gemini-chat-logo">
                <div>
                    <strong>Support Bot</strong>
                    <span>Connects to Adzquare.</span>
                </div>
            </div>
            <!-- START: NEW CLOSE BUTTON -->
            <button class="gemini-chat-close-button" id="gemini-chat-close-button" title="Close chat">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="white">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </button>
            <!-- END: NEW CLOSE BUTTON -->
        </div>
        <div class="gemini-chat-body" id="gemini-chat-body">
            <!-- Initial greeting message -->
            <div class="gemini-chat-message ai-message">
                Hello! How can I assist you today?
            </div>
        </div>
        <div class="gemini-chat-footer">
            <input type="text" id="gemini-chat-input" placeholder="Ask something...">
            <button class="gemini-mic-button" id="gemini-mic-button" title="Voice input">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#666">
                    <path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3zm5.91-3c-.49 0-.9.36-.98.85l-.82 4.1C16.11 16.97 15.11 18 14 18H10c-1.11 0-2.11-.03-2.11-1.05l-.82-4.15c-.08-.49-.49-.85-.98-.85S5.64 11.36 5.56 11.85l.82 4.1C6.49 16.97 7.49 18 8.5 18h7c1.01 0 2.01-.03 2.11-1.05l.82-4.15c.08-.49-.33-.85-.82-.85z"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- START: We need a library to parse Markdown. Marked.js is small and fast. -->
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<!-- END: Markdown library -->


<style>
    /* (All your existing CSS is perfect and remains here) */
        .gemini-chat-button {
        background-image: linear-gradient(135deg, #FF8C00, #FFA500);
        color: white;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    /* Apply hover effect to button when container is hovered */
    .gemini-floating-container:hover .gemini-chat-button {
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(0,0,0,0.3);
    }
    .gemini-chat-window { position: fixed; bottom: 90px; right: 20px; width: 370px; max-height: 75vh; background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 5px 25px rgba(0,0,0,0.2); display: none; flex-direction: column; overflow: hidden; z-index: 9999; font-family: 'Roboto', 'Segoe UI', sans-serif; }
    .gemini-chat-header { background-color: #2c3e50; color: white; padding: 12px 16px; font-size: 14px; border-bottom: 1px solid #2c3e50; display: flex; justify-content: space-between; align-items: center; }
    .gemini-chat-header-title { display: flex; align-items: center; gap: 12px; }
    .gemini-chat-logo { width: 32px; height: 32px; border-radius: 4px; }
    .gemini-chat-header-title strong { font-size: 16px; font-weight: 500; }
    .gemini-chat-header-title span { font-size: 13px; opacity: 0.8; }
    /* START: Styles for the new Close Button */
    .gemini-chat-close-button { background: none; border: none; cursor: pointer; padding: 4px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background-color 0.2s; }
    .gemini-chat-close-button:hover { background-color: rgba(255,255,255,0.2); }
    /* END: Styles for the new Close Button */
    .gemini-chat-body { flex: 1; padding: 16px; overflow-y: auto; background-color: #f9f9f9; display: flex; flex-direction: column; gap: 12px; }
    .gemini-chat-message { padding: 10px 15px; border-radius: 18px; max-width: 85%; word-wrap: break-word; font-size: 14px; line-height: 1.5; }
    .user-message { background-color: #eb4000; color: white; align-self: flex-end; border-bottom-right-radius: 4px; }
    .ai-message { background-color: #eef1f5; color: #1d1d1d; align-self: flex-start; border: 1px solid #e0e0e0; border-bottom-left-radius: 4px; }
    /* START: Styles for rendered Markdown content in AI messages */
    .ai-message p { margin: 0 0 8px 0; }
    .ai-message p:last-child { margin-bottom: 0; }
    .ai-message ul, .ai-message ol { margin: 0 0 8px 20px; padding: 0; }
    .ai-message li { margin-bottom: 4px; }
    .ai-message a { color: #007bff; text-decoration: underline; }
    /* END: Styles for rendered Markdown content */
    .gemini-chat-footer { display: flex; align-items: center; padding: 12px; border-top: 1px solid #e0e0e0; background-color: #fff; }
    #gemini-chat-input { flex: 1; border: none; background: transparent; padding: 8px; font-size: 15px; }
    #gemini-chat-input:focus { outline: none; }
    .gemini-mic-button { background: transparent; border: none; cursor: pointer; padding: 8px; opacity: 0.7; transition: opacity 0.2s; }
    .gemini-mic-button:hover { opacity: 1; }
    .gemini-send-button { background-color: #eb4000; border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; cursor: pointer; margin-left: 8px; transition: background-color 0.2s; }
    .gemini-send-button:hover { background-color: #eb4000; }
    .gemini-mic-button.listening svg { animation: pulse 1.5s infinite; }
    @keyframes pulse { 0% { transform: scale(1); opacity: 0.7; } 50% { transform: scale(1.2); opacity: 1; } 100% { transform: scale(1); opacity: 0.7; } }

    /* START: Styles for the new container and label */
    .gemini-floating-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9998;
        display: flex;
        flex-direction: column;
        align-items: center;
        cursor: pointer;
    }

    .gemini-chat-label {
        background-color: #2c3e50; /* Matches header color */
        color: white;
        padding: 5px 12px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        opacity: 0; /* Initially hidden */
        transform: translateY(10px); /* Start slightly lower */
        transition: opacity 0.3s ease, transform 0.3s ease;
        pointer-events: none; /* Allows clicks to pass through to the button */
    }

    /* Show the label on hover of the container */
    .gemini-floating-container:hover .gemini-chat-label {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<script>
(function() {
    document.addEventListener('DOMContentLoaded', function () {
        const floatingContainer = document.getElementById('gemini-floating-container');
        const chatWindow = document.getElementById('gemini-chat-window');
        const chatInput = document.getElementById('gemini-chat-input');
        const chatBody = document.getElementById('gemini-chat-body');
        const chatFooter = document.querySelector('.gemini-chat-footer');
        const micButton = document.getElementById('gemini-mic-button');
        // START: Get the new close button
        const closeButton = document.getElementById('gemini-chat-close-button');
        // END: Get the new close button

        // --- START: Chat window visibility logic ---
        const toggleChatWindow = () => {
            const isHidden = chatWindow.style.display === 'none' || chatWindow.style.display === '';
            chatWindow.style.display = isHidden ? 'flex' : 'none';
            if (isHidden) {
                loadAndDisplayHistory();
            }
        };
        floatingContainer.addEventListener('click', toggleChatWindow);
        closeButton.addEventListener('click', toggleChatWindow); // The close button does the same thing
        // --- END: Chat window visibility logic ---


        // All existing logic for history, expiration, and voice is unchanged
        const EXPIRATION_MINUTES = 20;
        const EXPIRATION_MS = EXPIRATION_MINUTES * 60 * 1000;
        let userId = localStorage.getItem('geminiChatUserId') || `user_${Date.now()}${Math.random().toString(36).substring(2, 9)}`;
        localStorage.setItem('geminiChatUserId', userId);
        let chatData = JSON.parse(localStorage.getItem('geminiChatData_' + userId)) || { timestamp: Date.now(), history: [] };
        let chatHistory = chatData.history;
        const saveChatData = () => {
            localStorage.setItem('geminiChatData_' + userId, JSON.stringify({ timestamp: Date.now(), history: chatHistory }));
        };
        const loadAndDisplayHistory = () => {
            const now = Date.now();
            if (now - (chatData.timestamp || 0) > EXPIRATION_MS) {
                chatHistory = [];
                saveChatData();
                chatBody.innerHTML = `<div class="gemini-chat-message ai-message">Hello! How can I assist you today?</div>`;
            } else if (chatHistory.length > 0) {
                chatBody.innerHTML = '';
                chatHistory.forEach(item => appendMessage(item.sender, item.message, false));
            } else {
                 chatBody.innerHTML = `<div class="gemini-chat-message ai-message">Hello! How can I assist you today?</div>`;
            }
        };

        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        let recognition;
        let isListening = false;
        if (SpeechRecognition) {
            recognition = new SpeechRecognition();
            recognition.continuous = false;
            recognition.lang = 'en-US';
            recognition.onresult = (event) => {
                chatInput.value = event.results[0][0].transcript;
                chatInput.dispatchEvent(new Event('input', { bubbles: true }));
            };
            recognition.onerror = (event) => { console.error("Speech recognition error:", event.error); micButton.classList.remove('listening'); };
            recognition.onend = () => { isListening = false; micButton.classList.remove('listening'); };
            micButton.addEventListener('click', (e) => {
                e.stopPropagation(); // Stop click from bubbling to container
                if (isListening) { recognition.stop(); return; }
                recognition.start();
                isListening = true;
                micButton.classList.add('listening');
            });
        } else {
            if (micButton) micButton.style.display = 'none';
        }


        const sendButton = document.createElement('button');
        sendButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>`;
        sendButton.className = 'gemini-send-button';
        chatInput.addEventListener('input', () => {
            if (chatInput.value.trim().length > 0) {
                if (micButton && !isListening) micButton.style.display = 'none';
                if (!chatFooter.contains(sendButton)) { chatFooter.appendChild(sendButton); }
            } else {
                if (micButton) micButton.style.display = 'block';
                if (chatFooter.contains(sendButton)) { chatFooter.removeChild(sendButton); }
            }
        });

        // --- START: MODIFIED appendMessage function ---
        function appendMessage(sender, message, shouldSave = true) {
            const msgDiv = document.createElement('div');
            msgDiv.classList.add('gemini-chat-message', `${sender}-message`);

            if (sender === 'ai') {
                // If the message is from the AI, parse it as Markdown
                // The 'marked' library comes from the script tag we added above
                msgDiv.innerHTML = marked.parse(message);
            } else {
                // User messages are treated as plain text
                msgDiv.textContent = message;
            }

            chatBody.appendChild(msgDiv);
            chatBody.scrollTop = chatBody.scrollHeight;

            if (shouldSave) {
                // Save the original, raw message text to history, not the rendered HTML
                chatHistory.push({ sender, message });
                saveChatData();
            }
            return msgDiv;
        }
        // --- END: MODIFIED appendMessage function ---

        const sendMessage = async () => {
            const userMessage = chatInput.value.trim();
            if (userMessage === '') return;
            appendMessage('user', userMessage);
            chatInput.value = '';
            chatInput.dispatchEvent(new Event('input'));
            const thinkingIndicator = appendMessage('ai', 'Thinking...', false);
            try {
                const response = await fetch('/api/chat', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ message: userMessage, history: chatHistory.slice(0, -1) })
                });
                if (!response.ok) { throw new Error(`HTTP error! Status: ${response.status}`); }
                const data = await response.json();

                // Remove the "Thinking..." bubble
                thinkingIndicator.remove();
                // Append the new AI message, which will now be rendered as Markdown
                appendMessage('ai', data.reply || 'Sorry, had trouble getting a response.');

            } catch (error) {
                console.error('Gemini Chat Error:', error);
                thinkingIndicator.remove();
                appendMessage('ai', 'An error occurred while connecting.', false);
            }
        };
        sendButton.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') { e.preventDefault(); sendMessage(); }
        });
    });
})();
</script>
