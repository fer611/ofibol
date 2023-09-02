<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

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

//esto para redireccionar a usuarios cliente
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified','estado'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','rol.administrador','estado'])->name('dashboard');

Route::middleware(['auth', 'verified', 'rol.administrador', 'estado'])->group(function () {
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
    Route::get('/roles/{role}/edit', [RolController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RolController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RolController::class, 'destroy'])->name('roles.destroy');

    //Rutas de productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');

    // Rutas de categorías
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
});
/* //productos
Route::get('/productos',[ProductoController::class, 'index'])->middleware(['auth','verified','rol.administrador','estado'])->name('productos.index');
Route::get('/productos/create',[ProductoController::class, 'create'])->middleware(['auth','verified','rol.administrador','estado'])->name('productos.create');
 */


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
