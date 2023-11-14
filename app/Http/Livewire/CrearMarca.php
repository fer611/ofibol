<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use Livewire\Component;

class CrearMarca extends Component
{
    public $nombre;

    protected $rules = [
        'nombre' => 'required|string|max:255|unique:marcas,nombre',
    ];

    public function crearMarca(){
        $datos = $this->validate();
        Marca::create([
            'nombre' => $datos['nombre'],
        ]);
        //Crear un mensaje
        session()->flash('mensaje', 'El producto se registró correctamente');
        //Redireccionar al usuario
        return redirect()->route('marcas.index');
    }
    public function render()
    {
        return view('livewire.crear-marca');
    }
}
