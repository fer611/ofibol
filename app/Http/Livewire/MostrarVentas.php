<?php

namespace App\Http\Livewire;

use App\Models\Venta;
use Livewire\Component;

class MostrarVentas extends Component
{

    protected $listeners = [
        'eliminarVenta' 
    ];
    public function render()
    {
        /* Obtener las ventas y ordenar por id */
        $ventas = Venta::orderBy('id', 'desc')->get();
        return view('livewire.mostrar-ventas',[
            'ventas' => $ventas
        ]);
    }

    public function eliminarVenta(string $id)
    {
        Venta::find($id)->delete();
        
    }

    public function reportPDF(Venta $venta)
    {
        
    }
}
