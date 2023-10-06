<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'barcode',
        'descripcion',
        'marca_id',
        'origen_id',
        'unidad_medida',
        'cantidad_unidad',
        'stock_minimo',
        'costo_actual',
        'porcentaje_margen',
        'precio_venta',
        'imagen',
        'estado',
        'categoria_id',
    ];

    //Relaciones
    public function categoria()
    {
        //pertenece a
        return $this->belongsTo(Categoria::class);
    }

    public function marca()
    {
        //pertenece a
        return $this->belongsTo(Marca::class);
    }
    public function origen()
    {
        //pertenece a
        return $this->belongsTo(Origen::class);
    }

    /* Relacion de N a N */
    public function detallesIngreso()
    {   
        return $this->hasMany(DetalleIngreso::class, 'producto_id');
    }
}
