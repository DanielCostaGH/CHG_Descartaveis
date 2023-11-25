<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;

    protected $table = 'main_categories';

    protected $fillable = ['category_id', 'name', 'description', 'images', 'status'];


    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}


