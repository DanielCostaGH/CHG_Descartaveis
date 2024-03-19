<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'order_id', 'product_id', 'unit_price', 'color', 'variation', 'quantity'];    
    protected $table = 'order_items';

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
