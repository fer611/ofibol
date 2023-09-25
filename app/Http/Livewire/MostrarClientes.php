<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Livewire\Component;

class MostrarClientes extends Component
{
    protected $listeners = ['eliminarCliente'];
    
    public function eliminarCliente(Cliente $cliente)
    {
        // Cambia el estado del cliente a inactivo (0)
        $cliente->estado = '0';
        $cliente->save();
    }

    public function render()
    {
        $clientes = Cliente::all();
        return view('livewire.mostrar-clientes', [
            'clientes' => $clientes
        ]);
    }
}
