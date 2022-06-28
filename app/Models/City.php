<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class City extends Model
{
    use HasFactory;

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function findByName($name)
    {
        $city = City::where('name', $name)->with('province')->first();
        return $city;
    }

    public static function findById($id)
    {
        $city = City::where('id', $id)->with('province')->first();
        return $city;
    }
}
