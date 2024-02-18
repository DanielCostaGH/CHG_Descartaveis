<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';
    protected $fillable = ['id', 'user_id', 'product_id'];



    public static function getUserFavorites($userId){
        return self::where('user_id', $userId)->get();
    }
}
