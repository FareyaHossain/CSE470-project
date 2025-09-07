<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>
        <h2 class="text-2xl font-bold mb-4 text-center">Staff Management Hub</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <input type="email" name="email" placeholder="Email"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"
                       required>
            </div>

            <div>
                <input type="password" name="password" placeholder="Password"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"
                       required>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>

</body>
</html>

