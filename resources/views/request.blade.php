<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Request Leave</title>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-blue-600">Request Leave</h1>
      <a href="/" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">Back</a>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
      <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Form -->
    <div class="bg-white p-6 rounded shadow-md w-full max-w-lg mx-auto">
      <form action="{{ route('leave.store') }}" method="POST">
        @csrf

        <!-- Staff Dropdown -->
        <div class="mb-4">
          <label for="staff_id" class="block text-sm font-medium text-gray-700">Select Staff</label>
          <select name="staff_id" id="staff_id" required
                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Choose Staff --</option>
            @foreach ($staff as $member)
              <option value="{{ $member->id }}">{{ $member->name }}</option>
            @endforeach
          </select>
        </div>

        <!-- Start Date -->
        <div class="mb-4">
          <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
          <input type="date" name="start_date" id="start_date" required
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- End Date -->
        <div class="mb-4">
          <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
          <input type="date" name="end_date" id="end_date" required
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Reason -->
        <div class="mb-4">
          <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
          <textarea name="reason" id="reason" rows="3" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
          <button type="submit"
                  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Submit Request
          </button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>



