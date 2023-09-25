<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MostrarProductos extends Component
{
    protected $listeners = ['prueba'];

    public function prueba()
    {
        logger('Desde prueba...');
    }
    public function render()
    {
        // Obtener todos los productos
        $productos = Producto::all();

        // Ejecutar la consulta SQL para obtener el stock de cada producto
        $stocks = DB::select("SELECT producto_id, sum(entradas) - sum(salidas) as stock FROM kardex GROUP BY producto_id");

        // Inicializar un array para mapear los IDs de los productos a su stock
        $stockMap = [];

        // Llenar el array con los datos de stock
        foreach ($stocks as $stock) {
            $stockMap[$stock->producto_id] = $stock->stock;
        }

        // Asignar el stock a cada producto en la colección $productos
        foreach ($productos as $producto) {
            // Usar el stock del mapa si está disponible, de lo contrario usar 0
            $producto->stock = $stockMap[$producto->id] ?? 0;
        }
        return view('livewire.mostrar-productos', [
            'productos' => $productos,
        ]);
    }
}
