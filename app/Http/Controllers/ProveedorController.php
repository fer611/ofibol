<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function __construct()
    {
        /* El middelwire solo se aplica en el index */
        $this->middleware('can:proveedores.index')->only('index');
        $this->middleware('can:proveedores.edit')->only('edit','update');
        $this->middleware('can:proveedores.create')->only('create','store');
        $this->middleware('can:proveedores.destroy')->only('destroy');
    }
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', ["proveedores" => $proveedores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $this->validate($request, [
            'nombre' => ['required', 'string', 'max:150'],
            'representante' => ['nullable', 'string', 'max:150'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'correo' => ['nullable', 'string', 'email', 'max:100'],
        ]);

        // Crear el nuevo usuario
        Proveedor::create([
            'nombre' => $request->nombre,
            'representante' => $request->representante,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'estado' => '1',
        ]);
        // Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'El proveedor se registró correctamente');
        return redirect()->route('proveedores.index');
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
    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', [
            'proveedor' => $proveedor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // El findOrFail nos ayuda a validar si realmente existe el id, si no nos da una excepción y al usuario una página 404
        $proveedor = Proveedor::findOrFail($id);

        // Validación de los datos del formulario
        $this->validate($request, [
            'nombre' => ['required', 'string', 'max:150'],
            'representante' => ['nullable', 'string', 'max:150'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'correo' => ['nullable', 'string', 'email', 'max:100'],
        ]);

        $proveedor->nombre = $request->nombre;
        $proveedor->representante = $request->representante;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->correo = $request->correo;

        $proveedor->save();

        // Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'El proveedor se actualizó correctamente');
        return redirect()->route('proveedores.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proveedor = Proveedor::find($id);
        if ($proveedor->estado === '1') {
            $proveedor->estado = '0';
        } else {
            $proveedor->estado = '1';
        }
        $proveedor->save();
        return redirect()->route('proveedores.index');
    }
}
