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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('representante')->nullable(); // Haciendo el campo opcional
            $table->string('telefono')->nullable();       // Haciendo el campo opcional
            $table->string('direccion')->nullable();      // Haciendo el campo opcional
            $table->string('correo')->nullable();         // Haciendo el campo opcional
            $table->char('estado',1); //1 activo, 0 inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
