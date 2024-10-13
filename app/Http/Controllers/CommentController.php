<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::with('post')->get(); // Fetch all comments with related posts
        return view('backend.comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id', // Validate post_id
            'author' => 'required|string|max:255',
            'content' => 'required|string',
            'published' => 'boolean',
        ]);

        // Create the comment with the post_id
        $comment = Comment::create([
            'post_id' => $request->post_id,
            'author' => $request->author,
            'content' => $request->content,
            'published' => $request->has('published'),
            'is_spam' => false, // Default to not spam
        ]);

        // Notify users of the new comment (optional)
        //Notification::send(User::all(), new NewCommentNotification($comment));

        // Update the comments count on the post
        $post = $comment->post;
        $post->increment('comments_count');

        return redirect()->route('posts.show', $post->id)->with('status', 'Comment added successfully!');
    }

    public function togglePublish(Comment $comment)
    {
        $comment->published = !$comment->published; // Toggle published status
        $comment->save();

        return redirect()->route('comments.index')->with('status', 'Comment updated successfully!');
    }

    public function toggleSpam(Comment $comment)
    {
        // Toggle the is_spam status
        $comment->is_spam = !$comment->is_spam; // If true, set to false; if false, set to true
        $comment->save();

        // Set a status message based on the new state
        $status = $comment->is_spam ? 'Comment marked as spam.' : 'Comment marked as not spam.';
        return redirect()->back()->with('status', $status);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comments.index')->with('status', 'Comment deleted successfully!');
    }
}
