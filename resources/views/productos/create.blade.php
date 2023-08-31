@extends('adminlte::page')

@section('title', 'Agregar Producto')

@section('content_header')
    <h1 class="text-center mb-5">Agregar Producto</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="post" novalidate>
                            @csrf
                            <div class="mb-4">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" rows="3"
                                    name="descripcion">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- Aquí otros campos -->
                            <!-- ... -->
                            <button type="submit" class="btn btn-primary w-100">Crear Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
