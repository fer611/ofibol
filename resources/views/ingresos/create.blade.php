@extends('adminlte::page')

@section('title', 'Registrar Ingreso')

@section('content_header')
    {{-- <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registrar Ingreso</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Ingresos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> --}}
@stop

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-start">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2E86C1; color: #fff;">
                        <h4 class="mb-0">Nuevo Ingreso</h4>
                    </div>
                    <div class="card-body">
                        <livewire:crear-ingreso />
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- CDN select2 --}}
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-select.min.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@stop

@section('js')

    {{-- CDN select2 --}}

    <script src="{{ asset('dist/js/bootstrap-select.min.js') }}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
@stop
