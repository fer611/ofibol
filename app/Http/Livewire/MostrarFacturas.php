<?php

namespace App\Http\Livewire;

use App\Models\Factura;
use Livewire\Component;

class MostrarFacturas extends Component
{
    public $id_factura,$facturaNota ;
    public function getNota(Factura $factura)
    {
        if ($factura->nota) {
            $this->facturaNota = $factura->nota;
        }else{
            $this->facturaNota = 'Esta factura no tiene ninguna nota.';
        }
        $this->id_factura = $factura->id;
        $this->emit('show-modal', 'details loaded');
    }
    public function render()
    {
        $facturas = Factura::orderBy('id', 'desc')->get();
        return view('livewire.mostrar-facturas', [
            'facturas' => $facturas
        ]);
    }
}
