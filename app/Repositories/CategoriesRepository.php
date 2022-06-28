<?php


namespace App\Repositories;


use App\Models\Category;

class CategoriesRepository
{

    public function getAll($paginate='20')
    {
        return Category::orderBy('id', 'DESC')->paginate($paginate);
    }

    public function getByUserId($id,$paginate='20')
    {
        return Category::orderBy('id', 'DESC')->where('user_id',$id)->paginate($paginate);
    }

    public function countNew($time)
    {
        return Category::where('is_published', '1')->where('created_at','>',$time)->count();

    }

    public function countAll()
    {
        return Category::count();
    }

    public function getByLimit($limit=5)
    {
        return Category::orderBy('id','DESC')->limit($limit)->get();

    }

    public function pluck()
    {
        return Category::orderBy('name', 'ASC')->pluck('name', 'id');
    }
}
