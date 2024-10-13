@extends('backend.layout.master')

@section('content')
<div class="container ">
    <div class="card-header bg-secondary text-white">
        <h1 class="card-title d-flex justify-content-between align-items-center">
            Posts
            <a href="{{ route('posts.create') }}" class="btn btn-light mb-3">Create New Post</a>
        </h1>
    </div>

    <div class="card-body">
        <form id="bulk-action-form" action="{{ route('posts.bulkAction') }}" method="POST">
            @csrf
            <div class="mb-3">
                <select name="action" class="form-select" required>
                    <option value="">Select an action</option>
                    <option value="publish">Publish</option>
                    <option value="delete">Delete</option>
                </select>
                <button type="submit" class="btn btn-primary" style="margin-top: 5px;">Apply</button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center font-weight-bold">
                                <input type="checkbox" id="select-all"> <!-- Select All Checkbox -->
                            </th>
                            <th class="text-center font-weight-bold">ID</th>
                            <th class="text-center font-weight-bold">Title</th>
                            <th class="text-center font-weight-bold">Author</th>
                            <th class="text-center font-weight-bold">Date</th>
                            <th class="text-center font-weight-bold">Category</th>
                            <th class="text-center font-weight-bold">Status</th>
                            <th class="text-center font-weight-bold">Comments Count</th>
                            <th class="text-center font-weight-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="post_ids[]" value="{{ $post->id }}" class="post-checkbox">
                                </td>
                                <td class="text-center">{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->author }}</td>
                                <td class="text-center">{{ $post->date->format('Y-m-d H:i') }}</td>
                                <td>{{ $post->category->title }}</td>
                                <td class="text-center">{{ $post->status ? 'Active' : 'Inactive' }}</td>
                                <td class="text-center">{{ $post->comments_count }}</td>
                                <td class="text-center">
                                    <div style="display: flex; justify-content: center; gap: 5px;">
                                        <a href="{{ route('posts.preview', $post) }}" class="btn btn-info btn-sm">Preview</a>

                                        @if ($post->status)
                                            <form action="{{ route('posts.unpublish', $post) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary btn-sm">Unpublish</button>
                                            </form>
                                        @else
                                            <form action="{{ route('posts.publish', $post) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Publish</button>
                                            </form>
                                        @endif
                                    </div>

                                    <div style="margin-top: 5px; display: flex; justify-content: center; gap: 5px;">
                                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>

                                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<style>
.card {
    border-radius: 0.5rem;
}

.btn-light {
    background-color: #f8f9fa;
    color: #007bff;
    border-radius: 0.25rem;
}
</style>

<script>
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.post-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});
</script>
@endsection
