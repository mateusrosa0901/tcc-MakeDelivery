<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $attributes = ['status' => 'Confirmando'];

    protected $fillable = [
        'code',
        'desc',
        'distancia',
        'tempo',
        'preco',
        'peso',
        'tamanho',
        'status',
        'id_destinatario',
        'id_remetente',
    ];
}
