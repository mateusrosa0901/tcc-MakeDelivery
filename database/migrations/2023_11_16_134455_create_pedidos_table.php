<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('desc');
            $table->string('distancia');
            $table->string('tempo');
            $table->decimal('preco', 8, 2);
            $table->decimal('motoboy_preco', 8, 2);
            $table->string('peso');
            $table->string('tamanho');
            $table->string('status');
            $table->unsignedBigInteger('id_destinatario');
            $table->unsignedBigInteger('id_remetente');
            $table->unsignedBigInteger('id_motoboy')->nullable();
            $table->foreign('id_destinatario')->references('id')->on('users');
            $table->foreign('id_remetente')->references('id')->on('users');
            $table->foreign('id_motoboy')->references('id')->on('motoboys');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
