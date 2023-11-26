<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $attributes = ['id_status' => 1];

    protected $fillable = [
        'code',
        'desc',
        'distancia',
        'tempo',
        'preco',
        'peso',
        'tamanho',
        'id_status',
        'id_destinatario',
        'id_remetente',
        'id_motoboy',
    ];
}
