<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Performance Records</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="container mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-blue-600">Performance Records</h1>
      <a href="{{ route('performances.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Add Performance </a>
    </div>

    <div class="bg-white p-6 rounded shadow-md w-full overflow-x-auto">
      <table class="min-w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2 text-left">Staff</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Metric</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Score</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($performances as $performance)
          <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $performance->staff->name }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $performance->performance_metric }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $performance->score }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $performance->date->format('Y-m-d') }}</td>
            <td class="border border-gray-300 px-4 py-2">
              <a href="{{ route('performances.report', $performance->staff->id) }}" class="text-blue-600 hover:underline mr-3">Report</a>
              <a href="{{ route('performances.salary', $performance->staff->id) }}" class="text-green-600 hover:underline">Salary</a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="border border-gray-300 px-4 py-2 text-center text-gray-600">No performance records found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>

      <div class="mt-4">
        {{ $performances->links() }}
      </div>
    </div>

  </div>

</body>
</html>
