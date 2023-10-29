<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id,sku, name, description, price, image_names, category_id, brand, color, variation, quantity, status, image_path'];
    protected $table = 'product';
    use HasFactory;
}
