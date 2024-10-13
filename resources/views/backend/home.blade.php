@extends('backend.layout.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none; /* Hidden by default */
        }
        .loading.show {
            display: flex; /* Show loading when needed */
        }

        .header {
            padding: 4rem 0;
            text-align: center;
            background-color: #343a40;
            color: #fff;
        }

        .card {
            margin: 2rem 0;
            padding: 1rem;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
        }
    </style>
</head>

    <div class="loading" id="loading">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <header class="header">
        <h1>Welcome to My CMS Dashboard</h1>
        <p>Manage My content efficiently and effectively.</p>
    </header>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Posts Overview</h5>
                        <p class="card-text">View and manage your posts here.</p>
                        <a href="{{ route('posts.index') }}" class="btn btn-primary">Go to Posts</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Categories Overview</h5>
                        <p class="card-text">Organize your content with categories.</p>
                        <a href="{{ route('categories.index') }}" class="btn btn-primary">Go to Categories</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Analytics Overview</h5>
                        <p class="card-text">Track your content performance.</p>
                        <a href="{{ route('comments.index') }}" class="btn btn-primary">View Analytics</a>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <p>&copy; 2024 CMS Dashboard. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simulate loading
        document.getElementById('loading').classList.add('show');
        setTimeout(function() {
            document.getElementById('loading').classList.remove('show');
        }, 2000); // Adjust time as needed
    </script>
</body>
@endsection

