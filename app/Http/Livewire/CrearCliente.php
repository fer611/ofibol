<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\User;
use App\Notifications\NuevoCliente;
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
        'nit' => 'required|numeric|min:0|unique:clientes',
        'telefono' => 'nullable|numeric|min:0',
        'direccion' => 'nullable|string',
        'email' => 'nullable|email',
    ];

    public function crearCliente()
    {
       
        // Obtener al dueño de la empresa con el rol "Dueño"
        $owner = User::role('Dueño')->first();
        //Validar los datos
        $datos = $this->validate();
        //Crear el cliente
        $cliente = Cliente::create([
            'razon_social' => $datos['razon_social'],
            'nit' => $datos['nit'],
            'telefono' => $datos['telefono'],
            'direccion' => $datos['direccion'],
            'email' => $datos['email']
        ]);

        //Enviamos una notificacion
        $owner->notify(new NuevoCliente($cliente->id, $cliente->razon_social, $cliente->nit, $owner->id));
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
