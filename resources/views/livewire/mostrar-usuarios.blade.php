<div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between ">
                        <div>
                            <h3 class="card-title">Usuarios</h3>
                        </div>
                        <div>
                            @can('usuarios.create')
                                <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Nuevo Usuario</a>
                            @endcan

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="usuarios">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        {{--  <th>Rol</th> --}}
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Incorporación</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->id }}</td>
                                            {{--  <td>{{ $usuario->rol->name }}</td> --}}
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>{{ $usuario->created_at->diffForHumans() }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $usuario->estado === '1' ? 'success' : 'danger' }}">
                                                    {{ $usuario->estado === '1' ? 'Activo' : 'Inactivo' }}
                                                </span>
                                            </td>
                                            <td class="d-flex align-items-center">
                                                
                                                @can('usuarios.edit')
                                                    <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                                        class="btn btn-warning btn-sm mr-1"><i class="fas fa-pen"></i></a>
                                                @endcan
                                                @can('usuarios.destroy')
                                                <form id="deleteForm-{{ $usuario->id }}"
                                                    action="{{ route('usuarios.destroy', $usuario->id) }}"
                                                    method="post" class="mb-0">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-outline-{{ $usuario->estado === '1' ? 'danger' : 'success' }} btn-sm delete-button"
                                                        data-id="{{ $usuario->id }}"
                                                        data-estado="{{ $usuario->estado }}"><i
                                                            class="fas {{ $usuario->estado === '1' ? 'fa-trash-alt' : 'fa-check' }}"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
