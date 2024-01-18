<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    use HasFactory;
    protected $table = 'kardex';
    protected $fillable = [
        'entradas',
        'salidas',
        'almacen_id',
        'producto_id',
        'detalle',
        'saldo_stock',
        'costo_producto',
        'debe',
        'haber',
        'saldo_valorado',
    ];

     //si dice rol espera almacen
     public function almacen()
     {
         //pertenece a
         return $this->belongsTo(Almacen::class);
     }

     public function producto()
     {
         //pertenece a
         return $this->belongsTo(Producto::class);
     }
}
