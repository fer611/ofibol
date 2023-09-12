<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = User::all();
        return view('usuarios.index', ["usuarios" => $usuarios]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', ["roles" => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $this->validate($request, [
            'name' => ['required', 'string', 'max:80'],
            'email' => ['required', 'string', 'email', 'unique:users', 'max:50',],
            'password' => ['required', 'min:8', 'confirmed'],
            'rol_id' => ['required', 'exists:roles,id'],
        ]);

        // Crear el nuevo usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,  // Encriptar la contraseña
            'rol_id' => $request->rol_id,
            'email_verified_at' => Carbon::now(),
            'estado' => '1',
        ]);
        // Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'El usuario se registró correctamente');
        return redirect()->route('usuarios.index');
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
    public function edit(User $usuario)
    {
        /* Obtenienod los roles */
        $roles = Role::all();
        return view('usuarios.edit', [
            'usuario' => $usuario,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /* El findOrFail nos ayuda a validar si realmente existe el id, si no nos da una excepcion y al usuario una pagina 404 */
        $usuario = User::findOrFail($id);

        // Validación de los datos del formulario
        $this->validate($request, [
            'name' => ['required', 'string', 'max:80'],
            /* con excluimos el correo del usuario que se esta editando pero no del nuevo correo que se le asigna, es decir si lo actualizamos por uno nuevo que ya existe nos da un error de validacion */
            'email' => ['required', 'string', 'email', 'max:50', Rule::unique('users')->ignore($usuario->id)],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        $usuario->name = $request->name;
        $usuario->email = $request->email;

        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->new_password) {
            $usuario->password = $request->new_password;
        }

        $usuario->save();

        /* Asignando los roles al usuario */
        $usuario->roles()->sync($request->roles);
        // Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'El usuario se actualizó correctamente');
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::find($id);
        if ($usuario->estado === '1') {
            $usuario->estado = '0';
        } else {
            $usuario->estado = '1';
        }
        $usuario->save();
        return redirect()->route('usuarios.index');
    }
}
