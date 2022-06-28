<?php


namespace App\Repositories;


use App\Models\Post;

class PostsRepository
{
    public function getAll($paginate='20')
    {
        return Post::orderBy('id', 'DESC')->where('post_type', 'post')->paginate($paginate);
    }

    public function getByUserId($id,$paginate='20')
    {
        return Post::orderBy('id', 'DESC')->where('post_type', 'post')->where('user_id',$id)->paginate($paginate);
    }

    public function countNew($time)
    {
        return Post::where('post_type','post')->where('is_published', '1')->where('created_at','>',$time)->count();

    }

    public function countAll()
    {
        return Post::where('post_type','post')->count();
    }

    public function getByLimit($limit=5)
    {
        return Post::orderBy('id','DESC')->where('post_type','post')->limit($limit)->get();

    }
}
