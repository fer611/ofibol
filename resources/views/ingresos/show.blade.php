@extends('adminlte::page')

@section('title', 'Detalle Ingreso')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detalles del Ingreso</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">ingresos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {{-- <livewire:mostrar-producto :producto="$producto" /> --}}
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
