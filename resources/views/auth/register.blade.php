<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Registration</h2>
        <h2 class="text-2xl font-bold mb-4 text-center">Staff Management Hub</h2>
        
        {{-- Show Validation Errors --}}
        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <input type="text" name="name" placeholder="Name"
                       value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"
                       required>
            </div>

            <div class="mb-3">
                <input type="email" name="email" placeholder="Email"
                       value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"
                       required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" placeholder="Password"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"
                       required>
            </div>

            <div class="mb-4">
                <input type="password" name="password_confirmation" placeholder="Confirm Password"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"
                       required>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700">
                Submit
            </button>
        </form>
    </div>

</body>
</html>
