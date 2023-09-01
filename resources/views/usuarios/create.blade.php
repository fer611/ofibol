@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')

    <!-- Main content -->
    <section class="content mt-4">
        <div class="container-fluid">
            <!-- Form Section -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>Crear Nuevo Usuario</h4>
                        </div>
                        <div class="card-body">
                            <form action=" {{ route('usuarios.store') }} " method="post" novalidate>
                                @csrf
                                <div class="form-group">
                                    <label for="rol">Rol</label>
                                    <select class="form-control @error('rol_id') is-invalid @enderror" id="rol"
                                        name="rol_id">
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->id }}"
                                                {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                                                {{ $rol->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('rol_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Nombre del usuario"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Email del usuario"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Contraseña">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="Repite la Contraseña">
                                    @error('password_confirmation')
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
