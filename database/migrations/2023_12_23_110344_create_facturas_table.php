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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            //Relacionamos con cliente
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            /* El numero de la factura */
            $table->integer('numero_factura');
            $table->date('fecha')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->string('estado',20);
            $table->enum('categoria', ['Material De Escritorio', 'Material De Limpieza']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
