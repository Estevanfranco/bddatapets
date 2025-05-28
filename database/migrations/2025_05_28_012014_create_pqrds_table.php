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
        Schema::create('pqrds', function (Blueprint $table) {
        $table->id();
        $table->enum('tipoPQRDS', ['Petición', 'Queja', 'Reclamo', 'Denuncia', 'Sugerencia']);
        $table->string('asunto', 150);
        $table->text('mensaje');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pqrds');
    }
};
