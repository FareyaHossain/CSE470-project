<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-6">Add Attendance</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('attendance.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Staff</label>
                <select name="staff_id" class="w-full border p-2 rounded" required>
                    <option value="">Select Staff</option>
                    @foreach ($staffs as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                    @endforeach
                </select>
                @error('staff_id')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Date</label>
                <input type="date" name="date" class="w-full border p-2 rounded" required>
                @error('date')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Status</label>
                <select name="status" class="w-full border p-2 rounded" required>
                    <option value="">Select Status</option>
                    <option value="Present">Present</option>
                    <option value="Absent">Absent</option>
                    <option value="Leave">Leave</option>
                </select>
                @error('status')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>

