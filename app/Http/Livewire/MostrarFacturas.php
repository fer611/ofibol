<?php

namespace App\Http\Livewire;

use App\Models\Factura;
use Livewire\Component;

class MostrarFacturas extends Component
{
    public function render()
    {
        $facturas = Factura::orderBy('id', 'desc')->get();
        return view('livewire.mostrar-facturas',[
            'facturas' => $facturas
        ]);
    }
}
