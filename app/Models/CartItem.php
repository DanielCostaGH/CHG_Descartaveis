<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'unit_price', 'variation', 'color'];

    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getCartProducts($shoppingCart){
        if ($shoppingCart){
            return self::where('cart_id','=',$shoppingCart->id)->get();
        }
    }


}
