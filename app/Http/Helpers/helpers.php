<?php

use App\Models\Category;
use App\Models\SiteDetail;

function getSiteDetails(){
    $details=SiteDetail::first();
    return $details;
}

function getCategories(){
    $categories = Category::orderBy('name', 'ASC')->where('is_published', '1')->get();
    return $categories;
}
