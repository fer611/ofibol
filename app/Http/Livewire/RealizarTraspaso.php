<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Kardex;
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

        //Si se está intentando hacer el traspaso al mismo almacén
        if ($this->origen == $this->destino) {
            $this->addError('destino', 'No puedes realizar el traspaso a la misma sucursal');
            return;
        }

        // Llamar al procedimiento almacenado si hay suficiente stock
        $producto_id = $this->producto->id;
        $precio_producto = $this->producto->costo_actual;

        /* ABRIMOS UNA TRANSACCION PARA EL PROCESO DE VENTA */
        // Obtener el último registro de Kardex para el producto en el almacén origen
        // Obtener el último registro de Kardex para el producto
        $kardexOrigen = new Kardex();
        DB::beginTransaction();
        try {
            // Obtener el último registro de Kardex para el producto, esto para obtener el saldo actual del producto
            // y así evitar cálculos innecesarios ya que al ser una transacción el costo del producto no variará
            $ultimoKardex = Kardex::where('producto_id', $this->producto->id)
                ->latest('id') // Ordenar por id de manera descendente
                ->first();     // Obtener el primer registro

            // Actualizar el stock en el almacén origen
            $kardexOrigen->entradas = 0;
            $kardexOrigen->salidas = $this->cantidad;
            $kardexOrigen->producto_id = $producto_id;
            $kardexOrigen->almacen_id = $this->origen;
            $kardexOrigen->precio_producto = $precio_producto;
            /* Aca el saldo se debe mantener */
            $kardexOrigen->saldo = $ultimoKardex->saldo;
            $kardexOrigen->save();

            // Actualizar el stock en el almacén destino
            $kardexDestino = new Kardex();
            $kardexDestino->entradas = $this->cantidad;
            $kardexDestino->salidas = 0;
            $kardexDestino->producto_id = $producto_id;
            $kardexDestino->almacen_id = $this->destino;
            $kardexDestino->precio_producto = $precio_producto;
            $kardexDestino->saldo = $ultimoKardex->saldo;
            $kardexDestino->save();

            // Otras acciones post-traspaso aquí (notificaciones, redirección, etc.)
            //Crear un mensaje
            session()->flash('mensaje', 'El traspaso se realizó correctamente');
            //Redireccionar al usuario
            DB::commit();
            return redirect()->route('productos.show', $producto_id);
        } catch (\Exception $e) {
            /* Haciendo un rollback para mantener la consistencia de datos */
            DB::rollback();
            session()->flash('mensaje', $e->getMessage());
        }
    }

    public function render()
    {
        $this->almacenes = Almacen::all();  // asignar datos a la propiedad del componente
        return view('livewire.realizar-traspaso');  // no necesitas pasar la variable aquí
    }
}
