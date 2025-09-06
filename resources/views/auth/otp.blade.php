<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Verify OTP</h2>

        {{-- Display errors if any --}}
        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

       <form method="POST" action="{{ route('otp.verify') }}">
        @csrf

        {{-- Display email to user --}}
       <div>
          <input type="text" value="{{ request('email') }}" readonly
               class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100 cursor-not-allowed">
       </div>

       {{-- Hidden input that actually submits email --}}
       <input type="hidden" name="email" value="{{ request('email') }}" required>

       <div>
        <input type="text" name="otp" placeholder="Enter OTP"
               class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"
               required>
       </div>

       <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
          Verify
       </button>
</form>

</div>

</body>
</html>

