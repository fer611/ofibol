<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RealizarTraspaso extends Component
{

    public $origen;
    public $destino;
    public $cantidad;
    public $producto;  // Agregamos propiedad para el ID del producto
    public $almacenes;

    protected $rules = [
        'origen' => 'required|exists:almacenes,id',
        'destino' => 'required|exists:almacenes,id',
        'cantidad' => 'required|numeric|min:0',
    ];
    public function mount(Producto $producto)
    {
        $this->producto = $producto; // asignar ID del producto a la propiedad
        $this->almacenes = Almacen::all();  // asignar datos a la propiedad del componente
    }

    public function realizarTraspaso()
    {
        // Validación
        $this->validate();

        // Calcular el stock actual en el almacén origen basado en el Kardex
        $entradas = DB::table('kardex')
            ->where('producto_id', $this->producto->id)
            ->where('almacen_id', $this->origen)
            ->sum('entradas');

        $salidas = DB::table('kardex')
            ->where('producto_id', $this->producto->id)
            ->where('almacen_id', $this->origen)
            ->sum('salidas');

        $stockActual = $entradas - $salidas;

        // Verificar stock
        if ($stockActual < $this->cantidad) {
            // Acciones si no hay suficiente stock (mostrar alerta, etc.)
            $this->addError('cantidad', 'No hay suficiente stock en la sucursal de origen.');
            return;
        }

        // Llamar al procedimiento almacenado si hay suficiente stock
        $producto_id = $this->producto->id;
        $precio_producto = $this->producto->costo_actual;
        DB::statement("CALL traspaso(?, ?, ?, ?, ?)", [$producto_id, $this->origen, $this->destino, $this->cantidad, $precio_producto]);

        // Otras acciones post-traspaso aquí (notificaciones, redirección, etc.)
        //Crear un mensaje
        session()->flash('mensaje', 'El traspasó se realizó correctamente');
        //Redireccionar al usuario
        return redirect()->route('productos.show', $producto_id);
    }

    public function render()
    {
        $this->almacenes = Almacen::all();  // asignar datos a la propiedad del componente
        return view('livewire.realizar-traspaso');  // no necesitas pasar la variable aquí
    }
}
