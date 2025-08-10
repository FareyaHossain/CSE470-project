<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Performance Report - {{ $staff->name }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="container mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-blue-600">Performance Report for {{ $staff->name }}</h1>
      <a href="{{ route('performances.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">Back</a>
    </div>

    <div class="bg-white p-6 rounded shadow-md w-full max-w-4xl mx-auto">
      <p class="mb-4 text-lg"><strong>Average Score:</strong> {{ number_format($averageScore, 2) }}</p>
      <p class="mb-6 italic text-gray-700">{{ $performanceSummary }}</p>

      <table class="min-w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2 text-left">Metric</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Score</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Comments</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($performances as $performance)
          <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $performance->performance_metric }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $performance->score }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $performance->comments ?? '-' }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $performance->date->format('Y-m-d') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>

  </div>

</body>
</html>
