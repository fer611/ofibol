<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    protected $table = 'ingresos';
    protected $fillable = [
        'user_id',
        'proveedor_id',
        'almacen_id',
        'total',
        'items',
        'estado'
    ];

    //Relaciones
    public function user()
    {
        //pertenece a
        return $this->belongsTo(User::class);
    }

    public function proveedor(){
        //pertenece a
        return $this->belongsTo(Proveedor::class);
    }
    public function almacen(){
        //pertenece a
        return $this->belongsTo(Almacen::class);
    }
    /* Relacion de N a N */
    public function detallesIngreso()
    {   
        return $this->hasMany(DetalleIngreso::class, 'ingreso_id');
    }
}
