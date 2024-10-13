@extends('backend.layout.master')
@section('content')
<div class="row">

    <div class="col-12">

        @if (session('status'))

        <div class="alert alert-success">

            {{ session('status') }}

        </div>

        @endif

        <div class="card shadow-sm">

            <div class="card-header bg-secondary text-white">

                <h1 class="card-title d-flex justify-content-between align-items-center">

                    Categories

                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createCategoryModal">Create
                        Category</button>

                </h1>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table id="zero_config" class="table table-striped table-bordered table-hover">

                        <thead class="text-center bg-light">

                            <tr>

                                <th style="width: 10%;">Id</th>

                                <th style="width: 40%;">Name</th>
                                <th style="width: 30%;">Tags</th>
                                <th style="width: 20%;">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($categories as $category)

                            <tr class="text-center">

                                <td>{{ $category->id }}</td>

                                <td>{{ $category->title }}</td>
                                <td>
                                    @if ($category->tags->isNotEmpty())
                                        {{ $category->tags->pluck('name')->implode(', ') }} <!-- Display tags as a comma-separated list -->
                                    @else
                                        No Tags
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-warning btn-sm me-2 edit-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editCategoryModal"
                                    data-id="{{ $category->id }}"
                                    data-title="{{ $category->title }}"
                                    data-tags="{{ implode(',', $category->tags->pluck('id')->toArray()) }}">
                                    Edit
                                </a>

                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-id="{{ $category->id }}"
                                        data-title="{{ $category->title }}">

                                        Remove

                                    </button>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Delete Confirmation Modal -->

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content shadow" style="border-radius: 1rem;">

            <div class="modal-header">

                <h4 class="modal-title" id="deleteModalLabel">Confirm Deletion</h4>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body text-center">

                <i class="fas fa-trash-alt" style="font-size: 40px; color: #dc3545;"></i>

                <h5 class="mt-3">Are you sure you want to delete the category <strong id="categoryTitle"></strong>?</h5>

            </div>

            <div class="modal-footer">

                <form id="deleteForm" action="" method="POST">

                    @csrf

                    @method('DELETE')

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    <button type="submit" class="btn btn-danger">Delete</button>

                </form>

            </div>

        </div>

    </div>

</div>

<!-- Create Category Modal -->

<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content shadow" style="border-radius: 1rem;">

            <div class="modal-header">

                <h5 class="modal-title" id="createCategoryModalLabel">Create New Category</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="modal-body">

                    <div class="form-group">

                        <label for="title" class="control-label">Title</label>

                        <input type="text" class="form-control" id="title" name="title" placeholder="Title Here"
                            required>

                        @error('title')

                        <span class="text-danger">{{ $message }}</span>

                        @enderror

                    </div>

                    <div class="form-group mt-3">

                        <label for="tags" class="control-label">Tags:</label>

                        <select name="tags[]" id="tags" class="form-control" multiple>

                            @foreach ($tags as $tag)

                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Add</button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- Create Category Modal -->

<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content shadow" style="border-radius: 1rem;">

            <div class="modal-header">

                <h5 class="modal-title" id="createCategoryModalLabel">Create New Category</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="modal-body">

                    <div class="form-group">

                        <label for="title" class="control-label">Title</label>

                        <input type="text" class="form-control" id="title" name="title" placeholder="Title Here"
                            required>

                        @error('title')

                        <span class="text-danger">{{ $message }}</span>

                        @enderror

                    </div>

                    <div class="form-group mt-3">

                        <label for="tags" class="control-label">Tags:</label>

                        <select name="tags[]" id="tags" class="form-control" multiple>

                            @foreach ($tags as $tag)

                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Add</button>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow" style="border-radius: 1rem;">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editTitle" class="control-label">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="editTags" class="control-label">Tags:</label>
                        <select name="tags[]" id="editTags" class="form-control" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and CSS -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome CDN -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    .card {

        border-radius: 0.5rem;

    }

    .alert {

        border-radius: 0.5rem;

    }

    .btn-light {

        background-color: #f8f9fa;

        color: #007bff;

        border-radius: 0.25rem;

    }

    .btn-warning {

        background-color: #ffc107;

        color: #212529;

    }

    .btn-warning:hover {

        background-color: #e0a800;

    }

    table {

        border-collapse: separate;

        border-spacing: 0;

        width: 100%;

    }

    th,
    td {

        padding: 12px;

        text-align: center;

    }

    th {

        background-color: #f8f9fa;

        font-weight: bold;

    }

    tr:hover {

        background-color: #f1f1f1;

    }
</style>

<script>
    // JavaScript to handle the modal for deletion

    document.addEventListener('DOMContentLoaded', function () {

    var deleteModal = document.getElementById('deleteModal');

    deleteModal.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget; // Button that triggered the modal

    var categoryId = button.getAttribute('data-id');

    var categoryTitle = button.getAttribute('data-title');

    // Update the modal's content

    var form = deleteModal.querySelector('#deleteForm');

    form.action = '/categories/' + categoryId; // Set the action for the delete form

    deleteModal.querySelector('#categoryTitle').textContent = categoryTitle; // Set the category name

    });

    });

    // JavaScript to handle the modal for editing

    document.addEventListener('DOMContentLoaded', function () {

    var editModal = document.getElementById('editCategoryModal');

    editModal.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget; // Button that triggered the modal

    var categoryId = button.getAttribute('data-id');

    var categoryTitle = button.getAttribute('data-title');

    // Update the modal's content

    var form = editModal.querySelector('#editForm');

    form.action = '/backend/categories/' + categoryId; // Set the action for the update form

    editModal.querySelector('#editTitle').value = categoryTitle; // Set the existing title

    // Set selected tags

    var tags = button.getAttribute('data-tags').split(','); // Assuming data-tags contains comma-separated tag IDs

    var editTags = editModal.querySelectorAll('#editTags option');

    editTags.forEach(function(option) {

    option.selected = tags.includes(option.value);

    });

    });

    });

</script>
@endsection
