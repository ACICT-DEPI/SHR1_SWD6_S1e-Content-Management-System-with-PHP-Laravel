<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
      // Specify the fields that are mass assignable
      protected $fillable = [
        'category_id',
        'title',
        'author',
        'date',
        'image',
        'content',
        'tags',
        'comment_count',
        'status',
    ];
    // Cast the date attribute to a Carbon instance
    protected $casts = [
        'date' => 'datetime',
    ];
        // Specify the relationship with the Category model
        public function category()
        {
            return $this->belongsTo(Category::class);
        }
            // Define the relationship with Tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class); // Assuming a many-to-many relationship
    }

        // Method to publish the post
        public function publish()
        {
            $this->update(['status' => 1]); // Set status to published
        }

        // Method to unpublish the post
        public function unpublish()
        {
            $this->update(['status' => 0]); // Set status to unpublished
        }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
