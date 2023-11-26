<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $table = 'footer';
    protected $fillable = ['whatsapp_num', 'call_num', 'instagram', 'email', 'image'];



}
