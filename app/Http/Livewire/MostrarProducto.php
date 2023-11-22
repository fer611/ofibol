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
        $stock_total = DB::table('kardex')
            ->where('producto_id', $this->producto->id)
            ->selectRaw('SUM(entradas) - SUM(salidas) as stock')
            ->groupBy('producto_id')
            ->value('stock');
        return view('livewire.mostrar-producto',[
            'stock_total' => $stock_total
        ]);
    }
}
