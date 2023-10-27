<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function __construct()
    {
        /* El middelwire solo se aplica en el index */
        $this->middleware('can:productos.index')->only('index');
        $this->middleware('can:productos.edit')->only('edit', 'update');
        $this->middleware('can:productos.create')->only('create', 'store');
        $this->middleware('can:productos.destroy')->only('destroy');
    }
    public function index()
    {
        // Pasar la colección 
        return view('productos.index');
    }

    public function create()
    {
        return view('productos.create');
    }
    public function show(Producto $producto)
    {

        return view('productos.show', [
            'producto' => $producto
        ]);
    }
    public function edit(Producto $producto)
    {
        return view('productos.edit', [
            'producto' => $producto,
        ]);
    }
    /*  */
    public function kardex(Producto $producto)
    {
        return view('productos.kardex', [
            'producto' => $producto,
        ]);
    }
}
