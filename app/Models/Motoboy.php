<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Motoboy extends Authenticatable
{
    use HasFactory;

    protected $table = 'motoboys';

    protected $attributes = ['status' => 'offline'];

    protected $fillable = [
        'nome',
        'email',
        'password',
        'telefone',
        'cpf',
        'placa',
        'status',
    ];
}
