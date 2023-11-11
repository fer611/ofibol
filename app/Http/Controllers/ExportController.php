<?php

namespace App\Http\Controllers;

use App\Exports\VentasExport;
use App\Models\DetalleIngreso;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Ingreso;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ExportController extends Controller
{

    public function reportPDF($userId, $reportType, $dia1 = null, $mes1 = null, $year1 = null, $dia2 = null, $mes2 = null, $year2 = null)
    {

        $dateFrom = $dia1 . '/' . $mes1 . '/' . $year1;
        $dateTo = $dia2 . '/' . $mes2 . '/' . $year2;
        $data = [];
        if ($reportType == 0) { //Ventas del dia

            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        } else {
            /* Esta condicional es para que cuando se cambien de opcion en el select de tipo de reporte, por defecto obtenga la fecha actual para que no ocurra errores al parsear la fecha mas abajo */
            if ($dia1 == null && $mes1 == null && $year1 == null && $dia2 == null && $mes2 == null && $year2) {
                $dateFrom = Carbon::now()->format('d/m/Y');
                $dateTo = Carbon::now()->format('d/m/Y');
            }
            //Ventas por rango de fechas
            $from = Carbon::createFromFormat('d/m/Y', $dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::createFromFormat('d/m/Y', $dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        /* Si es 0, por defecto consultamos las ventas de todos los usuarios */
        if ($userId == 0) {
            $data = Venta::join('users as u', 'u.id', '=', 'ventas.user_id')
                ->select('ventas.*', 'u.name as usuario')
                ->whereBetween('ventas.created_at', [$from, $to])
                ->orderBy('ventas.created_at', 'desc')
                ->get();
        } else {
            $data = Venta::join('users as u', 'u.id', '=', 'ventas.user_id')
                ->select('ventas.*', 'u.name as usuario')
                ->whereBetween('ventas.created_at', [$from, $to])
                ->where('user_id', $userId)
                ->orderBy('ventas.created_at', 'desc')
                ->get();
        }


        /* si el usuario no selecciono ningun usuariop por defecto le asignamos todos */
        $user = $userId == 0 ? 'Todos' : User::find($userId)->name;
        /* $pdf = SnappyPdf::loadView('pdf.reporte', compact('data', 'reportType', 'user', 'dateFrom', 'dateTo')); */
        $pdf = PDF::loadView('pdf.reporte', compact('data', 'reportType', 'user', 'dateFrom', 'dateTo'));
        return $pdf->stream('ReporteVentas.pdf');
        /* $pdf = PDF::loadView('pdf.reporte', compact('data', 'reportType', 'user', 'dateFrom', 'dateTo')); */
        //esto para visualizarlo en el navegador
        /* return $pdf->stream('ReporteVentas.pdf'); */
        /* return $pdf->download('ReporteVentas.pdf'); */ //Esto en caso de descargar el pdf
    }

    //reprote excel
    public function reporteExcel($userId, $reportType, $dia1 = null, $mes1 = null, $year1 = null, $dia2 = null, $mes2 = null, $year2 = null)
    {

        $dateFrom = $dia1 . '/' . $mes1 . '/' . $year1;
        $dateTo = $dia2 . '/' . $mes2 . '/' . $year2;
        $data = [];
        if ($reportType == 0) { //Ventas del dia

            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        } else {
            /* Esta condicional es para que cuando se cambien de opcion en el select de tipo de reporte, por defecto obtenga la fecha actual para que no ocurra errores al parsear la fecha mas abajo */
            if ($dia1 == null && $mes1 == null && $year1 == null && $dia2 == null && $mes2 == null && $year2) {
                $dateFrom = Carbon::now()->format('d/m/Y');
                $dateTo = Carbon::now()->format('d/m/Y');
            }
            //Ventas por rango de fechas
            $from = Carbon::createFromFormat('d/m/Y', $dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::createFromFormat('d/m/Y', $dateTo)->format('Y-m-d') . ' 23:59:59';
        }
        /* Si es 0, por defecto consultamos las ventas de todos los usuarios */
        if ($userId == 0) {
            $data = Venta::join('users as u', 'u.id', '=', 'ventas.user_id')
                ->join('clientes as c', 'c.id', '=', 'ventas.cliente_id')
                ->select('ventas.id', 'ventas.created_at', 'ventas.estado', 'u.name as usuario', 'c.razon_social as cliente_razon_social', 'ventas.items', 'ventas.total')
                ->whereBetween('ventas.created_at', [$from, $to])
                ->orderBy('ventas.created_at', 'desc')
                ->get()
                ->map(function ($venta) {
                    return [
                        'id' => $venta->id,
                        'created_at' => Carbon::parse($venta->created_at)->format('d/m/Y'),
                        'estado' => $venta->estado,
                        'usuario' => $venta->usuario,
                        'cliente' => $venta->cliente_razon_social, // Cambiado a cliente_razon_social
                        'items' => $venta->items,
                        'total' => $venta->total,
                    ];
                });
        } else {
            $data = Venta::join('users as u', 'u.id', '=', 'ventas.user_id')
                ->join('clientes as c', 'c.id', '=', 'ventas.cliente_id')
                ->select('ventas.id', 'ventas.created_at', 'ventas.estado', 'u.name as usuario', 'c.razon_social as cliente_razon_social', 'ventas.items', 'ventas.total')
                ->whereBetween('ventas.created_at', [$from, $to])
                ->where('ventas.user_id', $userId)
                ->orderBy('ventas.created_at', 'desc')
                ->get()
                ->map(function ($venta) {
                    return [
                        'id' => $venta->id,
                        'created_at' => Carbon::parse($venta->created_at)->format('d/m/Y'),
                        'estado' => $venta->estado,
                        'usuario' => $venta->usuario,
                        'cliente' => $venta->cliente_razon_social, // Cambiado a cliente_razon_social
                        'items' => $venta->items,
                        'total' => $venta->total,
                    ];
                });
        }
        //la extension del archivo
        $reportName = 'Reporte de Ventas_' . uniqid() . '.xlsx';

        //retornamos el archivo
        return Excel::download(new VentasExport($data), $reportName);
    }


    public function reporteNotaVenta(Venta $venta)
    {
        $data = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_venta.producto_id')
            ->select('detalle_venta.*', 'p.descripcion as descripcion', 'p.unidad_medida as medida', DB::raw('detalle_venta.precio * detalle_venta.cantidad as total'))
            ->where('venta_id', $venta->id)
            ->orderBy('detalle_venta.created_at', 'desc')
            ->get();
        $pdf = PDF::loadView('pdf.notaVenta', compact('data', 'venta'));
        return $pdf->stream('NotaVenta' . $venta->id . '.pdf');
    }
    public function reporteNotaIngreso(Ingreso $ingreso)
    {

        $data = DetalleIngreso::join('productos as p', 'p.id', '=', 'detalle_ingreso.producto_id')
            ->select('detalle_ingreso.*', 'p.descripcion as descripcion', 'p.unidad_medida as medida', DB::raw('detalle_ingreso.precio_compra * detalle_ingreso.cantidad as total'))
            ->where('ingreso_id', $ingreso->id)
            ->orderBy('detalle_ingreso.created_at', 'desc')
            ->get();
        $pdf = PDF::loadView('pdf.notaIngreso', compact('data', 'ingreso'));
        return $pdf->stream('NotaIngreso' . $ingreso->id . '.pdf');
    }

    public function test()
    {

        $pdf = PDF::loadView('pdf.prueba');
        /* return $pdf->download(); */
        return $pdf->stream();
    }
}
