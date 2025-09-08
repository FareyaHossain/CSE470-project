<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management Hub Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-blue-600 text-white p-6 shadow">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold">Welcome, {{ auth()->user()->name }}</h1>
            <p class="text-sm">Staff Management Hub Dashboard</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto p-6 space-y-6">

        <!-- Staff Information Control -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-4">Staff Information Control</h2>
            <a href="{{ route('staff.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                Add New Staff
            </a>

            <!-- Staff List Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-3 px-6 text-left">Staff ID</th>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">Designation</th>
                            <th class="py-3 px-6 text-left">Phone</th>
                            <th class="py-3 px-6 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $post->id }}</td>
                            <td class="py-3 px-6">{{ $post->name }}</td>
                            <td class="py-3 px-6">{{ $post->email }}</td>
                            <td class="py-3 px-6">{{ $post->designation }}</td>
                            <td class="py-3 px-6">{{ $post->phone }}</td>
                            <td class="py-3 px-6 flex space-x-2">
                                <a href="{{ route('edit', ['id' => $post->id]) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('update', ['id' => $post->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-green-600 hover:underline">Update</button>
                                </form>
                                <form action="{{ route('delete', ['id' => $post->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Attendance & Leave Analysis -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-4">Attendance & Leave Analysis</h2>
            <div class="space-y-3">
                <a href="{{ route('attendance.create') }}" class="block px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">Add Attendance</a>
                <a href="{{ route('attendance.monthly_report') }}" class="block px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">Monthly Attendance Report</a>
                <a href="{{ route('leave.create') }}" class="block px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">Request Leave</a>
                <a href="{{ route('leave.index') }}" class="block px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">Manage Leave Requests</a>
            </div>
        </div>

        <!-- Performance & Salary Management -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-4">Performance & Salary Management</h2>
            <div class="space-y-3">
                <a href="{{ route('performances.create') }}" class="block px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                    Add Performance Data
                </a>
                @foreach($posts as $post)
                    <a href="{{ route('performances.report', ['staffId' => $post->id]) }}" class="block px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                        {{ $post->name }} - Performance Report
                    </a>
                    <a href="{{ route('performances.salary', ['staffId' => $post->id]) }}" class="block px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                        {{ $post->name }} - Calculate Salary
                    </a>
                @endforeach
            </div>
        </div>

        <!-- AI-Powered Communication & Assistance -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-4">AI-Powered Communication & Assistance</h2>
            <div class="space-y-3">
                <a href="{{ url('/chatbot') }}" class="block px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">Chatbot HR Assistant</a>
                <a href="{{ url('/notifications/create') }}" class="block px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">Automated Email Notifier</a>
            </div>
        </div>

        <!-- Logout button -->
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="flex items-center gap-1 bg-red-500 hover:bg-red-600 transition duration-200 px-3 py-1.5 rounded text-white font-medium text-sm shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5"/>
                </svg>
                Logout
            </button>
        </form>

    </main>

</body>
</html>
