<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MostrarProducto extends Component
{
    public $producto;
    public $stocks;
    public $origen;
    public $destino;
    public $cantidad;

    protected $rules = [
        'origen' => 'required|exists:almacenes,id',
        'destino' => 'required|exists:almacenes,id',
        'cantidad' => 'required|numeric|min:0',
    ];

    public function mount($producto)
    {
        $this->producto = $producto;
        $this->stocks = DB::select("SELECT a.nombre, SUM(entradas) - SUM(salidas) AS stock 
                           FROM kardex k 
                           INNER JOIN almacenes a ON k.almacen_id = a.id 
                           WHERE k.producto_id = ? 
                           GROUP BY a.id", [$producto->id]);
    }

    public function realizarTraspaso()
    {
       dd('relizando traspaso....');
        
    }

    public function render()
    {
        $almacenes = Almacen::all();
        return view('livewire.mostrar-producto', [
            'almacenes' => $almacenes
        ]);
    }
}
