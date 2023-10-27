<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Origen;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditarProducto extends Component
{
    public $producto_id; /* Nueo nombre interno para nuestro componente para no tener problemas de nombre con livewire */
    public $categoria;
    public $origen;
    public $marca;
    public $nombre;
    public $stock_minimo;
    public $descripcion;
    public $unidad_medida;
    public $cantidad_unidad;
    public $costo_actual;
    public $porcentaje_margen;
    public $precio_venta;
    public $imagen;
    public $imagen_nueva;
    public $barcode;
    public $fecha_vencimiento;
    use WithFileUploads;

    public function rules()
    {
        return [
            'barcode' => 'required|string|max:50|unique:productos,barcode,' . $this->producto_id,
            'descripcion' => 'required|string',
            'marca' => 'required|exists:marcas,id',
            'origen' => 'required|exists:origenes,id',
            'unidad_medida' => 'required|string',
            'cantidad_unidad' => 'nullable|numeric|min:0',
            'stock_minimo' => 'required|numeric|min:0',
            'costo_actual' => 'required|numeric|min:0',
            'porcentaje_margen' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'fecha_vencimiento' => 'nullable|date',
            'categoria' => 'required|exists:categorias,id',
            'imagen_nueva' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ];
    }
    /* creando un ciclo de vida de producto */
    public function mount(Producto $producto)
    {
        $this->producto_id = $producto->id;
        $this->categoria = $producto->categoria_id;
        $this->origen = $producto->origen_id;
        $this->marca = $producto->marca_id;
        $this->barcode = $producto->barcode;
        $this->stock_minimo = $producto->stock_minimo;
        $this->descripcion = $producto->descripcion;
        $this->unidad_medida = $producto->unidad_medida;
        $this->cantidad_unidad = $producto->cantidad_unidad;
        $this->costo_actual = $producto->costo_actual;
        $this->porcentaje_margen = $producto->porcentaje_margen;
        $this->precio_venta = $this->costo_actual + ($this->costo_actual * $this->porcentaje_margen / 100);
        $this->imagen = $producto->imagen;
        $this->fecha_vencimiento = $producto->fecha_vencimiento;
    }

    public function editarProducto()
    {
        $datos = $this->validate();
        //si hay una nueva imagen
        if ($this->imagen_nueva) {
            $imagen = $this->imagen_nueva->store('public/productos');
            /* Aca almacenamos solo el nombre de la imagen en datos */
            $datos['imagen'] = str_replace('public/productos/', '', $imagen);
        }
        /* Si el usuario manda una fecha vacia es decir eliminia el input de la fecha de 12/10/2023 a dd/mm*aaaa entonces como
       valor no llega un dato null, sino que llega "" entonces el campo puede ir nulo pero no puede ir como "" cadena vacia por que
       solo se acepta datos de tipo date o nullo */
        if ($datos['fecha_vencimiento'] == "") {
            $datos['fecha_vencimiento'] = null;
        }

        //Encontrar el producto a editar
        $producto = Producto::find($this->producto_id);
        //Asignar los valores
        $producto->categoria_id = $datos['categoria'];
        $producto->origen_id = $datos['origen'];
        $producto->marca_id = $datos['marca'];
        $producto->barcode = $datos['barcode'];
        $producto->stock_minimo = $datos['stock_minimo'];
        $producto->descripcion = $datos['descripcion'];
        $producto->unidad_medida = $datos['unidad_medida'];
        $producto->cantidad_unidad = $datos['cantidad_unidad'];
        $producto->costo_actual = $datos['costo_actual'];
        $producto->porcentaje_margen = $datos['porcentaje_margen'];
        $producto->precio_venta = $datos['precio_venta'];
        $producto->fecha_vencimiento = $datos['fecha_vencimiento'];
        /* Aca reescribimos, pero comprobamos si el usuario subio una nueva imagen asignamos el valor de producto y si no la misma imagen que tiene almacenada */
        $producto->imagen = $datos['imagen'] ?? $producto->imagen;
        //Guardar la vacante
        $producto->save();
        //Crear un mensaje
        session()->flash('mensaje', 'El producto se actualizó correctamente');
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
        return view('livewire.editar-producto', [
            'categorias' => $categorias,
            'marcas' => $marcas,
            'origenes' => $origenes,
            'almacenes' => $almacenes
        ]);
    }
}
