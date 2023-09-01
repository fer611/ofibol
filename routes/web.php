<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
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
})->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','rol.administrador','estado'])->name('dashboard');

//Usuarios
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index'); 
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class,'store'])->name('usuarios.store');
Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy'); 

//productos
Route::get('/productos',[ProductoController::class, 'index'])->middleware(['auth','verified','rol.administrador','estado'])->name('productos.index');
Route::get('/productos/create',[ProductoController::class, 'create'])->middleware(['auth','verified','rol.administrador','estado'])->name('productos.create');

//Categorias
Route::get('/categorias',[CategoriaController::class, 'index'])->middleware(['auth','verified','rol.administrador','estado'])->name('categorias.index');
Route::get('/categorias/create',[CategoriaController::class, 'create'])->middleware(['auth','verified','rol.administrador','estado'])->name('categorias.create');
Route::post('/categorias',[CategoriaController::class,'store'])->middleware(['auth','verified','rol.administrador','estado'])->name('categorias.store');
Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->middleware(['auth', 'verified','rol.administrador','estado'])->name('categorias.edit');
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->middleware(['auth', 'verified','rol.administrador','estado'])->name('categorias.destroy');
Route::put('/categorias/{categoria}',[CategoriaController::class, 'update'])->middleware(['auth', 'verified','rol.administrador','estado'])->name('categorias.update');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
