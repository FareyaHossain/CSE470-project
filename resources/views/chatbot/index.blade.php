<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>HR Chatbot Assistant</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="container mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-blue-600">Chatbot HR Assistant</h1>
      <a href="{{ url('/') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">Home</a>
    </div>

    <div class="bg-white p-6 rounded shadow-md w-full max-w-2xl mx-auto">
      <div id="chatbox" class="h-64 overflow-y-auto border border-gray-300 p-3 rounded mb-4 bg-gray-50 text-sm space-y-2">
        <!-- Chat messages will appear here -->
      </div>

      <div class="flex">
        <input type="text" id="message" class="flex-1 border rounded-l px-3 py-2 focus:outline-none focus:ring" placeholder="Ask HR a question..." />
        <button onclick="sendMessage()" class="bg-blue-600 text-white px-4 py-2 rounded-r hover:bg-blue-700 transition">Send</button>
      </div>
    </div>

  </div>

  <script>
    function sendMessage() {
      const messageInput = document.getElementById('message');
      const chatbox = document.getElementById('chatbox');
      const message = messageInput.value.trim();
      if (!message) return;

      chatbox.innerHTML += `<div><strong>You:</strong> ${message}</div>`;

      fetch('/chatbot/message', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({ message: message })
      })
      .then(res => res.json())
      .then(data => {
        chatbox.innerHTML += `<div><strong>Bot:</strong> ${data.response}</div>`;
        chatbox.scrollTop = chatbox.scrollHeight;
        messageInput.value = '';
      });
    }
  </script>

</body>
</html>
