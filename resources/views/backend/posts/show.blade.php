@extends('backend.layout.head')
@extends('backend.layout.main-header')
@extends('backend.layout.scripts')


<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-4">{{ $post->title }}</h1>
        <p class="text-muted">By <strong>{{ $post->author }}</strong> on {{ $post->date->format('F j, Y') }}</p>
    </div>

    <!-- Like and Share Buttons -->
    <div class="d-flex justify-content-center mb-4">
        <form action="{{ route('posts.like', $post->id) }}" method="POST" class="me-2">
            @csrf
            <button type="submit" class="btn btn-outline-success">
                <i class="bi bi-heart-fill"></i> Like ({{ $post->likes }})
            </button>
        </form>
        <button class="btn btn-outline-primary" onclick="sharePost('{{ $post->id }}')">
            <i class="bi bi-share-fill"></i> Share
        </button>
    </div>

    <!-- Performance Metrics -->
    <div class="mb-4 text-center">
        <span class="badge bg-info me-2">Views: {{ $post->views }}</span>
        <span class="badge bg-success me-2">Likes: {{ $post->likes }}</span>
        <span class="badge bg-warning">Shares: {{ $post->shares }}</span>
    </div>

    @if ($post->image)
        <div class="mb-4">
            <img src="{{ asset('storage/images/'. $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded shadow" style="width: 100%; height: 500px;">
        </div>
    @endif

    <div class="mt-3 mb-5">
        <p class="lead text-justify">{{ $post->content }}</p>
    </div>

    <h2 class="mt-4">Comments ({{ $post->comments_count }})</h2>

    @foreach($post->comments as $comment)
        @if($comment->published && !$comment->is_spam)
            <div class="comment mb-3 p-3 border rounded shadow-sm bg-light">
                <strong>{{ $comment->author }}</strong>
                <p>{{ $comment->content }}</p>
            </div>
        @elseif($comment->is_spam)
            <div class="comment mb-3 p-3 border rounded shadow-sm bg-light">
                <strong>{{ $comment->author }}</strong>
                <p class="text-muted">This comment has been marked as spam.</p>
            </div>
        @endif
    @endforeach

    <!-- User Engagement Stats -->
    <div class="mt-4">
        <h4>User Engagement Stats</h4>
        <p>Total Comments: <strong>{{ $post->comments_count }}</strong></p>
        <p>Published Comments: <strong>{{ $post->comments->where('published', true)->count() }}</strong></p>
        <p>Spam Comments: <strong>{{ $post->comments->where('is_spam', true)->count() }}</strong></p>
    </div>

    <h3 class="mt-4">Add a Comment</h3>
    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="border p-4 rounded bg-light shadow-sm">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="form-group">
            <label for="author">Name</label>
            <input type="text" name="author" class="form-control" placeholder="Your Name" required>
        </div>
        <div class="form-group">
            <label for="content">Comment</label>
            <textarea name="content" class="form-control" rows="4" placeholder="Your Comment" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
    </form>

    <br>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back to Posts</a>
</div>

<script>
function sharePost(postId) {
    // Implement share functionality (for example, open a share dialog)
    alert('Sharing post ID: ' + postId);
    // You can integrate with social media APIs or use a sharing library here
}
</script>

<!-- Include Bootstrap Icons (Optional) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

