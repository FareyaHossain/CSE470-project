<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Salary Calculation - {{ $staff->name }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="container mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-blue-600">Salary Calculation for {{ $staff->name }}</h1>
      <a href="{{ route('performances.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">Back</a>
    </div>

    <div class="bg-white p-6 rounded shadow-md w-full max-w-md mx-auto space-y-4">
      <p><strong>Base Salary:</strong> {{ number_format($baseSalary, 2) }}</p>
      <p><strong>Average Performance Score:</strong> {{ number_format($avgScore, 2) }}</p>
      <p><strong>Performance Bonus:</strong> {{ number_format($bonus, 2) }}</p>
      <hr class="my-2" />
      <p class="text-lg font-semibold"><strong>Total Salary:</strong> {{ number_format($totalSalary, 2) }}</p>
    </div>

  </div>

</body>
</html>
