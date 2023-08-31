@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>LISTADO DE PRODUCTOS</h1>
@stop

@section('content')
<div class="container-fluid bg-light p-5 rounded">
    <!-- Botón para agregar nuevo producto -->
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary" class="btn btn-primary" href="{{ route('productos.create') }}">Agregar nuevo producto</a>
    </div>
    
    <!-- Listado de productos -->
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Descripción</th>
                <th>Marca</th>
                <th>Origen</th>
                <th>Unidad de Medida</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Almacén</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Producto 1</td>
                <td>Marca 1</td>
                <td>Origen 1</td>
                <td>kg</td>
                <td>100</td>
                <td>20</td>
                <td>Cat 1</td>
                <td>Alm 1</td>
                <td><img src="imagen1.jpg" width="50" alt="Imagen 1"></td>
            </tr>
            <tr>
                <td>Producto 2</td>
                <td>Marca 2</td>
                <td>Origen 2</td>
                <td>kg</td>
                <td>100</td>
                <td>20</td>
                <td>Cat 1</td>
                <td>Alm 1</td>
                <td><img src="imagen1.jpg" width="50" alt="Imagen 1"></td>
            </tr>
            <tr>
                <td>Producto 3</td>
                <td>Marca 3</td>
                <td>Origen 3</td>
                <td>kg</td>
                <td>100</td>
                <td>20</td>
                <td>Cat 1</td>
                <td>Alm 1</td>
                <td><img src="imagen1.jpg" width="50" alt="Imagen 1"></td>
            </tr>
        </tbody>
    </table>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
