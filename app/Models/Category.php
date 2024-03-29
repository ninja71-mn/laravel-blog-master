<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'thumbnail', 'name', 'slug', 'is_published'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_posts');
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'category_subcategories');
    }

    public function publishedPosts()
    {
        return $this->belongsToMany(Post::class, 'category_posts')->where('is_published','=','1');
    }
}
