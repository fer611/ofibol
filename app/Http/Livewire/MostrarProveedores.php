<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use Livewire\Component;

class MostrarProveedores extends Component
{
    public function render()
    {
        $proveedores = Proveedor::all();
        return view('livewire.mostrar-proveedores',[
            'proveedores' => $proveedores
        ]);
    }
}
