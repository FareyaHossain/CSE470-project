<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Monthly Attendance Report</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6">Monthly Attendance Report</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('attendance.monthly_report') }}" class="mb-4 flex items-center space-x-4">
      <select name="month" class="border rounded p-2">
        @for ($m = 1; $m <= 12; $m++)
          <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
          </option>
        @endfor
      </select>

      <select name="year" class="border rounded p-2">
        @for ($y = now()->year; $y >= 2020; $y--)
          <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
            {{ $y }}
          </option>
        @endfor
      </select>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">View Report</button>
    </form>

    <table class="min-w-full bg-white shadow-md rounded-xl mt-6">
      <thead class="bg-gray-200 text-gray-700">
        <tr>
          <th class="py-2 px-4">Staff Name</th>
          <th class="py-2 px-4">Present</th>
          <th class="py-2 px-4">Absent</th>
          <th class="py-2 px-4">Leave</th>
          <th class="py-2 px-4">Total Days</th>
          <th class="py-2 px-4">Attendance_Calculation %</th>
        </tr>
      </thead>
      <tbody>
        @foreach($staffList as $staff)
          <tr class="text-center border-b">
            <td class="py-2 px-4 font-medium">{{ $staff->name }}</td>
            <td class="py-2 px-4">{{ $staff->present_days }}</td>
            <td class="py-2 px-4">{{ $staff->absent_days }}</td>
            <td class="py-2 px-4">{{ $staff->leave_days }}</td>
            <td class="py-2 px-4">{{ $staff->total_days }}</td>
            <td class="py-2 px-4">{{ $staff->attendance_percentage }}%</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>


