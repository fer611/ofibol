@extends('adminlte::page')

@section('title', 'Usuarios')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">LISTADO DE USUARIOS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if (session()->has('mensaje'))
        {{-- Si existe un mensaje --}}
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('mensaje') }}
        </div>
    @endif
    <!-- Hoverable rows start -->
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-xl-12">
                            <form action=" {{ route('usuarios.index') }}" method="get">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group mb-6">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="bi bi-search"></i></span>
                                            <input type="text" class="form-control" name="texto"
                                                placeholder="Buscar Usuario" value=""
                                                aria-label="Recipient's username" aria-describedby="button-addon2">
                                            <button class="btn btn-outline-secondary" type="submit"
                                                id="button-addon2">Buscar</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group mb-6">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="bi bi-plus-circle-fill"></i></span>
                                            <a href="{{ route('usuarios.create') }}" class="btn btn-success">Nuevo</a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        </div>
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Rol</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->id }}</td>
                                            <td>{{ $usuario->rol->name }}</td>
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $usuario->estado === '1' ? 'success' : 'danger' }}">
                                                    {{ $usuario->estado === '1' ? 'Activo' : 'Inactivo' }}
                                                </span>
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                                    class="btn btn-warning btn-sm mr-1"><i class="fas fa-pen"></i></a>

                                                <form id="deleteForm-{{ $usuario->id }}"
                                                    action="{{ route('usuarios.destroy', $usuario->id) }}" method="post"
                                                    class="mb-0">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-outline-{{ $usuario->estado === '1' ? 'danger' : 'success' }} btn-sm delete-button"
                                                        data-id="{{ $usuario->id }}"
                                                        data-estado="{{ $usuario->estado }}"><i
                                                            class="fas {{ $usuario->estado === '1' ? 'fa-trash-alt' : 'fa-check' }}"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $usuarios->links('pagination::bootstrap-4') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hoverable rows end -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(function(deleteButton) {
                deleteButton.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const estado = this.getAttribute('data-estado');
                    const texto = estado === '1' ?
                        '¿Estás seguro de que quieres desactivar este usuario?' :
                        '¿Quieres activar este usuario?';

                    Swal.fire({
                        title: texto,
                        text: "",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            sessionStorage.setItem('deleted', 'true');
                            sessionStorage.setItem('estado', estado);
                            document.getElementById(`deleteForm-${id}`).submit();
                        }
                    })
                });
            });

            // Verificar si se debe mostrar el segundo SweetAlert
            if (sessionStorage.getItem('deleted') === 'true') {
                const estado = sessionStorage.getItem('estado');
                let mensaje = '';
                if (estado === '1') {
                    mensaje = 'La cuenta del usuario está inactiva.';
                } else {
                    mensaje = 'La cuenta del usuario está activa.';
                }
                Swal.fire(
                    'Realizado!',
                    mensaje,
                    'success'
                );
                sessionStorage.removeItem('deleted'); // Limpiar la variable para futuras recargas
                sessionStorage.removeItem('estado'); // Limpiar la variable para futuras recargas
            }
        });
    </script>
@stop
