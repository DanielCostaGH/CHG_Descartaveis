<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenFrete extends Model
{
    use HasFactory;

    protected $table = 'token_frete';
    protected $fillable = ['access_token', 'expires_at', 'user_id'];
}
