<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MostrarProducto extends Component
{
    public $producto;
    public $stocks;
    public function mount($producto)
    {
        $this->producto = $producto;
        $this->stocks = DB::select("SELECT a.nombre, SUM(entradas) - SUM(salidas) AS stock 
                           FROM kardex k 
                           INNER JOIN almacenes a ON k.almacen_id = a.id 
                           WHERE k.producto_id = ? 
                           GROUP BY a.id", [$producto->id]);
    }


   
    public function render()
    {
        return view('livewire.mostrar-producto');
    }
}
