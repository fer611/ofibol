<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('texto'));
            $roles = DB::table('roles')
                ->where('name', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->paginate(7);
            return view('roles.index', ["roles" => $roles, "texto" => $query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => ['required', 'max:50'],
        ]);
        Rol::create([
            'name' => $request->nombre,
        ]);
        // Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'El nuevo rol se registró correctamente');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rol $rol)
    {
        return view('roles.edit', [
            'rol' => $rol
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        // 1. Validar datos
        $request->validate([
            'nombre' => 'required|max:50',
        ]);
        // 2. Buscar categoría
        $rol = Rol::find($id);
        // 3. Actualizar campos
        $rol->name = $request->input('nombre');
        // 4. Guardar cambios
        $rol->save();
        // Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'El rol se actualizó correctamente');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Rol::find($id)->delete();
        return redirect()->route('roles.index');
    }
}
