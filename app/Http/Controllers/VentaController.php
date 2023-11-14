<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        /* Aplicando middelware para cada ruta*/
        $this->middleware('can:ventas.index')->only('index');
        $this->middleware('can:ventas.edit')->only('edit', 'update');
        $this->middleware('can:ventas.create')->only('create', 'store');
        $this->middleware('can:ventas.destroy')->only('destroy');
    }

    public function index()
    {
        return view('ventas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('ventas.create');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
