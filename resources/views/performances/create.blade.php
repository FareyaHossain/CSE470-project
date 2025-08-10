<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Add Performance Data</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-blue-600">Add Performance Data</h1>
      <a href="{{ route('performances.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">Back</a>
    </div>

    @if ($errors->any())
      <div class="mb-4">
        <ul class="list-disc list-inside text-red-600">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="bg-white p-6 rounded shadow-md w-full max-w-lg mx-auto">
      <form action="{{ route('performances.store') }}" method="POST" class="space-y-4">
        @csrf

        <label class="block">
          <span class="text-sm font-medium text-gray-700">Staff</span>
          <select name="staff_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            <option value="">Select Staff</option>
            @foreach($staffs as $staff)
              <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
            @endforeach
          </select>
        </label>

        <label class="block">
          <span class="text-sm font-medium text-gray-700">Performance Metric</span>
          <input type="text" name="performance_metric" value="{{ old('performance_metric') }}" required
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. Task Completion" />
        </label>

        <label class="block">
          <span class="text-sm font-medium text-gray-700">Score (0-10)</span>
          <input type="number" name="score" min="0" max="10" value="{{ old('score') }}" required
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </label>

        <label class="block">
          <span class="text-sm font-medium text-gray-700">Comments</span>
          <textarea name="comments" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="3">{{ old('comments') }}</textarea>
        </label>

        <label class="block">
          <span class="text-sm font-medium text-gray-700">Date</span>
          <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </label>

        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Add Performance</button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
