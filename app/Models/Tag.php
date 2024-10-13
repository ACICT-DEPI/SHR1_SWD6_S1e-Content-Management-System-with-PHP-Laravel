<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // Define the relationship with Post
    public function posts()
    {
        return $this->belongsToMany(Post::class); // Assuming a many-to-many relationship
    }
    // relationship with categories
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
