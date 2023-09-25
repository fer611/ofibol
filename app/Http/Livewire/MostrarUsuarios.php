<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MostrarUsuarios extends Component
{
    public $usuarios;
    public function render()
    {
        return view('livewire.mostrar-usuarios');
    }
}
