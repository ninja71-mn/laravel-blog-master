<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryPost extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'sub_category_id'];

}
