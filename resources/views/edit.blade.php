<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Edit Staff</title>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-blue-600">Edit Staff</h1>
      <a href="/" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">Back</a>
    </div>

    <!-- Validation Errors -->
    @foreach (['name', 'email', 'designation', 'phone'] as $field)
      @error($field)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    @endforeach

    <!-- Form -->
    <div class="bg-white p-6 rounded shadow-md w-full max-w-lg mx-auto">
      <form action="{{ route('update', $post->id) }}" method="POST"> 
        @csrf

        <!-- Name -->
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <input type="text" name="name" id="name" value="{{ old('name', $post->name) }}" required
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Email -->
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="email" id="email" value="{{ old('email', $post->email) }}" required
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Designation -->
        <div class="mb-4">
          <label for="designation" class="block text-sm font-medium text-gray-700">Designation</label>
          <input type="text" name="designation" id="designation" value="{{ old('designation', $post->designation) }}" required
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Phone -->
        <div class="mb-4">
          <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
          <input type="text" name="phone" id="phone" value="{{ old('phone', $post->phone) }}" required
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
          <button type="submit"
                  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Update Staff
          </button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>



