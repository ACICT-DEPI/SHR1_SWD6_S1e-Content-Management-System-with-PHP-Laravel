@extends('backend.layout.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h1 class="card-title">Preview Post: {{ $post->title }}</h1>
        </div>
        <div class="card-body">
            <h3>{{ $post->title }}</h3>
            <p><strong>Author:</strong> {{ $post->author }}</p>
            <p><strong>Date:</strong> {{ $post->date->format('Y-m-d H:i') }}</p>
            <p><strong>Category:</strong> {{ $post->category->title }}</p>
            <p><strong>Status:</strong> {{ $post->status ? 'Published' : 'Draft' }}</p>
            <div>
                <strong>Content:</strong>
                <div>{!! nl2br(e($post->content)) !!}</div>
            </div>
            @if ($post->image)
                <div>
                    <strong>Image:</strong>
                    <img src="{{ asset('storage/images/' . $post->image) }}" alt="Post Image" class="img-fluid">
                </div>
            @endif
            <div class="mt-3">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
            </div>
        </div>
    </div>
</div>
@endsection
