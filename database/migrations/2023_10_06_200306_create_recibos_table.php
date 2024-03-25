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
        Schema::create('recibos', function (Blueprint $table) {
            $table->id();

            $table->date('fecha');
            $table->foreignId('proyecto_id')->references('id')->on('proyectos');
            $table->foreignId('tipo_pago_id')->references('id')->on('tipo_pagos');
            $table->string('beneficiario', 255);
            // $table->decimal('total', 11, 2);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('administrativo_id')->references('id')->on('administrativos');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibos');
    }
};
