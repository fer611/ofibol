<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $productos = Producto::all();
        /* Obtener total de compras del mes actual*/
        $totalCompras = DB::table('ingresos')->whereMonth('created_at', date('m'))->sum('total');
        /* Obtener total de ventas */
        $totalVentas = DB::table('ventas')->whereMonth('created_at', date('m'))->sum('total');
        /* Obtener total de ganancias, select sum(dv.cantidad * dv.precio) - sum(p.preccio_actual * dv.cantidad) from detalle_venta dv inner join productos p on dv.producto_id = p.id; */
        $totalGanancias = DB::table('detalle_venta')
            ->join('productos', 'detalle_venta.producto_id', '=', 'productos.id')
            ->selectRaw('sum(detalle_venta.cantidad * detalle_venta.precio) - sum(productos.costo_actual * detalle_venta.cantidad) as ganancias')
            ->whereMonth('detalle_venta.created_at', date('m'))
            ->get();
        /* formatear y obtener el valor de las ganancias */
        $totalGanancias = number_format(($totalGanancias[0]->ganancias), 2, ',', '.');
        // Obtener productos con poco stock
        $productosPocoStock = Producto::join('kardex', 'productos.id', '=', 'kardex.producto_id')
            ->selectRaw('productos.*, sum(kardex.entradas - kardex.salidas) as stock')
            ->groupBy('productos.id', 'productos.stock_minimo') // Agrupa también por stock_minimo
            ->havingRaw('stock <= productos.stock_minimo')
            ->get();
        //Obtener productos mas vendidos, y agregar un atributo del total de ventas
        $productosMasVendidos = Producto::join('detalle_venta', 'productos.id', '=', 'detalle_venta.producto_id')
            ->selectRaw('productos.*, sum(detalle_venta.cantidad) as cantidad, sum(detalle_venta.cantidad * productos.precio_venta) as total_ventas')
            ->groupBy('productos.id')
            ->orderBy('cantidad', 'desc')
            ->take(5)
            ->get();

        /* Obtener el total de ventas de día */
        $totalVentasDia = DB::table('ventas')->whereDate('created_at', date('Y-m-d'))->sum('total');

        /* Obtener ventas del mes para el grafico */
        $resultado = Venta::select(DB::raw('DATE(created_at) as fecha_venta'), DB::raw('SUM(ROUND(total, 2)) as total_venta'))
            ->where(DB::raw('DATE(created_at)'), '>=', DB::raw('DATE(LAST_DAY(NOW() - INTERVAL 1 MONTH) + INTERVAL 1 DAY)'))
            ->where(DB::raw('DATE(created_at)'), '<=', DB::raw('LAST_DAY(DATE(CURRENT_DATE))'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();
        /* Recorremos el array dee resultado para almacenarlo en dos arrays diferentes */
        $total_venta_mes = 0;
        $fecha_venta [] = '';
        $total_venta [] = '';
        for ($i = 0; $i < $resultado->count(); $i++) {
            $fecha_venta[] = $resultado[$i]->fecha_venta;
            $total_venta[] = $resultado[$i]->total_venta;
            $total_venta_mes += $resultado[$i]->total_venta; 
        }
        return view('dashboard', [
            'productos' => $productos,
            'totalCompras' => $totalCompras,
            'totalVentas' => $totalVentas,
            'totalGanancias' => $totalGanancias,
            'productosPocoStock' => $productosPocoStock,
            'totalVentasDia' => $totalVentasDia,
            'productosMasVendidos' => $productosMasVendidos,
            'resultado' => $resultado,
            'fecha_venta' => $fecha_venta,
            'total_venta' => $total_venta,
            'total_venta_mes' => $total_venta_mes
        ]);
    }
}
