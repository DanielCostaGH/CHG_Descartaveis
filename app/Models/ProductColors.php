<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColors extends Model
{
    use HasFactory;

    protected $table = 'product_colors';

    protected $fillable = ['product_id', 'color_id']; 

    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
