<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->string('nombre');
            $table->string('especie');
            $table->string('raza')->nullable();
            $table->integer('edad')->nullable();
            $table->string('sexo')->nullable(); // macho o hembra
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('mascotas');
    }
};

