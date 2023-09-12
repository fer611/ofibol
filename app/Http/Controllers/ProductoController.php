<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los productos
        $productos = Producto::all();

        // Ejecutar la consulta SQL para obtener el stock de cada producto
        $stocks = DB::select("SELECT producto_id, sum(entradas) - sum(salidas) as stock FROM kardex GROUP BY producto_id");

        // Inicializar un array para mapear los IDs de los productos a su stock
        $stockMap = [];

        // Llenar el array con los datos de stock
        foreach ($stocks as $stock) {
            $stockMap[$stock->producto_id] = $stock->stock;
        }

        // Asignar el stock a cada producto en la colección $productos
        foreach ($productos as $producto) {
             // Usar el stock del mapa si está disponible, de lo contrario usar 0
            $producto->stock = $stockMap[$producto->id] ?? 0;
        }

        // Pasar la colección $productos a la vista
        return view('productos.index', ["productos" => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('productos.show',[
            'producto' => $producto
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', [
            'producto' => $producto,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
