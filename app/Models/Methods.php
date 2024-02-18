<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Methods extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';

    protected $fillable = ['id', 'card_id', 'name'];


    public function creditCards()
    {
        return $this->belongsTo(CreditCard::class, 'id');
    }
}
