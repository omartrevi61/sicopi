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
        Schema::create('ubpps', function (Blueprint $table) {
            $table->id();

            $table->integer('ubpp')->unsigned()->unique();
            $table->string('nombre')->unique();
            $table->string('director')->nullable();
            $table->string('extension')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubpps');
    }
};
