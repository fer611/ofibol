<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use App\Models\Proveedor;
use Livewire\Component;

class CrearIngreso extends Component
{
    public $productosSeleccionados = [];
    public $producto;
    public $proveedor, $cantidad, $precio_compra, $precio_venta;
    public $total = 0.00;

    protected $rules = [
        'proveedor' => 'required|exists:proveedores,id',
    ];
    public function agregarProducto()
    {

        $producto_seleccionado = Producto::find($this->producto);
        // Verifica que se haya seleccionado un producto válido.
        if (!$this->producto || $this->cantidad <= 0 || $this->precio_compra <= 0 || $this->precio_venta <= 0) {
            // Puedes mostrar un mensaje de error o tomar la acción adecuada aquí.
            $this->addError('agregar', 'Los campos no son válidos o están incompletos.');
            return;
        }

        // Calcula el subtotal para el producto actual.
        $subtotal = $this->cantidad * $this->precio_compra;

        /* calculando el total */
        $this->total += $subtotal;
        // Agrega el producto y sus detalles a la lista de productos seleccionados.
        $this->productosSeleccionados[] = [
            'nombre' => $producto_seleccionado->descripcion, // Asegúrate de tener el nombre del producto en tu modelo.
            'cantidad' => $this->cantidad,
            'precio_compra' => $this->precio_compra,
            'precio_venta' => $this->precio_venta,
            'subtotal' => $subtotal,
        ];

        // Limpiando los campos del formulario después de agregar el producto.
        $this->resetCampos();

        // Puedes mostrar un mensaje de éxito o realizar otras acciones necesarias aquí.
    }


    public function crearIngreso()
    {
        dd('Registrando el ingreso....');

        // Verifica que haya productos seleccionados.
        if (empty($this->productosSeleccionados)) {
            // Puedes mostrar un mensaje de error o tomar la acción adecuada aquí.
            $this->addError('crear_ingreso', 'Debes seleccionar al menos un producto.');
            return;
        }
        // Aquí puedes realizar la lógica para guardar el ingreso en tu base de datos.
        $datos = $this->validate();
        // Por ejemplo, puedes crear un nuevo registro en tu tabla de ingresos y luego
        // guardar los detalles de los productos en una tabla relacionada.

        // Después de guardar la información con éxito, puedes limpiar la lista de productos seleccionados.
        $this->productosSeleccionados = [];

        // Limpia otros campos o realiza otras acciones necesarias.

        // Puedes mostrar un mensaje de éxito o realizar otras acciones necesarias aquí.
        session()->flash('success', 'Ingreso creado con éxito.');
    }
    public function eliminarProducto($index)
    {
        dd('Eliminando....');
        // Verifica si el índice existe en el array $productosSeleccionados.
        if (isset($this->productosSeleccionados[$index])) {
            // Obtiene el subtotal del producto antes de eliminarlo.
            $subtotal = $this->productosSeleccionados[$index]['subtotal'];

            // Elimina el producto del array utilizando el índice.
            unset($this->productosSeleccionados[$index]);

            // Resta el subtotal del producto eliminado al total.
            $this->total -= $subtotal;

            // Puedes realizar otras acciones necesarias aquí después de eliminar el producto.

            // Puedes mostrar un mensaje de éxito o realizar otras acciones necesarias aquí.
            /* session()->flash('success', 'Producto eliminado con éxito'); */
        }
    }
   

    private function resetCampos()
    {
        $this->producto = null;
        $this->cantidad = null;
        $this->precio_compra = null;
        $this->precio_venta = null;
    }

    public function render()
    {
        /* Aca solo recolectamos a los proveedores activos */
        $proveedores = Proveedor::where('estado', '1')->get();
        /* Aca lo mismo, solo productos activos */
        $productos = Producto::where('estado', '1')->get();
        return view('livewire.crear-ingreso', [
            'proveedores' => $proveedores,
            'productos' => $productos
        ]);
    }
}
