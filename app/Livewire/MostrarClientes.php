<?php

namespace App\Livewire;

use App\Models\Cliente;
use Livewire\Component;

class MostrarClientes extends Component
{
    public function render()
    {
        $clientes = Cliente::all();
        return view('livewire.mostrar-clientes',[
            'clientes' => $clientes
        ]);
    }
}
