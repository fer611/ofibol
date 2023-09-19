<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        $permisos = Permission::all();
        return view('roles.create', [
            'permisos' => $permisos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => ['required', 'max:50'],
        ]);

        // Creamos el rol con los campos enviados del formulario
        $rol = Role::create([
            'name' => $request->input('nombre'),  // Aquí especificas el campo 'nombre' del formulario
        ]);

        // Asignando distintos permisos al rol que acabamos de crear
        $rol->permissions()->sync($request->input('permisos'));

        // Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'El nuevo rol se registró correctamente');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $rol)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $rol)
    {
        $permisos = Permission::all();
        return view('roles.edit', [
            'rol' => $rol,
            'permisos' => $permisos
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

        // 2. Buscar el rol
        $rol = Role::find($id);

        // 3. Actualizar campos
        $rol->name = $request->input('nombre');

        // 4. Guardar cambios
        $rol->save();

        // 5. Sincronizar permisos
        $rol->permissions()->sync($request->input('permisos'));

        // 6. Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'El rol se actualizó correctamente');
        return redirect()->route('roles.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::find($id)->delete();
        // 6. Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'El rol se eliminó correctamente');
        return redirect()->route('roles.index');
    }
}
