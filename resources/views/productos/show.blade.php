@extends('adminlte::page')

@section('title', 'Agregar Producto')

@section('content_header')
    @if (session()->has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('mensaje') }}
        </div>
    @endif
@stop
@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="m-0">Detalles del Producto</h1>
                    </div>
                    <div class="card-body">
                        <livewire:mostrar-producto :producto="$producto" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css'){{-- 
    <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@stop

@section('js')

@stop
