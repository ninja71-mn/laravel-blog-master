<?php


namespace App\Repositories;


use App\Models\User;

class UsersRepository
{
    public function getAll($paginate='20')
    {
        return User::orderBy('id', 'DESC')->paginate($paginate);
    }

    public function getByUserId($id,$paginate='20')
    {
        return User::orderBy('id', 'DESC')->where('id',$id)->paginate($paginate);
    }

    public function countNew($time)
    {
        return User::where('created_at','>',$time)->count();

    }

    public function countAll()
    {
        return User::count();
    }

    public function getByLimit($limit=5)
    {

    }
}
