@extends('adminlte::page')

@section('title', 'Productos')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">LISTADO DE CATEGORIAS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Categorias</li>
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
                            <form action=" {{ route('categorias.index') }}" method="get">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group mb-6">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="bi bi-search"></i></span>
                                            <input type="text" class="form-control" name="texto"
                                                placeholder="Buscar categorías" value=""
                                                aria-label="Recipient's username" aria-describedby="button-addon2">
                                            <button class="btn btn-outline-secondary" type="submit"
                                                id="button-addon2">Buscar</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group mb-6">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="bi bi-plus-circle-fill"></i></span>
                                            <a href="{{ route('categorias.create') }}" class="btn btn-success">Nueva</a>
                                            {{-- <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#createCategoriaModal">Nueva</button>   Esto para modal --}}

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
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $categoria)
                                        <tr>
                                            <td>{{ $categoria->id }}</td>
                                            <td>{{ $categoria->nombre }}</td>
                                            <td>{{ $categoria->descripcion }}</td>
                                            <td class="d-flex align-items-center">
                                                <a href="{{ route('categorias.edit', $categoria->id) }}"
                                                    class="btn btn-warning btn-sm mr-1"><i class="fas fa-pen"></i></a>

                                                <form id="deleteForm-{{ $categoria->id }}"
                                                    action="{{ route('categorias.destroy', $categoria->id) }}"
                                                    method="post" class="mb-0">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm delete-button"
                                                        data-id="{{ $categoria->id }}"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $categorias->links('pagination::bootstrap-4') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para crear categoria -->
        {{-- <!-- Modal para crear categoria -->
        <div class="modal fade" id="createCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear nueva categoría</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('categorias.store') }}" method="post" novalidate>
                        <div class="modal-body">
                            @csrf
                            <div class="mb-4">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                    id="nombre" name="nombre" value="{{ old('nombre') }}">
                                @error('nombre')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
                                    id="descripcion" name="descripcion" value="{{ old('descripcion') }}">
                                @error('descripcion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

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
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar!'
                    }).then((result) => {
                        /* if (result.isConfirmed) {
                            document.getElementById(`deleteForm-${id}`).submit();
                            Swal.fire(
                                'Eliminado!',
                                'La categoría ha sido eliminada.',
                                'success'
                            )
                        } */
                        if (result.isConfirmed) {
                            sessionStorage.setItem('deleted', 'true');
                            document.getElementById(`deleteForm-${id}`).submit();
                        }
                    })
                });
            });
            
            // Verificar si se debe mostrar el segundo SweetAlert
            if (sessionStorage.getItem('deleted') === 'true') {
                Swal.fire(
                    'Eliminado!',
                    'La categoría ha sido eliminada.',
                    'success'
                );
                sessionStorage.removeItem('deleted'); // Limpiar la variable para futuras recargas
            }
        });

    </script>


@stop
