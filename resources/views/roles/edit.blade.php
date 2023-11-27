@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content')

    <!-- Main content -->
    <section class="content mt-4">
        <div class="container-fluid">
            <!-- Form Section -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>Modificar rol</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('roles.update', $rol->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        id="nombre" name="nombre" value="{{ $rol->name }}"
                                        placeholder="Nombre del rol">
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Sección para los permisos -->
                                <div class="form-group">
                                    <label>Permisos</label>
                                    @foreach ($permisos as $permiso)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="permiso_{{ $permiso->id }}"
                                                name="permisos[]" value="{{ $permiso->id }}"
                                                {{ $rol->permissions->pluck('id')->contains($permiso->id) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="permiso_{{ $permiso->id }}">{{ $permiso->description }}</label>
                                        </div>
                                    @endforeach
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
    <script></script>
@stop
