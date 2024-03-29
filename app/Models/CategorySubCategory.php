<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'sub_category_id'];

}
