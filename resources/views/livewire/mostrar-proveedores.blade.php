<div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-center">LISTADO DE PROVEEDORES</h6>
                        <div class="mb-3">
                            <button type="button" class="btn btn-dark " data-toggle="modal"
                                    data-target="#nuevoProveedorModal">
                                    <i class="fas fa-user-plus"></i> Registrar Nuevo Proveedor
                                </button>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="proveedores">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Representante</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proveedores as $proveedor)
                                        <tr>
                                            <td>{{ $proveedor->id }}</td>
                                            <td>{{ $proveedor->nombre }}</td>
                                            <td>{{ $proveedor->representante }}</td>
                                            <td>{{ $proveedor->direccion }}</td>
                                            <td>{{ $proveedor->telefono }}</td>
                                            <td>{{ $proveedor->correo }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $proveedor->estado === '1' ? 'success' : 'danger' }}">
                                                    {{ $proveedor->estado === '1' ? 'Activo' : 'Inactivo' }}
                                                </span>
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <a href="{{ route('proveedores.edit', $proveedor->id) }}"
                                                    class="btn btn-warning btn-sm mr-1"><i class="fas fa-pen"></i></a>

                                                <form id="deleteForm-{{ $proveedor->id }}"
                                                    action="{{ route('proveedores.destroy', $proveedor->id) }}"
                                                    method="post" class="mb-0">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-outline-{{ $proveedor->estado === '1' ? 'danger' : 'success' }} btn-sm delete-button"
                                                        data-id="{{ $proveedor->id }}"
                                                        data-estado="{{ $proveedor->estado }}"><i
                                                            class="fas {{ $proveedor->estado === '1' ? 'fa-trash-alt' : 'fa-check' }}"></i>
                                                    </button>
                                                </form>
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

    {{-- Modal para crear clientes --}}
    <div class="modal fade" id="nuevoProveedorModal" tabindex="-1" role="dialog"
        aria-labelledby="nuevoProveedorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevoProveedorModalLabel">Registrar Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Aca vamos a llamar al componente livewire para registrar un nuevo cliente --}}
                    <livewire:crear-proveedor />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
