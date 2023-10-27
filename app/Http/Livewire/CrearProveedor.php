<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use Livewire\Component;

class CrearProveedor extends Component
{
    public $nombre, $representante, $telefono, $direccion, $email;

    protected $rules = [
        'nombre' => ['required', 'string', 'max:150'],
        'representante' => ['nullable', 'string', 'max:150'],
        'direccion' => ['nullable', 'string', 'max:255'],
        'telefono' => ['nullable', 'string', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
        'email' => ['nullable', 'string', 'email:filter', 'max:100'],
    ];
    public function crearProveedor()
    {
        $datos = $this->validate();
        /* Creamos el proveedor */
        Proveedor::create([
            'nombre' => $datos['nombre'],
            'representante'=> $datos['representante'],
            'direccion'=> $datos['direccion'],
            'telefono'=> $datos['telefono'],
            'email'=> $datos['email'],
            'estado' => '1',
        ]);
        //Crear un mensaje
        session()->flash('mensaje', 'El Proveedor se registró correctamente');

        $this->reset(['nombre', 'representante', 'telefono', 'direccion', 'email']);
    }
    public function render()
    {
        return view('livewire.crear-proveedor');
    }
}
