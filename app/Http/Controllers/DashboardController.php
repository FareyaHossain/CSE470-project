<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all staff records
        $posts = Post::all();

        // Pass to the dashboard view
        return view('dashboard', compact('posts'));
    }
}
