<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // The __invoke method to handle requests
    public function __invoke(Request $request)
    {
        $posts = Post::where('status', 1)->get(); // Fetch only published posts
        return view('backend.home', compact('posts'));
    }

    // Optional: Keep index method if needed for other purposes
    public function index()
    {
        $posts = Post::where('status', 1)->get(); // Fetch only published posts
        return view('backend.home', compact('posts'));
    }
}