<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Livewire\Component;

class EditarCliente extends Component
{
    public $cliente_id;
    public $razon_social;
    public $nit;
    public $telefono;
    public $direccion;
    public $email;
    public function rules()
    {
        return [
            'razon_social' => 'required|max:255',
            'nit' => 'required|numeric|min:0|unique:clientes,nit,' . $this->cliente_id,
            'telefono' => 'nullable|numeric|min:0',
            'direccion' => 'nullable|string',
            'email' => 'nullable|email',
        ];
    }
    public function mount(Cliente $cliente)
    {
        $this->cliente_id = $cliente->id;
        $this->razon_social = $cliente->razon_social;
        $this->nit = $cliente->nit;
        $this->telefono = $cliente->telefono;
        $this->direccion = $cliente->direccion;
        $this->email = $cliente->email;
    }

    public function editarCliente(){
        $datos = $this->validate();
        $cliente = Cliente::find($this->cliente_id);
        $cliente->update($datos);
        //Crear un mensaje
        session()->flash('mensaje', 'El cliente se actualizó correctamente');
        //Redireccionar al usuario
        return redirect()->route('clientes.index');
    }
    public function render()
    {
        return view('livewire.editar-cliente');
    }
}
