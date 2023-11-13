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
        
        // Calcular totales
        $totalEntradas = $kardex->sum('entradas');
        $totalSalidas = $kardex->sum('salidas');
        /* Obtenemos el ultimo saldo registrado deed producto */
        $saldoActual = Kardex::where('producto_id', $this->producto->id)->orderBy('id', 'desc')->first();
        /* Obtenemos el stock entradas-salidas*/
        $stock = DB::table('kardex')
            ->where('producto_id', $this->producto->id)
            ->selectRaw('SUM(entradas) - SUM(salidas) as stock')
            ->groupBy('producto_id')
            ->value('stock');
        return view('livewire.mostrar-kardex',[
            'kardex' => $kardex,
            'totalEntradas' => $totalEntradas,
            'totalSalidas' => $totalSalidas,
            'saldoActual' => $saldoActual,
            'stock' => $stock
        ]);
    }
}
