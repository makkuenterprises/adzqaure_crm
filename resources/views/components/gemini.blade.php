<!-- Floating Gemini Chatbot -->
<div id="chatbot-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
  <button onclick="toggleChatbox()" style="background-color: #4f46e5; color: white; border: none; padding: 12px 15px; border-radius: 50%; box-shadow: 0 2px 6px rgba(0,0,0,0.2); font-size: 20px;">
    💬
  </button>

  <div id="chatbox" style="display: none; width: 320px; max-height: 450px; background: white; border-radius: 12px; box-shadow: 0 0 15px rgba(0,0,0,0.1); margin-top: 10px; overflow: hidden;">
    <div id="chat-messages" style="padding: 10px; max-height: 350px; overflow-y: auto; font-size: 14px;"></div>
    <textarea id="chat-input" placeholder="Type your question..." onkeydown="if(event.key==='Enter'){event.preventDefault();sendMessage();}" style="width: 100%; border: none; border-top: 1px solid #ccc; padding: 10px; font-size: 14px; resize: none;"></textarea>
  </div>
</div>

<script>
function toggleChatbox() {
  const box = document.getElementById('chatbox');
  box.style.display = box.style.display === 'none' ? 'block' : 'none';
}

function sendMessage() {
  const input = document.getElementById('chat-input');
  const text = input.value.trim();
  if (!text) return;

  const messages = document.getElementById('chat-messages');
  messages.innerHTML += `<div><strong>You:</strong> ${text}</div>`;
  input.value = '';

  fetch("/api/chat", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    body: JSON.stringify({ message: text })
  })
  .then(res => res.json())
  .then(data => {
    messages.innerHTML += `<div><strong>AI:</strong> ${data.reply}</div>`;
    messages.scrollTop = messages.scrollHeight;
  })
  .catch(() => {
    messages.innerHTML += `<div><strong>AI:</strong> Sorry, something went wrong.</div>`;
  });
}
</script>
