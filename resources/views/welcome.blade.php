<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Staff Management Hub</title>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-blue-600">Staff Management Hub</h1>
      <a href="/create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Add New Staff</a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
      <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4 border border-green-300">
        <h1 class="text-lg font-semibold">
          {{ session('success') }}
        </h1>
      </div>
    @endif

    <!-- Staff Table -->
    <div class="bg-white shadow-md rounded overflow-x-auto">
      <table class="min-w-full table-auto">
        <thead class="bg-gray-200 text-gray-700">
          <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Designation</th>
            <th class="px-4 py-2">Phone</th>
            <th class="px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
          @foreach($posts as $post)
            <tr>
              <td class="px-4 py-2 text-center">{{ $post->id }}</td>
              <td class="px-4 py-2">{{ $post->name }}</td>
              <td class="px-4 py-2">{{ $post->email }}</td>
              <td class="px-4 py-2">{{ $post->designation }}</td>
              <td class="px-4 py-2">{{ $post->phone }}</td>
              <td class="px-4 py-2 flex space-x-2 justify-center">
                <a href="{{ route('edit', $post->id) }}" class="text-indigo-600 hover:underline">Edit</a>
                

                <form action="{{ route('delete' , $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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

</body>
</html>


