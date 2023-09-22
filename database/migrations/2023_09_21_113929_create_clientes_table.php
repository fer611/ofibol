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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social'); // Cambio de 'nombre_completo' a 'razon_social'
            $table->string('nit');
            $table->string('telefono')->nullable(); // Campo opcional
            $table->string('direccion')->nullable(); // Campo opcional
            $table->string('email')->nullable(); // Campo de correo electrónico opcional
            $table->char('estado', 1)->default('1'); // Campo de estado (1 activo, 0 inactivo)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
