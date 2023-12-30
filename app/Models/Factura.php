<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $table = 'facturas';
    protected $fillable = [
        'cliente_id',
        'numero_factura',
        'fecha',
        'total',
        'estado',
        'categoria'
    ];

    //Relaciones
    public function cliente()
    {
        //pertenece a
        return $this->belongsTo(Cliente::class);
    }
}
