@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content')

    <!-- Main content -->
    <section class="content mt-4">
        <div class="container-fluid">
            <!-- Form Section -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>Crear Nuevo Proveedor</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('proveedores.store') }}" method="post" novalidate>
                                @csrf
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        id="nombre" name="nombre" placeholder="Nombre del proveedor"
                                        value="{{ old('nombre') }}">
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="representante">Representante</label>
                                    <input type="text" class="form-control @error('representante') is-invalid @enderror"
                                        id="representante" name="representante" placeholder="Nombre del representante"
                                        value="{{ old('representante') }}">
                                    @error('representante')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                        id="direccion" name="direccion" placeholder="Dirección del proveedor"
                                        value="{{ old('direccion') }}">
                                    @error('direccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                        id="telefono" name="telefono" placeholder="Teléfono de contacto"
                                        value="{{ old('telefono') }}">
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo</label>
                                    <input type="email" class="form-control @error('correo') is-invalid @enderror"
                                        id="correo" name="correo" placeholder="Correo electrónico"
                                        value="{{ old('correo') }}">
                                    @error('correo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div
                                        class="col-md-6 offset-md-6 d-flex flex-md-row flex-column justify-content-between">
                                        <button type="submit"
                                            class="btn btn-success mb-2 mb-md-0 flex-fill mx-1">Guardar</button>
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
@stop
