<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $inversion = DB::table('kardex')
            ->select(DB::raw('SUM((entradas - salidas) * precio_producto) as inversion_total'))
            ->first()
            ->inversion_total;
        $entradas = DB::table('kardex')
            ->select(DB::raw('SUM(entradas) as total_entrada'), DB::raw('MONTH(created_at) as mes'))
            ->groupBy('mes')
            ->get();
        $usuarios = User::all();
        return view('dashboard', [
            'usuarios' => $usuarios,
            'entradas' => $entradas,
            'inversion' => $inversion
        ]);
    }
}
