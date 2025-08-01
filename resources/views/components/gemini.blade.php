<!-- Self-contained Gemini Chat Component - v3 (Gradient Button) - Adapted for Existing Backend -->
<div>
    <!-- The Floating Chat Button -->
    <div class="gemini-chat-button" id="gemini-chat-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white">
            <path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4l-.01-18zM18 14H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
        </svg>
    </div>

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
            <div class="gemini-chat-header-poweredby">
                <span>POWERED BY</span>
                <a href="https://gemini.google.com/" target="_blank" rel="noopener">
                    <img src="https://www.gstatic.com/images/branding/product/1x/gemini_48dp.png" alt="Gemini Logo">
                    <span>Adzquare</span>
                </a>
            </div>
        </div>
        <div class="gemini-chat-body" id="gemini-chat-body">
            <!-- Initial greeting message -->
            <div class="gemini-chat-message ai-message">
                Hello! How can I assist you today?
            </div>
        </div>
        <div class="gemini-chat-footer">
            <input type="text" id="gemini-chat-input" placeholder="Ask something...">
            <button class="gemini-mic-button" id="gemini-mic-button" title="Voice input (not implemented)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#666">
                    <path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3zm5.91-3c-.49 0-.9.36-.98.85l-.82 4.1C16.11 16.97 15.11 18 14 18H10c-1.11 0-2.11-.03-2.11-1.05l-.82-4.15c-.08-.49-.49-.85-.98-.85S5.64 11.36 5.56 11.85l.82 4.1C6.49 16.97 7.49 18 8.5 18h7c1.01 0 2.01-.03 2.11-1.05l.82-4.15c.08-.49-.33-.85-.82-.85z"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<style>
    /* Main Floating Button with Gradient */
    .gemini-chat-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-image: linear-gradient(135deg, #FF8C00, #FFA500);
        color: white;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        z-index: 9998;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .gemini-chat-button:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(0,0,0,0.3);
    }

    /* Main Chat Window */
    .gemini-chat-window {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 370px;
        max-height: 75vh;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        display: none; /* Initially hidden */
        flex-direction: column;
        overflow: hidden;
        z-index: 9999;
        font-family: 'Roboto', 'Segoe UI', sans-serif;
    }

    /* Header */
    .gemini-chat-header {
        background-color: #2c3e50; /* Dark Blue/Grey */
        color: white;
        padding: 12px 16px;
        font-size: 14px;
        border-bottom: 1px solid #2c3e50;
    }
    .gemini-chat-header-title { display: flex; align-items: center; gap: 12px; }
    .gemini-chat-logo { width: 32px; height: 32px; border-radius: 4px; }
    .gemini-chat-header-title strong { font-size: 16px; font-weight: 500; }
    .gemini-chat-header-title span { font-size: 13px; opacity: 0.8; }
    .gemini-chat-header-poweredby { display: flex; align-items: center; justify-content: flex-end; gap: 6px; font-size: 10px; opacity: 0.7; margin-top: 8px; text-transform: uppercase; }
    .gemini-chat-header-poweredby a { display: flex; align-items: center; gap: 4px; color: white; text-decoration: none; font-weight: 500; }
    .gemini-chat-header-poweredby img { width: 14px; height: 14px; }

    /* Chat Body */
    .gemini-chat-body { flex: 1; padding: 16px; overflow-y: auto; background-color: #f9f9f9; display: flex; flex-direction: column; gap: 12px; }
    .gemini-chat-message { padding: 10px 15px; border-radius: 18px; max-width: 85%; word-wrap: break-word; font-size: 14px; line-height: 1.5; }
    .user-message { background-color: #eb4000; color: white; align-self: flex-end; border-bottom-right-radius: 4px; }
    .ai-message { background-color: #eef1f5; color: #1d1d1d; align-self: flex-start; border: 1px solid #e0e0e0; border-bottom-left-radius: 4px; }

    /* Footer / Input Area */
    .gemini-chat-footer { display: flex; align-items: center; padding: 12px; border-top: 1px solid #e0e0e0; background-color: #fff; }
    #gemini-chat-input { flex: 1; border: none; background: transparent; padding: 8px; font-size: 15px; }
    #gemini-chat-input:focus { outline: none; }
    .gemini-mic-button { background: transparent; border: none; cursor: pointer; padding: 8px; opacity: 0.7; transition: opacity 0.2s; }
    .gemini-mic-button:hover { opacity: 1; }

    /* Style for the dynamically added send button */
    .gemini-send-button {
        background-color: #eb4000;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: 8px;
        transition: background-color 0.2s;
    }
    .gemini-send-button:hover { background-color: #eb4000; }
</style>

<script>
(function() {
    // This Immediately-Invoked Function Expression (IIFE) protects the global scope
    document.addEventListener('DOMContentLoaded', function () {
        const chatButton = document.getElementById('gemini-chat-button');
        const chatWindow = document.getElementById('gemini-chat-window');
        const chatInput = document.getElementById('gemini-chat-input');
        const chatBody = document.getElementById('gemini-chat-body');
        const chatFooter = document.querySelector('.gemini-chat-footer');
        const micButton = document.getElementById('gemini-mic-button');

        chatButton.addEventListener('click', () => {
            const isHidden = chatWindow.style.display === 'none' || chatWindow.style.display === '';
            chatWindow.style.display = isHidden ? 'flex' : 'none';
        });

        const sendButton = document.createElement('button');
        sendButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>`;
        sendButton.className = 'gemini-send-button';

        chatInput.addEventListener('input', () => {
            if (chatInput.value.trim().length > 0) {
                if (micButton) micButton.style.display = 'none';
                if (!chatFooter.contains(sendButton)) { chatFooter.appendChild(sendButton); }
            } else {
                if (micButton) micButton.style.display = 'block';
                if (chatFooter.contains(sendButton)) { chatFooter.removeChild(sendButton); }
            }
        });

        // Helper function to add a message bubble to the chat window
        function appendMessage(sender, message) {
            const msgDiv = document.createElement('div');
            msgDiv.classList.add('gemini-chat-message', `${sender}-message`);
            msgDiv.textContent = message;
            chatBody.appendChild(msgDiv);
            chatBody.scrollTop = chatBody.scrollHeight; // Auto-scroll to the bottom
            return msgDiv;
        }

        // Main function to handle sending the message and receiving a reply
        const sendMessage = async () => {
            const userMessage = chatInput.value.trim();
            if (userMessage === '') return;

            appendMessage('user', userMessage);
            chatInput.value = '';
            chatInput.dispatchEvent(new Event('input')); // Reset send/mic button

            const thinkingIndicator = appendMessage('ai', 'Thinking...');

            try {
                // Fetch call adapted for your specific Laravel API backend
                const response = await fetch('/api/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ message: userMessage }) // Backend expects 'message'
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();

                thinkingIndicator.remove(); // Remove the "Thinking..." bubble

                appendMessage('ai', data.reply || 'Sorry, I had trouble getting a response.'); // Backend returns 'reply'

            } catch (error) {
                console.error('Gemini Chat Error:', error);
                thinkingIndicator.remove(); // Also remove on error
                appendMessage('ai', 'An error occurred while connecting.');
            }
        };

        // Event listeners to trigger the sendMessage function
        sendButton.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                sendMessage();
            }
        });
    });
})();
</script>
