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
        'producto_id',
        'almacen_id',
        'precio_producto',
        'saldo'
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
