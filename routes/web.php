<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/* Esta ruta es de breeze */
/* Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login'); */

//Notifications

//esto para redireccionar a usuarios cliente
Route::get('/home', function () {
    return view('home'); 
})->middleware(['auth', 'verified','estado'])->name('home');

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth', 'verified','estado','rol.cliente','can:dashboard'])->name('dashboard');

Route::get('datatable/users',[DatatableController::class,'user'])->name('datatable.user');

Route::middleware(['auth', 'verified',  'estado','rol.cliente'])->group(function () {

    
    // Rutas de usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index'); 
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class,'store'])->name('usuarios.store');
    Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    //Rutas de roles
    Route::get('/roles', [RolController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RolController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RolController::class,'store'])->name('roles.store'); 
    Route::get('/roles/{rol}/edit', [RolController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{rol}', [RolController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RolController::class, 'destroy'])->name('roles.destroy');

    //Rutas de productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class,'store'])->name('productos.store');
    Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    /* Ruta para el kardex de cada producto */
    Route::get('/productos/{producto}/kardex', [ProductoController::class, 'kardex'])->name('productos.kardex');

    /* crud marcas*/
    Route::get('/marcas', [MarcaController::class, 'index'])->name('marcas.index');
    Route::get('/marcas/create', [MarcaController::class, 'create'])->name('marcas.create');
    Route::post('/marcas', [MarcaController::class,'store'])->name('marcas.store');
    Route::get('/marcas/{marca}/edit', [MarcaController::class, 'edit'])->name('marcas.edit');
    Route::delete('/marcas/{marca}', [MarcaController::class, 'destroy'])->name('marcas.destroy');
    


    // Rutas de categorías
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');

    //rutas de proveedores
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
    Route::post('/proveedores', [ProveedorController::class,'store'])->name('proveedores.store');
    Route::get('/proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
    Route::delete('/proveedores/{proveedor}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
    Route::put('/proveedores/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');

    //rutas de clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClienteController::class,'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');

    //rutas de ingresos
    Route::get('/ingresos',[IngresoController::class, 'index'])->name('ingresos.index');
    Route::get('/ingresos/create',[IngresoController::class, 'create'])->name('ingresos.create');
    Route::post('/ingresos', [IngresoController::class,'store'])->name('ingresos.store');
    Route::get('/ingresos/{ingreso}', [IngresoController::class, 'show'])->name('ingresos.show');
    Route::get('/ingresos/{ingreso}/edit', [IngresoController::class, 'edit'])->name('ingresos.edit');
    Route::delete('/ingresos/{ingreso}', [IngresoController::class, 'destroy'])->name('ingresos.destroy');
    Route::put('/ingresos/{ingreso}', [IngresoController::class, 'update'])->name('ingresos.update');

    //Rutas de ventas
    Route::get('/ventas',[VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/create',[VentaController::class, 'create'])->name('ventas.create');
    Route::post('/ventas', [VentaController::class,'store'])->name('ventas.store');
    Route::get('/ventas/{venta}', [VentaController::class, 'show'])->name('ventas.show');
    Route::get('/ventas/{venta}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
    Route::delete('/ventas/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy');
    Route::put('/ventas/{venta}', [VentaController::class, 'update'])->name('ventas.update');

    //Notificaciones
    Route::get('/notificaciones', [NotificacionController::class,'index'])->name('notificaciones.index');
    Route::get('/notificaciones/get', [NotificacionController::class,'getNotificationsData'])->name('notificaciones.get');

    //Rutas de Reportes
    Route::get('/reportes',[ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes2',[ReporteController::class, 'test'])->name('reportes.test');
    /* Aca creamos un controlador propio para exportar los reportes  */
    //Reportes PDF
    /* Esta parte se puede optimizar pero por falta de tiempo solo queda usar la logica, no podemos mandar la fecha directamente
    en el formato d/m/Y ya que laravel pensara que le enviamos parametros, entonces lo que haremos será obtener mas parametros es decir
    8 en total separando el dia/mes/año y ya en el controlador lo volvemos a concatenar */
    Route::get('/reportes/pdf/{user}/{type}/{dia1}/{mes1}/{year1}/{dia2}/{mes2}/{year2}',[ExportController::class, 'reportPDF']);
    Route::get('/reportes/pdf/{user}/{type}',[ExportController::class, 'reportPDF']);
    /* Esto desde la vista de ventas */
    Route::get('/ventas/pdf/{venta}',[ExportController::class, 'reporteNotaVenta'])->name('ventas.pdf');
    Route::get('/ingresos/pdf/{ingreso}',[ExportController::class, 'reporteNotaIngreso'])->name('ingresos.pdf');
    /* Productos con poco stock */
    Route::get('/dashboard/pdf',[ExportController::class, 'reporteProductosPocoStock'])->name('productos.pdf');
    /* los productos mas vendidos */
    Route::get('/dashboard/pdf2',[ExportController::class, 'reporteProductosMasVendidos'])->name('masVendidos.pdf');

    //Reportes EXCEL
    Route::get('/reportes/excel/{user}/{type}/{dia1}/{mes1}/{year1}/{dia2}/{mes2}/{year2}',[ExportController::class, 'reporteExcel']);
    Route::get('/reportes/excel/{user}/{type}',[ExportController::class, 'reporteExcel']);


    //Ruta para el acceso al backup
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
