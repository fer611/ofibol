<?php

namespace App\Http\Livewire;

use App\Models\Denominacion;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Ventas extends Component
{
    public $total, $itemsQuantity, $efectivo, $cambio;

    public function mount()
    {
        $this->efectivo = 0;
        $this->cambio = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }
    public function render()
    {
        $denominaciones = Denominacion::orderBy('valor', 'desc')->get();
        $carrito = Cart::getContent()->sortBy('barcode');
        return view('livewire.ventas.componente', [
            'denominaciones' => $denominaciones,
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
        } else {
            if ($this->InCart($producto->id)) {
                /* En el caso de que el producto ya existe en el carrito */
                $this->increaseQty($producto->id);
                return;
            }
            /* validar si las existencias del producto son suficientes,por el momento lo ponemos en stock minimo(calcular entradas - salidas)  */
            if ($producto->stock_minimo < 1) {
                $this->emit('no-stock', 'Stock insuficiente :/');
                return;
            }
            /* Añadiendo el producto al carrito */
            Cart::add($producto->id, $producto->descripcion, $producto->precio_venta, $cant, $producto->imagen);

            /* Actualizando el total */
            $this->total = Cart::getTotal();

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

        /* Si el producto existe actualizamos la cantidad */
        $existe = Cart::get($productId);
        
        if ($existe) {
            $titulo = 'Cantidad Actualizado';
        } else {
            $titulo = 'Producto Agregado';
        }

        if ($existe) {
            /* Validamos nuevamente el stock ya existente y mas lo que nos envian */
            if ($producto->stock_minimo < ($cant + $existe->quantity)) {
                $this->emit('no-stock', 'Stock insuficiente :/');
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
        $existe = Cart::get($productId);
        /* Si el producto existe actualizamos la cantidad */
        if ($existe) {
            $titulo = 'Cantidad Actualizado';
        } else {
            $titulo = 'Producto Agregado';
        }

        if ($existe) {
            /* verificamos el stock nuevamente */
            if ($producto->stock_minimo < $cant) {
                $this->emit('no-stock', 'Stock insuficiente :/');
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
        }
    }

    public function removeItem($productId)
    {
        /* eliminamos el producto del carrito */
        Cart::remove($productId);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Producto eliminado');
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

        $this->emit('scan-ok', 'Carrito Vacío');
    }

    public function guardarVenta()
    {
        /* dd($this->total.'|'.$this->efectivo.'|'.$this->itemsQuantity.'|'.$this->cambio.'|'.auth()->user()->id); */

        if ($this->total <= 0) {
            $this->emit('sale-error', 'AGREGA PRODUCTOS A LA VENTA');
            return;
        }
        if ($this->efectivo <= 0) {
            $this->emit('sale-error', 'INGRESA EL EFECTIVO');
            return;
        }

        /* El total que estamos intentando pagar es mayor a lo que el cliente nos entrega */
        if ($this->total > $this->efectivo) {
            $this->emit('sale-error', 'EL EFECTIVO DEBE SER MAYOR O IGUAL AL TOTAL');
            return;
        }

        /* ABRIMOS UNA TRANSACCION PARA EL PROCESO DE VENTA */
        DB::beginTransaction();

        try {
            $venta = Venta::create([
                'total' => $this->total,
                'items' => $this->itemsQuantity,
                'cash' => $this->efectivo,
                'cambio' => $this->cambio,
                'user_id' => auth()->user()->id,
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
                    $producto = Producto::find($item->id);
                    $producto->stock_minimo = $producto->stock_minimo - $item->quantity;
                    $producto->save();
                }
            }

            DB::commit();
            /* limpiamos el caarrito */
            Cart::clear();
            $this->efectivo = 0;
            $this->cambio = 0;

            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('sale-ok', 'Venta registrada con éxito');

            /* Evento para imprimir el ticket */
           /*  $this->emit('print-ticket', $venta->id); */

           /* Redirigimos al usuario con un mensaje de exito */
        } catch (Exception $e) {
            /* Haciendo un rollback para mantener la consistencia de datos */
            DB::rollback();
            $this->emit('venta-error', $e->getMessage());
        }
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
}
