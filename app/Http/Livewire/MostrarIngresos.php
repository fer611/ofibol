<?php

namespace App\Http\Livewire;

use App\Models\Ingreso;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MostrarIngresos extends Component
{
    public function render()
    {
        $ingresos = DB::table('ingresos')
            ->select(
                'ingresos.*',
                'users.name as user_name', // Alias para el campo name de users
                'proveedores.nombre as proveedor_nombre', // Alias para el campo nombre de proveedores
                /* Aca obtenemos el total del ingreso */
                DB::raw('SUM(detalle_ingreso.cantidad * detalle_ingreso.precio_compra) as totalIngreso'),
                )
            ->join('detalle_ingreso', 'ingresos.id', '=', 'detalle_ingreso.ingreso_id')
            ->join('users', 'ingresos.user_id', '=', 'users.id')
            ->join('proveedores', 'ingresos.proveedor_id', '=', 'proveedores.id')
            ->groupBy('ingresos.id')
            ->get();


        return view('livewire.mostrar-ingresos', [
            'ingresos' => $ingresos
        ]);
    }
}
