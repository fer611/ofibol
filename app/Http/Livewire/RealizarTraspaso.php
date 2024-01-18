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
        $costo_producto = $this->producto->costo_actual;

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
            $kardexOrigen->detalle = 'Traspaso de almacen';
            $kardexOrigen->saldo_stock = $this->obtenerStock($producto_id)-$this->cantidad;
            $kardexOrigen->costo_producto = $costo_producto;
            $kardexOrigen->debe = 0;
            $kardexOrigen->haber =$costo_producto*$this->cantidad;
            $kardexOrigen->saldo_valorado = $ultimoKardex->saldo_valorado-($costo_producto*$this->cantidad);
            
            $kardexOrigen->save();

            // Actualizar el stock en el almacén destino
            $kardexDestino = new Kardex();
            $kardexDestino->entradas = $this->cantidad;
            $kardexDestino->salidas = 0;
            $kardexDestino->producto_id = $producto_id;
            $kardexDestino->almacen_id = $this->destino;
            $kardexDestino->detalle = 'Traspaso de almacen';
            $kardexDestino->saldo_stock = $this->obtenerStock($producto_id)+$this->cantidad;
            $kardexDestino->costo_producto = $costo_producto;
            $kardexDestino->debe = $costo_producto*$this->cantidad;
            $kardexDestino->haber =0;
            $kardexDestino->saldo_valorado = $ultimoKardex->saldo_valorado;
            
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

    /**
     * @return double el stock total del producto
     * @param string $id El id del producto
     */
    public function obtenerStock(string $id)
    {
        $stock = DB::table('kardex')
            ->where('producto_id', $id)
            ->selectRaw('SUM(entradas) - SUM(salidas) as stock')
            ->groupBy('producto_id')
            ->value('stock');
        return $stock ? $stock : 'No tiene stock';
    }
    public function render()
    {
        $this->almacenes = Almacen::all();  // asignar datos a la propiedad del componente
        return view('livewire.realizar-traspaso');  // no necesitas pasar la variable aquí
    }
}
