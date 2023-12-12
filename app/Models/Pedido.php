<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $attributes = [
        'status' => 'Procurando entregador',
        'id_motoboy' => 1,
    ];

    protected $fillable = [
        'code',
        'desc',
        'distancia',
        'tempo',
        'preco',
        'motoboy_preco',
        'peso',
        'tamanho',
        'status',
        'id_motoboy',
        'id_destinatario',
        'id_remetente',
    ];
}
