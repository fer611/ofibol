
@extends('adminlte::page')

@section('title', 'Productos')

@section('content')
    <!-- Content Header (Page header) -->
   {{--  <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nueva Categoria</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Categorias</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Main content -->
    <section class="content mt-4">
        <div class="container-fluid">
            <!-- Form Section -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>Modificar Categoria</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('categorias.update', $categoria->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        id="nombre" name="nombre" value="{{ $categoria->nombre }}"
                                        placeholder="Nombre de la categoria">
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
                                        id="descripcion" name="descripcion" value="{{ $categoria->descripcion }}"
                                        placeholder="Descripción de la categoria">
                                    @error('descripcion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div
                                        class="col-md-6 offset-md-6 d-flex flex-md-row flex-column justify-content-between">
                                        <button type="submit" class="btn btn-success mb-2 mb-md-0 flex-fill mx-1">
                                            Guardar</button>
                                        <button type="reset" class="btn btn-secondary flex-fill mx-1">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
</script>
@stop
