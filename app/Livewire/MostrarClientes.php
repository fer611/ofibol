<?php

namespace App\Livewire;

use App\Models\Cliente;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarClientes extends Component
{
    
    #[On('prueba')]
    public function prueba($id)
    {
        dd($id);
    }
    public function render()
    {
        $clientes = Cliente::all();
        return view('livewire.mostrar-clientes',[
            'clientes' => $clientes
        ]);
    }
}
