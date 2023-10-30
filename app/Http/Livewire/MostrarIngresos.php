<?php

namespace App\Http\Livewire;

use App\Models\Ingreso;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MostrarIngresos extends Component
{
    public function render()
    {
        $ingresos =Ingreso::all();


        return view('livewire.mostrar-ingresos', [
            'ingresos' => $ingresos
        ]);
    }
}
