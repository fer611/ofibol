<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Categoria;
use App\Models\Kardex;
use App\Models\Marca;
use App\Models\Origen;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearProducto extends Component
{
    public $barcode;
    public $descripcion;
    public $marca;
    public $origen;
    public $unidad_medida;
    public $cantidad_unidad;
    public $stock;
    public $stock_minimo;
    public $costo_actual;
    public $porcentaje_margen = 30;
    public $precio_venta;
    public $categoria;
    public $almacen;
    public $imagen;
    public $fecha_vencimiento;
    public $errorImagen = false;
    /* Habilitar subida de archivos */
    use WithFileUploads;
    protected $rules = [
        'barcode' => 'required|string|max:50|unique:productos,barcode',
        'descripcion' => 'required|string|max:255',
        'marca' => 'required|exists:marcas,id',
        'origen' => 'required|exists:origenes,id',
        'unidad_medida' => 'required|string',
        'cantidad_unidad' => 'nullable|numeric|min:0',
        'stock' => ['required', 'numeric', 'min:0'],
        'stock_minimo' => 'required|numeric|min:0',
        'costo_actual' => 'required|numeric|min:0',
        'porcentaje_margen' => 'required|numeric|min:0',
        'precio_venta' => 'required|numeric|min:0',
        'categoria' => 'required|exists:categorias,id',
        'almacen' => 'required|exists:almacenes,id',
        'fecha_vencimiento' => 'nullable|date',
        'imagen' => 'required|image|mimes:jpeg,png,jpg|max:1024',
    ];
    public function crearProducto()
    {
        $datos = $this->validate();

        //Almacenar la imagen
        $imagen = $this->imagen->store('public/productos');
        $datos['imagen'] = str_replace('public/productos/', '', $imagen);
        //Crear El producto

        $producto = Producto::create([
            'barcode' => $datos['barcode'],
            'descripcion' => $datos['descripcion'],
            'marca_id' => $datos['marca'],
            'origen_id' => $datos['origen'],
            'unidad_medida' => $datos['unidad_medida'],
            'cantidad_unidad' => $datos['cantidad_unidad'],
            'stock_minimo' => $datos['stock_minimo'],
            'costo_actual' => $datos['costo_actual'],
            'porcentaje_margen' => $datos['porcentaje_margen'],
            'precio_venta' => $datos['precio_venta'],
            'fecha_vencimiento' => $datos['fecha_vencimiento'],
            'imagen' => $datos['imagen'],
            'estado' => '1',
            'categoria_id' => $datos['categoria'],
        ]);
        //registrando una nueva entrada
        Kardex::create([
            'producto_id' => $producto->id,
            'almacen_id' => $datos['almacen'],
            'entradas' => $datos['stock'],
            'salidas' => 0,
            'precio_producto' => $datos['costo_actual'],
        ]);

        //Crear un mensaje
        session()->flash('mensaje', 'El producto se registró correctamente');
        //Redireccionar al usuario
        return redirect()->route('productos.index');
    }

    public function render()
    {
        /* Consultar BD*/
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $origenes = Origen::all();
        $almacenes = Almacen::all();
        return view('livewire.crear-producto', [
            'categorias' => $categorias,
            'marcas' => $marcas,
            'origenes' => $origenes,
            'almacenes' => $almacenes
        ]);
    }



    public function updated($field)
    {
        if ($field === 'costo_actual' || $field === 'porcentaje_margen') {
            $this->calcularPrecioVenta();
        }
    }

    public function calcularPrecioVenta()
    {
        if ($this->costo_actual && $this->porcentaje_margen) {
            $this->precio_venta = $this->costo_actual + ($this->costo_actual * $this->porcentaje_margen / 100);
        }
    }
    public function updatedImagen()
    {
        try {
            // Intentar generar la URL temporal
            $this->imagen->temporaryUrl();
            $this->errorImagen = false;
        } catch (\Exception $e) {
            // Si falla, mostrar un mensaje de error personalizado
            $this->errorImagen = true;
        }
    }
}
