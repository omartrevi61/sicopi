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
        Schema::create('profesors', function (Blueprint $table) {
            $table->id();

            $table->integer('expediente')->unsigned()->unique();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('grado', 10);
            $table->foreignId('ubpp_id')->constrained();
            $table->string('email')->nullable();
            $table->string('telefono', 50)->nullable();

            // generamos una columna virtual con la concatenación del nombre mas los apellidos
            $table->string('nombre_completo')->virtualAs('concat(nombre, \' \', apellidos)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesors');
    }
};
