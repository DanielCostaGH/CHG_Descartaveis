<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id', 'sku', 'name', 'description', 'price', 'images', 'category_id', 'brand', 'color', 'variation', 'quantity', 'status'];    
    protected $table = 'product';
    protected $appends = ['avg_rating'];
    use HasFactory;


    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }
    public static function getAvailableProducts()
    {
        return self::where('status', 'active')->get();
    }

    public function getAvgRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0.0;
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }


    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function searchByName($query)
    {
        return self::where('name', 'LIKE', "%{$query}%")
            ->limit(7)
            ->get();
    }

    public function productColors()
    {
        return $this->hasMany(ProductColors::class, 'product_id');
    }

    public static function getProductPrice($productId)
    {
        return self::select("price")->find($productId);
    }
}
