<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'subcategory_posts');
    }

    public function publishedPosts()
    {
        return $this->belongsToMany(Post::class, 'subcategory_posts')->where('is_published','=','1');
    }
}
