<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key to categories
            $table->string('title'); // Post title
            $table->string('author'); // Author of the post
            $table->dateTime('date'); // Date of the post
            $table->string('image')->nullable(); // Image URL or path
            $table->text('content'); // Content of the post
            $table->string('tags')->nullable(); // Comma-separated tags
            $table->integer('comment_count')->default(0); // Number of comments
            $table->boolean('status')->default(1); // Status of the post (1 = active, 0 = inactive)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
