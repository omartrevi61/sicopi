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
        Schema::create('centros', function (Blueprint $table) {
            $table->id();

            $table->integer('centro')->unsigned()->unique();
            $table->string('nombre');
            $table->string('coordinador')->nullable();
            $table->foreignId('ubpp_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('proy_ptal');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centros');
    }
};
