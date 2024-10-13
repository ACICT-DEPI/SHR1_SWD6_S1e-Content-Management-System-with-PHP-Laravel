<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Display a listing of the posts
    public function index()
    {
        $posts = Post::withCount('comments')->get(); // Fetch posts with comments count
        return view('backend.posts.index', compact('posts'));
    }
    public function publish(Post $post)
    {
        $post->update(['status' => 1]); // Set status to published
        return redirect()->route('posts.index')->with('status', 'Post published successfully!');
    }

    public function unpublish(Post $post)
    {
        $post->update(['status' => 0]); // Set status to unpublished
        return redirect()->route('posts.index')->with('status', 'Post unpublished successfully!');
    }
    // Show the form for creating a new post
    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        return view('backend.posts.create', compact('categories')); // Pass categories to the view
    }

    // Store a newly created post in storage
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Make image optional
            'content' => 'required',
            'tags' => 'nullable|string',
            'status' => 'boolean',
        ]);

        // Initialize image name
        $imageName = null;

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Generate a unique image name
            $imageName =  $image->getClientOriginalName();
            $image->storeAs('images', $imageName, 'public');
        }

        // Create the post
        Post::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'author' => $request->author,
            'date' => $request->date,
            'image' => $imageName,
            'content' => $request->content,
            'tags' => $request->tags,
            'status' => $request->has('status') ? true : false,
        ]);

        return redirect()->route('posts.index')->with('status', 'Post Created Successfully');
    }
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $postIds = $request->input('post_ids');

        if ($action === 'publish') {
            Post::whereIn('id', $postIds)->update(['status' => 1]);
            return redirect()->route('posts.index')->with('status', 'Selected posts published successfully!');
        } elseif ($action === 'delete') {
            Post::whereIn('id', $postIds)->delete();
            return redirect()->route('posts.index')->with('status', 'Selected posts deleted successfully!');
        }

        return redirect()->route('posts.index')->with('status', 'No action performed.');
    }
    // Display the specified post
    public function show(Post $post)
    {
        $post->increment('views');
        return view('backend.posts.show', compact('post'));
    }

    // Show the form for editing the specified post
    public function edit(Post $post)
    {
        return view('backend.posts.edit', compact('post'));
    }

    // Update the specified post in storage
    public function update(Request $request, Post $post)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'date' => 'required|date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'content' => 'required',
        'tags' => 'nullable|string',
        'status' => 'boolean',
    ]);

    // Get the existing image name
    $imageName = $post->image;

    // Check if a new image file is uploaded
    if ($request->hasFile('image')) {
        // Delete the existing image if it exists
        $this->deleteImage($post);

        // Store the new image
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName(); // Unique name
        $image->storeAs('images', $imageName, 'public');
    }

    // Update the post with the new data
    $post->update([
        'category_id' => $request->category_id,
        'title' => $request->title,
        'author' => $request->author,
        'date' => $request->date,
        'image' => $imageName,
        'content' => $request->content,
        'tags' => $request->tags,
        'status' => $request->has('status') ? true : false,
    ]);

    return redirect()->route('posts.index')->with('status', 'Post updated successfully!');
    }
    public function like(Post $post)
    {
        $post->increment('likes'); // Increment the likes count
        return redirect()->back()->with('status', 'Post liked!');
    }
    public function preview(Post $post)
    {
        return view('backend.posts.preview', compact('post'));
    }
    //  Delete the existing image of a category.

   private function deleteImage($category)
   {
       if ($category->images) {
           Storage::disk('public')->delete('images/' . $category->images);
       }
   }
    // Remove the specified post from storage
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('status', 'Post deleted successfully!');
    }
}
