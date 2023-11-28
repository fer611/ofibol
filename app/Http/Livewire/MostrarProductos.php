<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MostrarProductos extends Component
{
    protected $listeners = ['activarProducto', 'inactivarProducto'];
    /* Atributos para mostrar el stock en cada sucursal */

    public $productoStock;
    public $stocks;

    public function mount(){
        /* Para el modal de stocks */
        $this->stocks = [];
        $this->productoStock = null;
    }
    public function activarProducto(Producto $producto)
    {
        // Cambia el estado del producto a activo (1)
        $producto->estado = '1';
        $producto->save();
    }
    public function inactivarProducto(Producto $producto)
    {
        // Cambia el estado del producto a inactivo (0)
        $producto->estado = '0';
        $producto->save();
    }
    public function getStock(Producto $producto)
    {
        $this->productoStock = $producto;
        $this->stocks = DB::select("SELECT a.nombre, SUM(entradas) - SUM(salidas) AS stock 
                           FROM kardex k 
                           INNER JOIN almacenes a ON k.almacen_id = a.id 
                           WHERE k.producto_id = ? 
                           GROUP BY a.id", [$producto->id]);
        $this->emit('show-modal', 'details loaded');
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
