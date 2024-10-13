
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern CMS Frontend</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f6f9fc;
            color: #333;
        }
        header {
            background: linear-gradient(90deg, #4e54c8, #8f94fb);
            color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        nav {
            margin: 15px 0;
        }
        nav a {
            color: #fff;
            margin: 0 20px;
            text-decoration: none;
            transition: color 0.3s;
            font-weight: bold;
        }
        nav a:hover {
            color: #ffd700;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }
        .main-content {
            flex: 3;
            padding: 10px;
            margin-right: 20px;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4e54c8;
        }
        .card-text {
            color: #555;
            margin-bottom: 15px; /* Added margin at the bottom of the content */
        }
        .card-text small {
            display: block; /* Makes each line take its own space */
            margin-top: 5px;
            color: #555;
        }
        .img-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
            border-radius: 12px;
            margin-bottom: 15px;
        }
        .img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .category, .tags {
            background: #e0e7ff; /* Light background for categories and tags */
            border-radius: 8px;
            padding: 10px;
            margin: 10px 0;
        }
        .category span, .tags span {
            background: #4e54c8; /* Background color for span */
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .sidebar {
            flex: 1;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        footer {
            text-align: center;
            padding: 15px;
            background: #4e54c8;
            color: #fff;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h3 {
            border-bottom: 2px solid #4e54c8;
            padding-bottom: 10px;
            color: #4e54c8;
        }
        .tag-cloud {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .tag {
            background: #4e54c8;
            color: white;
            padding: 8px 15px;
            margin: 5px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s, transform 0.3s;
        }
        .tag:hover {
            background: #3a3f8f;
            transform: scale(1.05);
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .main-content {
                margin-right: 0;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>My Modern CMS</h1>
    <nav>
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </nav>
</header>

<div class="container">
    <div class="main-content">
        @if ($posts && $posts->isNotEmpty())
            @foreach ($posts as $post)
                <div class="card">
                    <div class="img-container">
                        <img src="{{ asset('storage/images/' . $post->image) }}" alt="{{ $post->title }}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">By {{ $post->author }} on {{ $post->created_at->format('F j, Y') }}</p>

                        <!-- Category Section -->
                        <div class="category">
                            <small class="text-muted">Category:
                                @if ($post->category)
                                    <span>{{ $post->category->title }}</span>
                                @else
                                    No Category
                                @endif
                            </small>
                        </div>

                        <!-- Tags Section -->
                        <div class="tags">
                            <small class="text-muted">Tags:
                                @if ($post->category && $post->category->tags && $post->category->tags->isNotEmpty())
                                    <span>{{ $post->category->tags->pluck('name')->implode(', ') }}</span>
                                @else
                                    No Tags
                                @endif
                            </small>
                        </div>

                        <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                        <div class="text-center">
                            <a href="{{ route('frontend.show', $post->id) }}" class="tag">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <p>No posts available.</p>
            </div>
        @endif
    </div>
</div>

<footer>
    <p>&copy; 2024 My Modern CMS | Privacy Policy | Terms of Service</p>
</footer>

<script>
    // Simple JavaScript for any dynamic features can be added here
    console.log("Welcome to My Modern CMS!");
</script>
</body>
</html>
