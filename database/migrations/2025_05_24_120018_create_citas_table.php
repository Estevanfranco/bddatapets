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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            
            // Aquí agregamos la relación con la tabla 'users'
            $table->unsignedBigInteger('user_id'); // Campo que almacena el id del usuario
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('mascota');
            $table->string('ciudad');
            $table->string('servicio');
            $table->date('fecha');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
