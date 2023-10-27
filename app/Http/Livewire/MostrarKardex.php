<?php

namespace App\Http\Livewire;

use App\Models\Kardex;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MostrarKardex extends Component
{
    public $producto;

    public function mount(Producto $producto)
    {
        $this->producto = $producto;
    }
    public function render()
    {
        
        $kardex = Kardex::where('producto_id', $this->producto->id)->get();
        return view('livewire.mostrar-kardex',[
            'kardex' => $kardex
        ]);
    }
}
