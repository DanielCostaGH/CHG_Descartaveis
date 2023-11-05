<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

    protected $table = 'admin';
    protected $guard = 'admin';

    protected $fillable = [
        'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
