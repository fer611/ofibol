@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')

@stop

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center bg-dark">
                        <h3><strong> EDITAR CLIENTE </strong></h3>
                    </div>
                    <livewire:editar-cliente :cliente="$cliente" /> {{-- Pasando el objeto cliente para el formulario editar --}}
                </div>
            </div>
        </div>
    </div>
    </div>
@stop

@section('css')
    {{-- Estilos de la plantilla lw pos --}}
    <link rel="stylesheet" href="{{ asset('apps/scrumboard.css') }}">
    <link rel="stylesheet" href="{{ asset('apps/notes.css') }}">s
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@stop

@section('js')

@stop
