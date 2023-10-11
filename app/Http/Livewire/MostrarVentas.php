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
        $ventas = Venta::all();
        return view('livewire.mostrar-ventas',[
            'ventas' => $ventas
        ]);
    }

    public function eliminarVenta(string $id)
    {
        Venta::find($id)->delete();
        
    }
}
