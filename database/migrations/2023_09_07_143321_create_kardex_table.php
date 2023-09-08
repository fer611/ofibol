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
        Schema::create('kardex', function (Blueprint $table) {
            $table->id();
            $table->decimal('entradas',10,2);
            $table->decimal('salidas',10,2);
            $table->foreignId('almacen_id')->constrained('almacenes')->onDelete('cascade'); //relacionando con la tabla almaccenes
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); //relacionando con la tabla productos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kardex');
    }
};
