<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $attributes = [
        'status' => 'ativo',
        'perfil_img' => 'default.jpg',
    ];

    protected $fillable = [
        'nome',
        'email',
        'password',
        'telefone',
        'cpf',
        'perfil_img',
        'cep',
        'logradouro',
        'bairro',
        'cidade',
        'uf',
        'numero',
        'status'
    ];

    protected $hidden = [
        'password',
    ];
}
