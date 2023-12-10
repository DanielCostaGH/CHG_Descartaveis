<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id,sku, name, description, price, images, category_id, brand, color, variation, quantity, status'];
    protected $table = 'product';
    use HasFactory;

    public static function getAvailableProducts()
    {
        return self::where('status', 'active')->get();
    }


    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
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
}
