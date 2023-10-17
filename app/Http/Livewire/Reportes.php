<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DetalleVenta;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;

class Reportes extends Component
{
    public $componenteNombre, $data, $detalles,
        $sumDetails, $countDetails, $reportType, $userId, $dateFrom, $dateTo, $ventaId, $selected_id = 0;

    public function mount()
    {
        $this->componenteNombre = "Reporte de Ventas";
        $this->data = [];
        $this->detalles = [];
        $this->sumDetails = 0;
        $this->countDetails = 0;
        $this->reportType = 0;
        $this->userId = 0;
        $this->ventaId = 0;
    }
    public function render()
    {
        $this->VentasPorFecha();
        $users = User::orderBy('name', 'asc')->get();

        return view('livewire.reportes.componente', [
            'users' => $users,
        ]);
    }


    public function VentasPorFecha()
    {
        if ($this->reportType == 0) { //Ventas del dia

            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        } else {
            /* Esta condicional es para que cuando se cambien de opcion en el select de tipo de reporte, por defecto obtenga la fecha actual para que no ocurra errores al parsear la fecha mas abajo */
            if ($this->dateTo == null && $this->dateFrom == null) {
                $this->dateFrom = Carbon::now()->format('d/m/Y');
                $this->dateTo = Carbon::now()->format('d/m/Y');
            }
            //Ventas por rango de fechas
            $from = Carbon::createFromFormat('d/m/Y', $this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::createFromFormat('d/m/Y', $this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if ($this->reportType == 1 && ($this->dateFrom == '' || $this->dateTo == '')) {
            /* Aca podemos notificar al usuario para que especifique las fechas */
            return;
        }

        /* Si es 0, por defecto consultamos las ventas de todos los usuarios */
        if ($this->userId == 0) {
            $this->data = Venta::join('users as u', 'u.id', '=', 'ventas.user_id')
                ->select('ventas.*', 'u.name as usuario')
                ->whereBetween('ventas.created_at', [$from, $to])
                ->orderBy('ventas.created_at', 'desc')
                ->get();
        } else {
            $this->data = Venta::join('users as u', 'u.id', '=', 'ventas.user_id')
                ->select('ventas.*', 'u.name as usuario')
                ->whereBetween('ventas.created_at', [$from, $to])
                ->where('user_id', $this->userId)
                ->orderBy('ventas.created_at', 'desc')
                ->get();
        }
    }

    public function getDetails($ventaId)
    {
        $this->ventaId = $ventaId;
        $this->detalles = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_venta.producto_id')
            ->select('detalle_venta.id', 'detalle_venta.precio', 'detalle_venta.cantidad', 'p.descripcion as producto')
            ->where('detalle_venta.venta_id', $ventaId)
            ->get();


        $suma = $this->detalles->sum(function ($item) {
            return $item->precio * $item->cantidad;
        });
        $this->sumDetails = $suma;
        $this->countDetails = $this->detalles->sum('cantidad');
        $this->ventaId = $ventaId;

        /*  */
        $this->emit('show-modal', 'details loaded');
    }
}
