<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\HomeController as frontHome;
Route::get('/', function () {
    return view('welcome');
});


Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Admin Dashboard Route
// Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth', 'admin');

Route::middleware('auth', 'admin')->prefix('backend')->group(function() {
    Route::get('/', HomeController::class)->name('home');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::put('users/{id}/update-image', [UserController::class, 'updateImage'])->name('users.updateImage');
    Route::resource('/categories', CategoryController::class);
    Route::post('posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
    Route::post('posts/{post}/unpublish', [PostController::class, 'unpublish'])->name('posts.unpublish');
    Route::resource('posts', PostController::class);

    // Change this part to resourceful route for comments
    Route::resource('comments', CommentController::class)->except(['create', 'show']);

    // Explicitly define the toggle route
    Route::post('/comments/{comment}/toggle', [CommentController::class, 'togglePublish'])->name('comments.toggle');
    Route::patch('/comments/{comment}/toggle-spam', [CommentController::class, 'toggleSpam'])->name('comments.toggleSpam');
    Route::post('/posts/bulk-action', [PostController::class, 'bulkAction'])->name('posts.bulkAction');
    Route::get('/posts/{post}/preview', [PostController::class, 'preview'])->name('posts.preview');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
});
Route::prefix('frontend')->group(function() {
    Route::get('/', frontHome::class)->name('frontend.home'); // Ensure the route name is 'frontend.home'
    Route::get('/detailsPost/{id}', frontHome::class)->name('frontend.show'); // Use 'frontend.show' for post details
});
