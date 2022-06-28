<?php


namespace App\Repositories;


use App\Models\Gallery;

class GalleriesRepository
{
    public function getAll($paginate='20')
    {
        return Gallery::orderBy('id', 'DESC')->paginate($paginate);
    }

    public function getByUserId($id,$paginate='20')
    {
        return Gallery::orderBy('id', 'DESC')->where('user_id',$id)->paginate($paginate);
    }

    public function countNew($time)
    {
        return Gallery::where('created_at','>',$time)->count();
    }

    public function countAll()
    {
        return Gallery::count();
    }
}
