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
/* Para generar codigo de barras */
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\File;

class CrearProducto extends Component
{
    public $categoria, $origen, $marca, $stock_minimo, $unidad_medida, $cantidad_unidad, $descripcion, $fecha_vencimiento, $barcode;

    public $imagen;
    public $errorImagen = false;
    /* Habilitar subida de archivos */
    use WithFileUploads;
    protected $rules = [
        'categoria' => 'required|exists:categorias,id',
        'origen' => 'required|exists:origenes,id',
        'marca' => 'required|exists:marcas,id',
        'stock_minimo' => 'required|numeric|min:0',
        'unidad_medida' => 'required|string',
        'cantidad_unidad' => 'nullable|numeric|min:0',
        'descripcion' => 'required|string|max:255',
        'fecha_vencimiento' => 'nullable|date',
        'barcode' => 'required|numeric|max:20|unique:productos,barcode',
        'imagen' => 'required|image|mimes:jpeg,png,jpg|max:1024',
    ];

    public function crearProducto()
    {
        //Validar los datos
        $datos = $this->validate();
        
        //Almacenar la imagen
        $imagen = $this->imagen->store('public/productos');
        $datos['imagen'] = str_replace('public/productos/', '', $imagen);
        //Crear El producto
        Producto::create([
            'barcode' => $datos['barcode'],
            'descripcion' => $datos['descripcion'],
            'marca_id' => $datos['marca'],
            'categoria_id' => $datos['categoria'],
            'origen_id' => $datos['origen'],
            'unidad_medida' => $datos['unidad_medida'],
            'cantidad_unidad' => $datos['cantidad_unidad'],
            'stock_minimo' => $datos['stock_minimo'],
            'fecha_vencimiento' => $datos['fecha_vencimiento'],
            'imagen' => $datos['imagen'],
            'estado' => '1',
        ]);

        //Crear un mensaje
        session()->flash('mensaje', 'El producto se registró correctamente');
        //Redireccionar al usuario
        return redirect()->route('productos.index');
    }
    public function generarBarcode(){
        // Generar un número aleatorio como código de barras (puedes ajustarlo según tus necesidades)
        $codigoGenerado = rand(100000000, 999999999);
    
        // Mostrar el código de barras generado
        $this->barcode = $codigoGenerado;
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



    /*  public function updated($field)
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
    } */
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
