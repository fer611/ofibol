<?php

namespace App\Livewire;

use Livewire\Component;

class MostrarProductos extends Component
{
    public $productos;

    protected $listeners = ['prueba'];
    public function render()
    {
        return view('livewire.mostrar-productos');
    }
}
