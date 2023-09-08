<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    /* Esto para especificar que la tabla se llama proveedores, si no 
    lo ponemos laravel lo interpreta de la siguiente manera: proveedors */
    protected $table = 'proveedores';
    /* El fillable para especificarle a laravel que datos se almacenan en la bd */
    protected $fillable = [
        'nombre',
        'representante',
        'telefono',
        'direccion',
        'correo',
        'estado'
    ];
}
