<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motoboy extends Model
{
    use HasFactory;

    protected $table = 'motoboys';
    protected $attributes = ['id_status' => 1];
}
