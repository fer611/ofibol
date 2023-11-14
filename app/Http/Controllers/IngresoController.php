<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* Invocamos el redirect, para redireccionar nuestras vistas */
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\IngresoFormRequest;
use App\Models\Ingreso;
use Symfony\Component\Console\Input\Input;



class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        /* Aplicando middelware para cada ruta*/
        $this->middleware('can:ingresos.index')->only('index');
        $this->middleware('can:ingresos.edit')->only('edit', 'update');
        $this->middleware('can:ingresos.create')->only('create', 'store');
        $this->middleware('can:ingresos.destroy')->only('destroy');
    }

    public function index()
    { 
        return view('ingresos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ingresos.create');
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
    public function show(Ingreso $ingreso)
    {
        return view('ingresos.show', [
            'ingreso' => $ingreso
        ]);
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
