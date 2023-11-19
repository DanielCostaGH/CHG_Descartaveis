<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';
    protected $fillable = ['name', 'value'];

    public function productsColor()
    {
        return $this->hasMany('App\Models\Product', 'color_id');
    }

    public static function getAllColors(){
        return self::all();
    }
}
