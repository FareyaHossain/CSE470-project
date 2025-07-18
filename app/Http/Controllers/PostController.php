<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show the form to create a new staff member
    public function create()
    {
        return view('create');
    }

    // Store or Add the new staff member in the database
    public function ourfilestore(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|unique:posts|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'designation' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $post = new Post();
        $post->id = $request->id;
        $post->name = $request->name;
        $post->email = $request->email;
        $post->designation = $request->designation;
        $post->phone = $request->phone;
        $post->save();

        return redirect()->route('home')->with('success', 'Staff created successfully!');
    }

    // Show the form to edit a specific staff member
    public function editData($id)
    {
        $post = Post::findOrFail($id);
        return view('edit', compact('post'));
    }

    // Update the staff member's data
    public function updateData(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'designation' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'phone' => $request->phone,
        ]);

        return redirect()->route('home')->with('success', 'Staff updated successfully!');
    }
//delete the staff member.
    public function deleteData($id)
{
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect()->route('home')->with('success', 'Staff deleted successfully!');
}
}
