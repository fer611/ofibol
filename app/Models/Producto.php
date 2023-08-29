<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'marca',
        'origen',
        'unidad_medida',
        'precio',
        'stock',
        'categoria_id',
        'almacen_id',
    ];
}
