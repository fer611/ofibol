<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\DetalleIngreso;
use App\Models\Ingreso;
use App\Models\Kardex;
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
    public $proveedor, $almacen, $cantidad, $precio_compra;
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
        'almacen' => 'required|exists:almacenes,id'
    ];

    public function buscarProducto()
    {
        dd('buscando producto....');
    }

    public function agregarProducto($id = null, $cant = 1)
    {
        $carritoNombre = 'ingresos'; // Nombre del carrito de ingresos

        /* Para agregar un producto al carrito existen dos casos, 1 cuando se manda como parametro
        $id desde el boton agregar del filtrado de productos
        y 2. cuando se manda directamente un codigo de barras (lector optico) */
        /* Para empezar, si $id es null eso quiere decir que se ingresaron datos
        por el input de busqueda (Lector de barcode), entonces */

        if ($id == null) {
            /* Buscamos por el codigo de barras */
            /* Importante: Aquí usamos $this->buscar por que es el wire:model del campo de entrada,
        es decir que no necesitamos pedirlo como parametro,sino usarlo directamente */
            $producto = Producto::where('barcode', $this->buscar)->first();
            if ($producto == null || empty($producto)) {
                $this->emit('scan-notfound', 'El producto no esta registrado');
                return;
            }
        } else {
            /* Si se manda un dato por el boton de agregar, entonces buscamos el producto
            por el dato que se envia, en este caso id */
            $producto = Producto::find($id);
            if ($producto == null || empty($producto)) {
                $this->emit('scan-notfound', 'El producto no esta registrado');
                return;
            }
        }
        if ($this->InCart($producto->id, $carritoNombre)) {
            /* En el caso de que el producto ya existe en el carrito */
            $this->increaseQty($producto->id);
            return;
        }

        /* Añadiendo el producto al carrito de ingresos */
        Cart::session($carritoNombre)->add($producto->id, $producto->descripcion, $producto->costo_actual == null ? 0.00 : $producto->costo_actual, $cant, $producto->imagen);

        /* Actualizando el total */
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        /* Finalmente emitimos el evento */
        $this->emit('scan-ok', 'Producto Agregado');
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

    public function increaseQty($productId, $cant = 1)
    {
        $titulo = '';
        $producto = Producto::find($productId);
        /* Si el producto existe, actualizamos la cantidad */
        $existe = Cart::session('ingresos')->get($productId);
        if ($existe) {
            $titulo = 'Cantidad Actualizada';
        } else {
            $titulo = 'Producto Agregado';
        }
        /* Actualiza la información en caso de que el producto ya exista en el carrito, en caso de que no exista lo inserta */
        Cart::session('ingresos')->add($producto->id, $producto->descripcion, $producto->costo_actual == null ? 0.00 : $producto->costo_actual, $cant, $producto->imagen);

        $this->total = Cart::session('ingresos')->getTotal();
        $this->itemsQuantity = Cart::session('ingresos')->getTotalQuantity();

        /* Limpiamos el input */
        $this->buscar = '';

        $this->emit('scan-ok', $titulo);
    }

    public function decreaseQty($productId)
    {
        // Recuperamos el producto del carrito 'ingresos'
        $item = Cart::session('ingresos')->get($productId);

        // Verificamos si el producto existe en el carrito 'ingresos'
        if ($item) {
            // Eliminamos el producto del carrito 'ingresos'
            Cart::session('ingresos')->remove($productId);

            // Reducimos la cantidad del producto en el carrito
            $newQty = ($item->quantity) - 1;
            if ($newQty > 0) {
                // Agregamos el producto con la cantidad actualizada al carrito 'ingresos'
                Cart::session('ingresos')->add($item->id, $item->name, $item->price, $newQty, $item->attributes[0]);
            }

            // Actualizamos las propiedades
            $this->total = Cart::session('ingresos')->getTotal();
            $this->itemsQuantity = Cart::session('ingresos')->getTotalQuantity();

            $this->emit('scan-ok', 'Cantidad Actualizada');
        }
    }


    public function updateQty($productId, $cant = 1)
    {
        $titulo = '';
        $producto = Producto::find($productId);

        // Verificamos si el producto existe en el carrito 'ingresos'
        $existe = Cart::session('ingresos')->get($productId);

        /* Si el producto existe actualizamos la cantidad */
        if ($existe) {
            $titulo = 'Cantidad Actualizado';
        } else {
            $titulo = 'Producto Agregado';
        }
        $this->removeItem($producto->id);
        if ($cant > 0) {

            // Agregamos el producto actualizado al carrito 'ingresos'
            Cart::session('ingresos')->add($producto->id, $producto->descripcion, $producto->costo_actual, $cant, $producto->imagen);

            // Actualizamos las propiedades
            $this->total = Cart::session('ingresos')->getTotal();
            $this->itemsQuantity = Cart::session('ingresos')->getTotalQuantity();

            $this->emit('scan-ok', $titulo);
        } else {
            // Notificamos al usuario que la cantidad debe ser mayor a 0
            // Crear un mensaje
            $this->emit('no-stock', 'La cantidad debe ser mayor a 0');
        }
    }

    public function removeItem($productId)
    {
        // Eliminamos el producto del carrito 'ingresos'
        Cart::session('ingresos')->remove($productId);

        // Actualizamos las propiedades
        $this->total = Cart::session('ingresos')->getTotal();
        $this->itemsQuantity = Cart::session('ingresos')->getTotalQuantity();

        $this->emit('scan-ok', 'Producto eliminado');
        // Puedes crear un mensaje si lo deseas
    }


    public function guardarIngreso()
    {
        $datos = $this->validate();


        $carritoNombre = 'ingresos'; // Nombre del carrito de ingresos

        /* ABRIMOS UNA TRANSACCION PARA EL PROCESO DE INGRESO */
        DB::beginTransaction();

        //obteniendo al proveedor
        $proveedor = Proveedor::find($datos['proveedor']);

        try {
            $ingreso = Ingreso::create([
                'total' => $this->total,
                'items' => $this->itemsQuantity,
                'user_id' => auth()->user()->id,
                'proveedor_id' => $proveedor->id,
                'almacen_id' => $datos['almacen'],
            ]);
            if ($ingreso) {
                /* Aca obtenemos el carrito especificamente de ingresos */
                $items = Cart::session('ingresos')->getContent();

                foreach ($items as $item) {
                    /* guardando los detalles */
                    DetalleIngreso::create([
                        'ingreso_id' => $ingreso->id,
                        'producto_id' => $item->id,
                        'cantidad' => $item->quantity,
                        'precio_compra' => $item->price,
                    ]);
                    /* aca registramos una entrada de cada producto */
                    Kardex::create([
                        'producto_id' => $item->id,
                        'entradas' => $item->quantity,
                        'salidas' => 0,
                        'almacen_id' => $datos['almacen'],
                        'precio_producto' => $item->price,
                        'user_id' => auth()->user()->id,
                    ]);

                    $producto = Producto::find($item->id);

                    // Obtener todos los registros del kardex relacionados con este producto
                    $kardexRegistros = Kardex::where('producto_id', $producto->id)->get();

                    // Calcular el costo total sumando todos los costos en el kardex
                    $costoTotalInventario = $kardexRegistros->sum('costo');

                    // Obtener la cantidad total de unidades en el inventario
                    $cantidadTotalInventario = $producto->stock; // Supongo que 'stock' es la cantidad actual en el inventario

                    // Calcular el nuevo costo promedio ponderado (CPP)
                    if ($cantidadTotalInventario > 0) {
                        $nuevoCPP = $costoTotalInventario / $cantidadTotalInventario;
                    } else {
                        // Si la cantidad total es cero, el nuevo CPP también será cero para evitar divisiones por cero.
                        $nuevoCPP = 0;
                    }
                    // Actualizar el campo costo_actual del producto con el nuevo valor calculado del CPP
                    $producto->costo_actual = $nuevoCPP;
                    $producto->save();
                }
            }

            DB::commit();

            /* limpiamos el caarrito */
            Cart::session('ingresos')->clear();

            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            /* $this->emit('sale-ok', 'Venta registrada con éxito'); */
            //Crear un mensaje
            session()->flash('mensaje', 'Venta registrada con éxito');
            //Redireccionar al usuario
            return redirect()->route('ingresos.index');
            /* Evento para imprimir el ticket */
            /*  $this->emit('print-ticket', $venta->id); */

            /* Redirigimos al usuario con un mensaje de exito */
        } catch (Exception $e) {
            /* Haciendo un rollback para mantener la consistencia de datos */
            DB::rollback();
            $this->emit('venta-error', $e->getMessage());
        }
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
        $almacenes = Almacen::all();
        $carritoNombre = 'ingresos'; // Nombre del carrito de ingresos
        $carrito = Cart::session($carritoNombre)->getContent()->sortBy('barcode');
        /* Aca lo mismo, solo productos activos */
        return view('livewire.ingresos.crear-ingreso', [
            'proveedores' => $proveedores,
            'carrito' => $carrito,
            'almacenes' => $almacenes
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
