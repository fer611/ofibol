<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('texto'));
            $categorias = DB::table('categorias')
                ->where('nombre', 'LIKE', '%' . $query . '%')
                ->orWhere('descripcion', 'LIKE', '%' . $query . '%')  // Línea agregada
                ->orderBy('id', 'asc')
                ->paginate(5);
            return view('categorias.index', ["categorias" => $categorias, "texto" => $query]);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => ['required', 'max:255'],
            'descripcion' => ['required', 'max:255'],
        ]);
        Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
        return redirect()->route('categorias.index');
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
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', [
            'categoria' => $categoria
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validar datos
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
        ]);
        // 2. Buscar categoría
        $categoria = Categoria::find($id);
        // 3. Actualizar campos
        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
        // 4. Guardar cambios
        $categoria->save();
        // Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'La categoría se actualizó correctamente');
        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categoria::find($id)->delete();
        // Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'La categoría se eliminó correctamente');
        return redirect()->route('categorias.index');
    }
}
