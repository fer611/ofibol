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
        Schema::table('kardex', function (Blueprint $table) {
            $table->decimal('saldo_stock',10,2);
            $table->decimal('costo_producto',10,2);
            $table->decimal('debe',10,2);
            $table->decimal('haber',10,2);
            $table->decimal('saldo_valorado',10,2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kardex', function (Blueprint $table) {
            $table->dropColumn('saldo_stock');
            $table->dropColumn('costo_producto');
            $table->dropColumn('debe');
            $table->dropColumn('haber');
            $table->dropColumn('costo_valorado');  // Luego eliminar la columna
        });
    }
};
