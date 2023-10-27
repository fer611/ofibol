<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\Component;

class BuscarProducto extends Component
{
    public $buscar = '';
    public $productos, $producto;

    public function buscarProducto()
    {
        dd('buscando producto....');
    }
    public function render()
    {
        if (empty($this->buscar)) {
            $this->productos = Producto::where('descripcion',$this->buscar)->get();
        }else{
            $this->productos = Producto::where('descripcion', 'like', '%' . $this->buscar . '%')->get();
        }
        return view('livewire.buscar-producto');
    }
}
