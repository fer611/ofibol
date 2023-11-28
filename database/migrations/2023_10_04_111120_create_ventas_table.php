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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->decimal('total', 10, 2);
            /* La cantidad de productos que se venden */
            $table->integer('items');
            /* Es la cantidad que el cliente paga */
            $table->decimal('cash', 10, 2);
            /* El cambio que se le da de vuelto al cliente */
            $table->decimal('cambio', 10, 2);
            $table->enum('estado', ['pagado', 'pendiente', 'cancelado'])->default('pagado');
            /* La relacion con users */
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            /* Agregamos la columna cliente_id como clave foránea */
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            /* Agregamos la columna de venta_id como clave foranea */
            $table->foreignId('almacen_id')->constrained('almacenes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
