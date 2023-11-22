@extends('adminlte::page')

@section('title', 'Notificaciones')

@section('content')

    @if (session()->has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('mensaje') }}
        </div>
    @endif
    
    <livewire:mostrar-notificaciones />
@stop

@section('css')
@stop

@section('js')

@stop
