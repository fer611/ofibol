<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Factura;
use Livewire\Component;

class EditarFactura extends Component
{

    public $cliente,$numero_factura,$fecha,$total,$estado,$categoria,$razon_social;
    /* realizar mount de la factura */
    public $salida= 'hola';
    public function mount(Factura $factura)
    {
        $this->cliente = $factura->cliente_id;
        $this->numero_factura = $factura->numero_factura;
        $this->fecha=$factura->fecha;
        $this->total = $factura->total;
        $this->estado = $factura->estado;
        $this->categoria = $factura->categoria;
        $this->razon_social = $factura->cliente->razon_social;
    }

    protected $rules = [
        'nit' => 'required|min:0',
        'razon_social' => 'required|string',
        'numero_factura' => 'required|numeric|max:999999|min:1',
        'fecha' => 'nullable|date',
        'total' => 'nullable|numeric|min:0|max:9999999',
        'estado' => 'required|string|in:Pagado,Por Cobrar,Pago al Contado,Anulado',
        'categoria' => 'required|string|in:Material De Escritorio,Material De Limpieza',
        'nota' => 'nullable|string|max:255'
    ];

    public function editarFactura(){
        $this->salida = $this->cliente;
    }
    public function render()
    {
        $clientes = Cliente::all();
        return view('livewire.editar-factura',[
            'clientes' => $clientes
        ]);
    }
}
