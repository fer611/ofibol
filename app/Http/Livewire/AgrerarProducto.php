<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AgrerarProducto extends Component
{
    public $producto;
    public $cantidad;
    public $precioCompra;
    public $precioVenta;
    public $detalles = [];

    public function agregarProducto()
    {
        // Validaciones, por ejemplo, para asegurarse de que la cantidad sea mayor que cero

        $detalle = [
            'producto' => $this->producto,
            'cantidad' => $this->cantidad,
            'precioCompra' => $this->precioCompra,
            'precioVenta' => $this->precioVenta,
            // Otras propiedades necesarias
        ];

        array_push($this->detalles, $detalle);

        // Limpiar los campos después de agregar un producto
        $this->reset(['producto', 'cantidad', 'precioCompra', 'precioVenta']);
    }

    public function eliminarProducto($index)
    {
        unset($this->detalles[$index]);
        $this->detalles = array_values($this->detalles); // Reindexar el array
    }
    
    public function render()
    {
        return view('livewire.agrerar-producto');
    }
}
