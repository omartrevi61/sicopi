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
        Schema::create('recibo_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('recibo_id')->references('id')->on('recibos')->onDelete('cascade');
            $table->foreignId('provedor_id')->nullable()->references('id')->on('provedors')->nullOnDelete();
            $table->string('factura')->unique();
            $table->date('fecha_factura');
            $table->string('concepto');
            $table->decimal('importe');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibo_items');
    }
};
