<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use App\Models\Proveedor;
use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CrearIngreso extends Component
{
    public $buscar = '', $itemsQuantity;
    /* Proveedor */
    public $venta_sin_datos = false, $nombre, $representante;
    public $productos, $producto;
    public $proveedor, $cantidad, $precio_compra;
    public $total = 0.00;

    protected $listeners = [
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale',
    ];
    public function mount()
    {
        $carritoNombre = 'ingresos'; // Nombre del carrito de ingresos
        $this->total = Cart::session($carritoNombre)->getTotal();
        $this->itemsQuantity = Cart::session($carritoNombre)->getTotalQuantity();
    }

    protected $rules = [
        'proveedor' => 'required|exists:proveedores,id',
        'representante' => 'required|string|max:255',
    ];

    public function buscarProducto()
    {
        dd('buscando producto....');
    }

    public function agregarProducto(Producto $producto, $cant = 1)
    {
        $carritoNombre = 'ingresos'; // Nombre del carrito de ingresos
        if ($this->InCart($producto->id, $carritoNombre)) {
            /* En el caso de que el producto ya existe en el carrito */
            $this->increaseQty($producto->id, $carritoNombre);
            return;
        }
        /* Añadiendo el producto al carrito de ingresos */
        Cart::session($carritoNombre)->add($producto->id, $producto->descripcion, $producto->costo_actual == null ? 0.00 : $producto->costo_actual, $cant, $producto->imagen);
    }
    /* Este metodo valida si el producto ya existe en el carrito */
    function InCart($productId, $carritoNombre)
    {
        $existe = Cart::session($carritoNombre)->get($productId);
        return $existe ? true : false;
    }
    public function clearCart()
    {
        $carritoNombre = 'ingresos'; // Nombre del carrito de ingresos

        if (!Cart::session($carritoNombre)->isEmpty()) {
            /* El carrito no está vacío, por lo tanto, lo limpiamos */
            Cart::session($carritoNombre)->clear();
            $this->total = Cart::session($carritoNombre)->getTotal();
            $this->itemsQuantity = Cart::session($carritoNombre)->getTotalQuantity();

            $this->emit('scan-ok', 'Carrito Vacío');
        } else {
            $this->emit('scan-ok', 'Carrito ya está Vacío'); // Puedes ajustar el mensaje según tus necesidades
        }
    }

    public function increaseQty($productId, $carritoNombre, $cant = 1)
    {
        $titulo = '';
        $producto = Producto::find($productId);
        $stock = DB::table('kardex')
            ->where('producto_id', $producto->id)
            ->selectRaw('SUM(entradas) - SUM(salidas) as stock')
            ->groupBy('producto_id')
            ->value('stock');
        /* Si el producto existe actualizamos la cantidad */
        $existe = Cart::session($carritoNombre)->get($productId);

        if ($existe) {
            $titulo = 'Cantidad Actualizado';
        } else {
            $titulo = 'Producto Agregado';
        }

        if ($existe) {
            /* Validamos nuevamente el stock ya existente y más lo que nos envían */
            if ($stock < ($cant + $existe->quantity)) {
                $this->emit('no-stock', 'Stock insuficiente :/');
                //Crear un mensaje
                return;
            }
        }
        /* Actualiza la información en caso de que el producto ya exista en el carrito, en caso de que no exista lo inserta */
        Cart::session($carritoNombre)->add($producto->id, $producto->descripcion, $producto->costo_actual == null ? 0.00 : $producto->costo_actual, $cant, $producto->imagen);

        $this->total = Cart::session($carritoNombre)->getTotal();
        $this->itemsQuantity = Cart::session($carritoNombre)->getTotalQuantity();

        $this->emit('scan-ok', $titulo);
    }

    public function guardarIngreso()
    {

        $datos = $this->validate();
        dd($datos);
        $carritoNombre = 'ingresos'; // Nombre del carrito de ingresos

        $carrito = Cart::session($carritoNombre)->getContent();
        // Procesar los elementos del carrito y registrar el ingreso aquí

        dd('Registrando el ingreso....');
    }

    public function eliminarProducto($index)
    {
        $carritoNombre = 'ingresos'; // Nombre del carrito de ingresos

        $item = Cart::session($carritoNombre)->get($index);

        if ($item) {
            Cart::session($carritoNombre)->remove($index);
        }

        $this->total = Cart::session($carritoNombre)->getTotal();
        $this->itemsQuantity = Cart::session($carritoNombre)->getTotalQuantity();

        dd('Eliminando....');
    }

    private function resetCampos()
    {
        // Aquí puedes restablecer campos si es necesario.
    }

    public function render()
    {
        if (empty($this->buscar)) {
            $this->productos = Producto::where('descripcion', $this->buscar)->get();
        } else {
            $this->productos = Producto::where('descripcion', 'like', '%' . $this->buscar . '%')->get();
        }
        /* Aca solo recolectamos a los proveedores activos */
        $proveedores = Proveedor::where('estado', '1')->get();
        $carritoNombre = 'ingresos'; // Nombre del carrito de ingresos
        $carrito = Cart::session($carritoNombre)->getContent()->sortBy('barcode');
        /* Aca lo mismo, solo productos activos */
        return view('livewire.ingresos.crear-ingreso', [
            'proveedores' => $proveedores,
            'carrito' => $carrito
        ]);
    }
     /* Venta sin datos */
     public function updatedVentaSinDatos()
     {
        $proveedor = Proveedor::where('nombre', 'S/N')->first();
         if ($this->venta_sin_datos) {
            $this->proveedor = $proveedor->id;
         } else {
            $this->proveedor = "";
         }
     }
}
