<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke($id = null)
    {
        if ($id) {
            // Fetch the specific post by ID with comments, category, and tags
            $post = Post::with(['comments', 'category.tags'])->findOrFail($id);
            return view('frontend.show', compact('post'));
        }

        // Fetch all posts for the homepage with categories and tags
        $posts = Post::with(['category.tags'])->get();
        return view('frontend.index', compact('posts'));
    }
        // Optional: Keep index method if needed for other purposes
        // public function index()
        // {
        //     $posts = Post::where('status', 1)->get(); // Fetch only published posts
        //     return view('frontend.home', compact('posts'));
        // }
        //     // Display the specified post
        // public function show(Post $post)
        // {
        //     $post->increment('views');
        //     return view('backend.posts.show', compact('post'));
        // }
}
