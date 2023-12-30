<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Factura;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CrearFactura extends Component
{
    public $cliente, $numero_factura, $fecha, $total, $estado, $categoria;
    public $nit, $razon_social;
    protected $rules = [
        'nit' => 'required',
        'razon_social' => 'required|string',
        'numero_factura' => 'required|numeric|max:999999|min:1',
        'fecha' => 'nullable|date',
        'total' => 'nullable|numeric|min:0|max:9999999',
        'estado' => 'required|string|in:Pagado,Por Cobrar,Pago al Contado,Anulado',
        'categoria' => 'required|string|in:Material De Escritorio,Material De Limpieza'
    ];

    public function crearFactura()
    {
        $datos = $this->validate();
        $existe = Cliente::where('nit', $this->nit)->first();
        if ($existe) {
            //El cliente existe
            Factura::create([
                'cliente_id' => $existe->id,
                'numero_factura' => $datos['numero_factura'],
                'fecha' => $datos['fecha'],
                'total' => $datos['total'],
                'estado' => $datos['estado'],
                'categoria' => $datos['categoria'],
            ]);
        } else {
            //El cliente no existe, creamos un nuevo registro en la tabla clientes
            $cliente = Cliente::create([
                'razon_social' => $this->razon_social,
                'nit' => $this->nit
            ]);
            /* Registramos la factura */
            Factura::create([
                'cliente_id' => $cliente->id,
                'numero_factura' => $datos['numero_factura'],
                'fecha' => $datos['fecha'],
                'total' => $datos['total'],
                'estado' => $datos['estado'],
                'categoria' => $datos['categoria'],
            ]);
        }
        //Crear un mensaje
        session()->flash('mensaje', 'La factura se registró correctamente');
        //Redireccionar al usuario
        return redirect()->route('facturas.index');
    }
    public function render()
    {
        $clientes = Cliente::all();
        return view(
            'livewire.crear-factura',
            [
                'clientes' => $clientes
            ]
        );
    }
}
