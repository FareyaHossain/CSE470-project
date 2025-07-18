<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Add New Staff</title>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-blue-600">Add New Staff</h1>
      <a href="/" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">Back</a>
    </div>
    @error('id')
  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror
    @error('name')
  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror
    @error('email')
  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror
    @error('designation')
  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror
    @error('phone')
  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror

    <!-- Form -->
    <div class="bg-white p-6 rounded shadow-md w-full max-w-lg mx-auto">
      <form action="{{ route('store') }}" method="POST"> 
        @csrf
       <div class="mb-4">
          <label for="id" class="block text-sm font-medium text-gray-700">ID</label>
          <input type="text" name="id" id="id" required
          
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Name -->
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <input type="text" name="name" id="name" required
          
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Email -->
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="email" id="email" required
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- designation-->
        <div class="mb-4">
          <label for="designation" class="block text-sm font-medium text-gray-700">designation</label>
          <input type="text" name="designation" id="designation" required
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
       <!-- phone-->
        <div class="mb-4">
          <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
          <input type="text" name="phone" id="phone" required
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
          <button type="submit"
                  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Add Staff
          </button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
