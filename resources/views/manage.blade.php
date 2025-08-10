<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title> Leave Approval Recomendation</title>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-blue-600"> Leave Approval Recomendation</h1>
      <a href="/" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">Back</a>
    </div>

    <!-- Success & Error messages -->
    @if(session('success'))
      <div class="bg-green-100 text-green-800 px-4 py-2 mb-4 rounded">
        {{ session('success') }}
      </div>
    @endif
    @if(session('error'))
      <div class="bg-red-100 text-red-800 px-4 py-2 mb-4 rounded">
        {{ session('error') }}
      </div>
    @endif

    <!-- Table -->
    <div class="bg-white p-6 rounded shadow-md">
      <table class="min-w-full table-auto border-collapse">
        <thead class="bg-blue-100 text-blue-800">
          <tr>
            <th class="px-4 py-2 border">Staff Name</th>
            <th class="px-4 py-2 border">Start Date</th>
            <th class="px-4 py-2 border">End Date</th>
            <th class="px-4 py-2 border">Reason</th>
            <th class="px-4 py-2 border">Status</th>
            <th class="px-4 py-2 border">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($requests as $request)
            <tr class="text-center">
              <td class="px-4 py-2 border">{{ $request->staff->name ?? 'N/A' }}</td>
              <td class="px-4 py-2 border">{{ $request->start_date }}</td>
              <td class="px-4 py-2 border">{{ $request->end_date }}</td>
              <td class="px-4 py-2 border">{{ $request->reason }}</td>
              <td class="px-4 py-2 border font-semibold">
                @if($request->status == 'Pending')
                  <span class="text-yellow-600">{{ $request->status }}</span>
                @elseif($request->status == 'Approved')
                  <span class="text-green-600">{{ $request->status }}</span>
                @else
                  <span class="text-red-600">{{ $request->status }}</span>
                @endif
              </td>
              <td class="px-4 py-2 border space-x-2">
                @if($request->status == 'Pending')
                  <form action="{{ route('leave.approve', $request->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Approve</button>
                  </form>
                  <form action="{{ route('leave.deny', $request->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Deny</button>
                  </form>
                @else
                  <span class="text-sm text-gray-500 italic">No actions</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-4 text-gray-500">No leave requests found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>

