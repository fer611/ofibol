<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Denominacion;
use App\Models\DetalleVenta;
use App\Models\Kardex;
use App\Models\Producto;
use App\Models\Venta;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Ventas extends Component
{
    public $total, $itemsQuantity, $efectivo, $cambio, $razon_social, $nit, $venta_sin_datos = false, $nitIsValid = true;

    public function mount()
    {
        $this->efectivo = 0;
        $this->cambio = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }
    public function render()
    {
        $carrito = Cart::getContent()->sortBy('barcode');
        return view('livewire.ventas.componente', [
            'carrito' => $carrito,
        ]);
    }

    /* Este metodo agrega en todo momento el efectivo */
    public function ACash($valor)
    {
        /* sumando el efectivo, si el usuario presiona en el boton exacto el valor se vuelve 0 */
        $this->efectivo += ($valor == 0 ? $this->total : $valor);
        /* el cambio que se la al cliente */
        $this->cambio = ($this->efectivo  - $this->total);
    }

    protected $listeners = [
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale',
    ];

    function ScanCode($barcode, $cant = 1)
    {
        /* Buscando el producto */
        $producto = Producto::where('barcode', $barcode)->first();

        if ($producto == null || empty($producto)) {
            $this->emit('scan-notfound', 'El producto no esta registrado');
            //Crear un mensaje
            /* session()->flash('mensaje', 'El producto no esta registrado'); */
        } else {
            if ($this->InCart($producto->id)) {
                /* En el caso de que el producto ya existe en el carrito */
                $this->increaseQty($producto->id);
                return;
            }
            /* Obteniendo el stock del producto */
            $stock = DB::table('kardex')
                ->where('producto_id', $producto->id)
                ->selectRaw('SUM(entradas) - SUM(salidas) as stock')
                ->groupBy('producto_id')
                ->value('stock');
            /* validar si las existencias del producto son suficientes,por el momento lo ponemos en stock minimo(calcular entradas - salidas)  */
            if ($stock < 1) {
                $this->emit('no-stock', 'Stock insuficiente :/');
                //Crear un mensaje
                return;
            }
            /* Aca validamos si el producto esta activo */
            if ($producto->estado == '0') {
                $this->emit('no-stock', 'El producto esta Inactivo');
                return;
            }
            if ($producto->precio_venta == null || $producto->costo_actual == null) {
                $this->emit('no-stock', 'El producto no tiene precio de venta o costo');
            }
            /* Añadiendo el producto al carrito */

            Cart::add($producto->id, $producto->descripcion, $producto->precio_venta, $cant, $producto->imagen);

            /* Actualizando el total */
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            /* Finalmente emitimos el evento */
            $this->emit('scan-ok', 'Producto Agregado');
        }
    }

    /* Este metodo valida si el producto ya existe en el carrito */
    function InCart($productId)
    {
        $existe = Cart::get($productId);
        if ($existe) {
            return true;
        } else {
            return false;
        }
    }

    public function increaseQty($productId, $cant = 1)
    {
        $titulo = '';
        $producto = Producto::find($productId);
        $stock = DB::table('kardex')
            ->where('producto_id', $producto->id)
            ->selectRaw('SUM(entradas) - SUM(salidas) as stock')
            ->groupBy('producto_id')
            ->value('stock');
        /* Si el producto existe actualizamos la cantidad */
        $existe = Cart::get($productId);

        if ($existe) {
            $titulo = 'Cantidad Actualizado';
        } else {
            $titulo = 'Producto Agregado';
        }

        if ($existe) {
            /* Validamos nuevamente el stock ya existente y mas lo que nos envian */
            if ($stock < ($cant + $existe->quantity)) {
                $this->emit('no-stock', 'Stock insuficiente :/');
                //Crear un mensaje
                return;
            }
        }

        /* Actualiza la informacion en caso de que el producto ya exista en el carrito, en caso de que no exista lo inserta */
        Cart::add($producto->id, $producto->descripcion, $producto->precio_venta, $cant, $producto->imagen);

        $this->total  = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', $titulo);
    }

    public function updateQty($productId, $cant = 1)
    {
        $titulo = '';
        $producto = Producto::find($productId);
        /* aca volvemos a obtener el stock */
        $stock = DB::table('kardex')
            ->where('producto_id', $producto->id)
            ->selectRaw('SUM(entradas) - SUM(salidas) as stock')
            ->groupBy('producto_id')
            ->value('stock');
        $existe = Cart::get($productId);
        /* Si el producto existe actualizamos la cantidad */
        if ($existe) {
            $titulo = 'Cantidad Actualizado';
        } else {
            $titulo = 'Producto Agregado';
        }

        if ($existe) {
            /* verificamos el stock nuevamente */
            if ($stock < $cant) {
                $this->emit('no-stock', 'Stock insuficiente :/');
                //Crear un mensaje
                return;
            }
        }

        $this->removeItem($producto->id);
        if ($cant > 0) {
            Cart::add($producto->id, $producto->descripcion, $producto->precio_venta, $cant, $producto->imagen);

            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('scan-ok', $titulo);
        } else {
            /* Aca podemos notificar al usuario que la cantidad debe ser mayor a 0 */
            //Crear un mensaje
            $this->emit('no-stock', 'La cantidad debe ser mayor a 0');
        }
    }

    public function removeItem($productId)
    {
        /* eliminamos el producto del carrito */
        Cart::remove($productId);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Producto eliminado');
        //Crear un mensaje
    }

    public function decreaseQty($productId)
    {
        /* Recuperamos el producto */
        $item = Cart::get($productId);
        /* Eliminamos el producto del carrito */
        Cart::remove($productId);

        /* Aca reducimos la cantidad del producto en el carrito */
        $newQty = ($item->quantity) - 1;
        if ($newQty > 0) {
            Cart::add($item->id, $item->name, $item->price, $newQty, $item->attributes[0]);
        }

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Cantidad Actualizada');
    }

    function clearCart()
    {
        /* Limpiamos el carrito */
        Cart::clear();

        $this->efectivo = 0;
        $this->cambio = 0;

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        //Crear un mensaje
        /*  session()->flash('mensaje', 'Carrito Vacío'); */
        $this->emit('scan-ok', 'Carrito Vacío');
    }

    public function guardarVenta()
    {
        /* dd($this->total.'|'.$this->efectivo.'|'.$this->itemsQuantity.'|'.$this->cambio.'|'.auth()->user()->id); */

        /* Validando que se ingrese un nit que existe en el campo de clientes */
        $clienteExiste = Cliente::where('nit', $this->nit)->first();
        if (!$clienteExiste && !$this->venta_sin_datos) {
            $this->addError('nit', 'El cliente no está registrado');
            $this->addError('razon_social', 'El cliente no está registrado');
            return;
        }
        /* Si es una venta sin datos, buscamos al cliente con S/N */
        if ($this->venta_sin_datos) {
            $clienteExiste = Cliente::where('nit', 'S/N')->first();
            /* Si es que no encuentra algun registro con S/N */
            if ($clienteExiste == null) {
                /* Si no existe el cliente con S/N lo creamos */
                $cliente = Cliente::create([
                    'nit' => 'S/N',
                    'razon_social' => 'S/N',
                ]);
                /* Obtenemos el cliente creado */
                $clienteExiste = Cliente::where('nit', 'S/N')->first();
            }
        }


        if ($this->total <= 0) {
            /* $this->emit('sale-error', 'AGREGA PRODUCTOS A LA VENTA'); */
            session()->flash('mensaje', 'AGREGA PRODUCTOS A LA VENTA');
            return;
        }
        if ($this->efectivo <= 0) {
            /* $this->emit('sale-error', 'INGRESA EL EFECTIVO'); */
            session()->flash('mensaje', 'INGRESA EL EFECTIVO');
            return;
        }

        /* El total que estamos intentando pagar es mayor a lo que el cliente nos entrega */
        if ($this->total > $this->efectivo) {
            /* $this->emit('sale-error', 'EL EFECTIVO DEBE SER MAYOR O IGUAL AL TOTAL'); */
            //Crear un mensaje
            session()->flash('mensaje', 'EL EFECTIVO DEBE SER MAYOR O IGUAL AL TOTAL');
            return;
        }

        /* ABRIMOS UNA TRANSACCION PARA EL PROCESO DE VENTA */
        DB::beginTransaction();

        //obteniendo al cliente
        $cliente = Cliente::where('nit', $this->nit)->first();

        try {
            $venta = Venta::create([
                'total' => $this->total,
                'items' => $this->itemsQuantity,
                'cash' => $this->efectivo,
                'cambio' => $this->cambio,
                'user_id' => auth()->user()->id,
                'cliente_id' => $cliente->id,
            ]);
            if ($venta) {
                $items = Cart::getContent();
                foreach ($items as $item) {
                    /* guardando los detalles */
                    DetalleVenta::create([
                        'precio' => $item->price,
                        'cantidad' => $item->quantity,
                        'producto_id' => $item->id,
                        'venta_id' => $venta->id
                    ]);


                    /* Actualizando el stock */
                    /* aca podemos registrar una salida de este producto */
                    /* Para el CPP obtenemos el producto y sacamos su costo actual para una venta el CPP debe mantener el costo */
                    $producto = Producto::find($item->id);

                    /* Obtenemos el stock para calcular el saldo */
                    $stock = DB::table('kardex')
                        ->where('producto_id', $producto->id)
                        ->selectRaw('SUM(entradas) - SUM(salidas) as stock')
                        ->groupBy('producto_id')
                        ->value('stock');
                    /* Aca registramos la salida */
                    Kardex::create([
                        'producto_id' => $item->id,
                        'entradas' => 0,
                        'salidas' => $item->quantity,
                        /* Aca por defecto la salida debe ser del almacen punto de venta Ofibol*/
                        'almacen_id' => 3,
                        'precio_producto' => $producto->costo_actual,
                        'saldo' => $producto->costo_actual * ($stock - $item->quantity),
                        'user_id' => auth()->user()->id,
                    ]);
                    /* 
                    $producto = Producto::find($item->id);
                    $producto->save(); */
                }
            }

            DB::commit();
            /* limpiamos el caarrito */
            Cart::clear();
            $this->efectivo = 0;
            $this->cambio = 0;

            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            /* $this->emit('sale-ok', 'Venta registrada con éxito'); */
            //Crear un mensaje
            session()->flash('mensaje', 'Venta registrada con éxito');
            //Redireccionar al usuario
            return redirect()->route('ventas.index');
            /* Evento para imprimir el ticket */
            /*  $this->emit('print-ticket', $venta->id); */

            /* Redirigimos al usuario con un mensaje de exito */
        } catch (Exception $e) {
            /* Haciendo un rollback para mantener la consistencia de datos */
            DB::rollback();
            $this->emit('venta-error', $e->getMessage());
        }
    }

    public function buscarCliente()
    {
        /* Aca buscamos por nit */
        $cliente = Cliente::where('nit', $this->nit)->first();
        if ($cliente) {
            /* Cliente encontrado, llenamos el campo de razon social */
            $this->razon_social = $cliente->razon_social;
            $this->nitIsValid = true; // Agregamos una propiedad para indicar que el campo es válido
        } else {
            session()->flash('mensaje', 'El cliente no esta registrado');
        }
    }


    public function exacto()
    {
        $this->efectivo = $this->total;
        $this->cambio = 0;
    }

    // update change when keyboard typing
    public function updatedEfectivo($value)
    {
        $efectivoZero = ($value === '' ? 0 : $value);
        $this->cambio = ($efectivoZero - $this->total);
    }

    function printTicket($venta)
    {
        /* La aplicacion en C# lo detecta.... */
        return Redirect::to("print://$venta->id");
    }

    /* Esta funcion elimina le input de efectivo ponienod el efectivo en 0 y tambien el cambio */

    public function limpiarEntrada()
    {
        $this->efectivo = 0;
        $this->cambio = 0;
    }


    /* Venta sin datos */
    public function updatedVentaSinDatos()
    {
        if ($this->venta_sin_datos) {
            $this->nit = 'S/N';
            $this->razon_social = 'S/N';
        } else {
            $this->nit = '';
            $this->razon_social = '';
        }
    }
}
