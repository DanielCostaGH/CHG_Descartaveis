<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'cart_id', 'address_id', 'total_price', 'payment_method', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class, 'cart_id');
    }

    public function userAddress()
    {
        return $this->belongsTo(UserAddress::class, 'address_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function getPendingOrders(){
        return self::with('user')->whereIn('status', ['pending', 'paid'])->get();
    }

    public static function getShippedOrders()
    {
        return self::with('user')->whereIn('status', ['shipped', 'delivered', 'canceled'])->get();
    }

}
