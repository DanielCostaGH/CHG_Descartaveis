<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_addresses';

    protected $fillable = ['zipcode', 'city', 'state', 'neighborhood', 'number', 'street', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public static function getAllAddresses($user){
        $addresses = self::where('user_id', $user->id)->get();

        return $addresses;
    }
}


