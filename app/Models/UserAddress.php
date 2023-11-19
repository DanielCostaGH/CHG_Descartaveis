<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    // Nome da tabela associada ao modelo
    protected $table = 'user_addresses';

    // Colunas que podem ser atribuídas em massa (mass assignable)
    protected $fillable = [
        'rua', 'numero', 'cep', 'cidade', 'estado', 'user_id'
    ];

    // Relacionamento com a tabela de usuários (um endereço pertence a um usuário)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


