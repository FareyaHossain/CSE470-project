<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow mt-10">
        <h2 class="text-xl font-bold mb-4">Send General Notification</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('notifications.send') }}">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold mb-2">Subject</label>
                <input type="text" name="subject" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Message</label>
                <textarea name="message" rows="5" class="w-full border p-2 rounded" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Send Notification
            </button>
        </form>
    </div>

</body>
</html>
