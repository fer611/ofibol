<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Factura;
use Livewire\Component;

class CrearFactura extends Component
{
    public $cliente, $numero_factura, $fecha, $total, $estado, $categoria;
    public $nit, $razon_social;
    public $nota;

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

    public function mount()
    {
        $this->categoria = "Material De Escritorio";
        $this->estado = "Pagado";
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        if ($propertyName === 'nit') {
            $clienteExistente = Cliente::where('nit', $this->nit)->first();

            if ($clienteExistente) {
                $this->razon_social = $clienteExistente->razon_social;
            } else {
                $this->razon_social = ''; // Limpiar el campo si no hay cliente existente
            }
        }
    }

    public function crearFactura()
    {
        $this->validate();

        $existe = Cliente::where('nit', $this->nit)->first();

        if ($existe) {
            // El cliente existe
            Factura::create([
                'cliente_id' => $existe->id,
                'numero_factura' => $this->numero_factura,
                'fecha' => $this->fecha,
                'total' => $this->total,
                'estado' => $this->estado,
                'categoria' => $this->categoria,
                'nota' => $this->nota,
            ]);
        } else {
            // El cliente no existe, creamos un nuevo registro en la tabla clientes
            $cliente = Cliente::create([
                'razon_social' => $this->razon_social,
                'nit' => $this->nit
            ]);

            /* Registramos la factura */
            Factura::create([
                'cliente_id' => $cliente->id,
                'numero_factura' => $this->numero_factura,
                'fecha' => $this->fecha,
                'total' => $this->total,
                'estado' => $this->estado,
                'categoria' => $this->categoria,
                'nota' => $this->nota,
            ]);
        }

        // Crear un mensaje
        session()->flash('mensaje', 'La factura se registró correctamente');

        // Redireccionar al usuario
        /* return redirect()->route('facturas.index'); */
        $this->numero_factura = $this->numero_factura + 1;
        $this->limpiarCampos();
    }

    public function limpiarCampos()
    {
        $this->reset(['nit', 'razon_social', 'fecha', 'total', 'nota']);
    }
    public function render()
    {
        $clientes = Cliente::all();
        return view('livewire.crear-factura', ['clientes' => $clientes]);
    }
}
