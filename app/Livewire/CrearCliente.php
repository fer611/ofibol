<?php

namespace App\Livewire;

use App\Models\Cliente;
use Livewire\Component;

class CrearCliente extends Component
{

    public $razon_social;
    public $nit;
    public $telefono;
    public $direccion;
    public $email;

    protected $rules = [
        'razon_social' => 'required|max:255',
        'nit' => 'required|numeric|min:0',
        'telefono' => 'nullable|numeric|min:0',
        'direccion' => 'nullable|string',
        'email' => 'nullable|email'
    ];
    public function crearCliente()
    {
        $datos = $this->validate();
        Cliente::create([
            'razon_social' => $datos['razon_social'],
            'nit' => $datos['nit'],
            'telefono' => $datos['telefono'],
            'direccion' => $datos['direccion'],
            'email' => $datos['email']
        ]);
        //Crear un mensaje
        session()->flash('mensaje', 'El Cliente se registró correctamente');
        //Redireccionar al usuario
        return redirect()->route('clientes.index');
    }
    public function render()
    {
        return view('livewire.crear-cliente');
    }
}
