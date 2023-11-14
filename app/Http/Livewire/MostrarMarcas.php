<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use Livewire\Component;

class MostrarMarcas extends Component
{

    public function eliminarMarca(Marca $marca){
        $marca->delete();
        
    }
    public function render()
    {
        /* Obtener marcas */
        $marcas = Marca::all();
        return view('livewire.mostrar-marcas',[
            'marcas' => $marcas
            ]);
    }
}
