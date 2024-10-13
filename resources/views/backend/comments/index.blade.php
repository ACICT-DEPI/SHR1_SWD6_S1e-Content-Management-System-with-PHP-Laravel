@extends('backend.layout.master')

@section('content')
<div class="container">

    <div class="card-header bg-secondary text-white">
        <h1 class="card-title d-flex justify-content-between align-items-center">
            Comments Management
        </h1>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="card-body">
        <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead class="text-center bg-light">
            <tr>
                <th>Post Title</th>
                <th>Author</th>
                <th>Content</th>
                <th>Published</th>
                <th>Spam</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment->post->title }}</td>
                    <td>{{ $comment->author }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>
                        <form action="{{ route('comments.toggle', $comment) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-{{ $comment->published ? 'success' : 'danger' }}">
                                {{ $comment->published ? 'Published' : 'Unpublished' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('comments.toggleSpam', $comment) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $comment->is_spam ?'success':'warning'}}">
                                {{ $comment->is_spam ? ' Mark as Spam' : 'Not Spam' }}

                            </button>
                        </form>

                    </td>
                    <td>
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </div>
</div>

@endsection
