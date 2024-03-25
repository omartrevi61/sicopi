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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();

            $table->string('proyecto', 30)->unique();
            $table->text('titulo');

            $table->foreignId('tipo_proyecto_id')->references('id')->on('tipo_proyectos');
            $table->foreignId('profesor_id')->references('id')->on('profesors');
            $table->foreignId('centro_id')->references('id')->on('centros');
            $table->decimal('aprobado', 11, 2);
            $table->integer('porcentaje');

            // generamos una columna virtual con la 
            $table->decimal('asignado')->virtualAs('aprobado * porcentaje / 100');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
