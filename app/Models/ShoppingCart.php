<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = ['user_id', 'status', 'total_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public static function getUserCart($userId){
        if ($userId) {
            return self::where('user_id', $userId)->first();
    }


}
}
