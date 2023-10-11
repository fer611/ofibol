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
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->id();
            /* Precio del producto */
            $table->decimal('precio',10,2);
            /* Cuantas unidades del producto */
            $table->decimal('cantidad',10,2);
            /* Como nuestra tabla no es products, es decir no estamoos usando las convenciones, entonces lo especificamos en el constrained */
            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('venta_id')->constrained('ventas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
