<div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <!-- Botón para abrir el modal -->
                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoIngresoModal">
                            Nuevo Ingreso
                        </button> --}}

                        <a href="{{ route('ingresos.create') }}" class="btn" style="background: #3B3F5C; color:white">
                            <li class="fa fa-plus"></li> Registrar Ingreso
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="ingresos">
                                <thead class="">
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Items</th>
                                        <th>Usuario</th>
                                        <th>Proveedor</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Aquí debes iterar sobre los registros de ingresos -->
                                    @foreach ($ingresos as $ingreso)
                                        <tr>
                                            <td>{{ $ingreso->id }}</td>
                                            <td>{{ $ingreso->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $ingreso->total }}</td>
                                            <td>{{ $ingreso->items}}</td>
                                            <td>{{ $ingreso->user->name}}</td>
                                            <td>{{ $ingreso->proveedor->nombre }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $ingreso->estado === 'Pendiente' ? 'warning' : 'success' }}">
                                                    {{ $ingreso->estado }}
                                                </span>
                                            </td>
                                            <td class="d-flex align-items-center ">
                                                <a href="{{ route('ingresos.pdf', $ingreso) }}"
                                                    class="btn btn-outline-danger  btn-sm mr-1"><i
                                                        class="fas fa-file-pdf"></i> PDF</a>

                                                {{-- Eliminar --}}
                                                {{-- <button type="button"
                                                    class="btn btn-outline-danger btn-sm delete-button"
                                                    wire:click="$emit('mostrarAlerta',{{ $venta->id }})"><i
                                                        class="fas fa-trash-alt"></i>
                                                </button> --}}
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
    <!-- Modal para crear ingresos -->
    <div class="modal fade" id="nuevoIngresoModal" tabindex="-1" role="dialog"
        aria-labelledby="nuevoIngresoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevoIngresoModalLabel">Nuevo Ingreso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí puedes incluir el formulario para crear ingresos -->
                    <!-- Por ejemplo, Livewire: -->
                    {{-- <livewire:crear-ingreso /> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
