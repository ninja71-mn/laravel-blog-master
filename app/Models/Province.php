<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public static function findByName(string $name)
    {
        $province = Province::where('name', $name)->with('cities')->first();
        return $province;
    }

    public static function findById($id)
    {
        $province = Province::where('id', $id)->with('cities')->first();
        return $province;
    }
    
}
