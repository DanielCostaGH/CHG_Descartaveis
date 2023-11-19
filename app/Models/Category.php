<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id');
    }

    public static function getAvailableCategorys()
    {
        return self::where('status', 'active')->get();
    }
}
