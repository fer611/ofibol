<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $fillable = [
        'total',
        'items',
        'cash',
        'cambio',
        'estado',
        'user_id'
    ];


    //Relaciones
    public function user()
    {
        //pertenece a
        return $this->belongsTo(User::class);
    }
}
