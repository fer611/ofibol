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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id');  // ID de la categoría relacionada
            $table->string('nombre');  // Nombre del producto
            $table->text('descripcion')->nullable();  // Descripción del producto, puede ser nulo
            $table->string('unidad_medida');  // Unidad de medida (caja, bolsa, etc.)
            $table->decimal('cantidad_unidad',10,2);  // Cantidad por caja/bolsa etc....
            $table->decimal('costo_actual', 10, 2);  // Costo actual (CPP)
            $table->decimal('porcentaje_margen', 5, 2);  // Porcentaje de margen para el precio de venta
            $table->decimal('precio_venta', 10, 2);  // Precio de venta calculado
            $table->string('imagen')->nullable();  // Ruta de la imagen del producto, puede ser nulo
            $table->decimal('stock_minimo', 10, 2)->default(0); //stock 
            $table->char('estado', 1)->default('1');  // Estado del producto (1 para activo, 0 para inactivo)

            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
