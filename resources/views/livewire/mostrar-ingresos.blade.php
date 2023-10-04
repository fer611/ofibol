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

                        <a href="{{ route('ingresos.create') }}" class="btn btn-primary">
                            Registrar Ingreso
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="ingresos">
                                <thead class="">
                                    <tr>
                                        <th>ID</th>
                                        <th>Recepcion</th>
                                        <th>Proveedor</th>
                                        <th>Comprobante</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Aquí debes iterar sobre los registros de ingresos -->
                                    @foreach ($ingresos as $ingreso)
                                        <tr>
                                            <td>{{ $ingreso->id }}</td>
                                            <td>{{ $ingreso->user_name }}</td>
                                            <td>{{ $ingreso->proveedor_nombre }}</td>
                                            <td>{{ $ingreso->tipo_comprobante . ': ' . $ingreso->numero_comprobante }}</td>
                                            <td>{{ number_format($ingreso->totalIngreso, 2, '.', '') }} Bs.</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $ingreso->estado === 'Pendiente' ? 'warning' : 'success' }}">
                                                    {{ $ingreso->estado }}
                                                </span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($ingreso->created_at)->format('d/m/Y') }}</td>
                                            <td class="d-flex align-items-center">
                                                <!-- ver, editar o eliminar -->
                                                <a href="{{ route('ingresos.show', $ingreso->id) }}"
                                                    class="btn btn-outline-primary  btn-sm mr-1"><i
                                                        class="fas fa-eye"></i></a>
                                                <a class="btn btn-warning btn-sm mr-1 mb-1 edit-button"
                                                    href="{{ route('ingresos.edit', $ingreso->id) }}"><i
                                                        class="fas fa-pen"></i></a>
                                                <button type="button"
                                                    class="btn btn-outline-{{ $ingreso->estado === '1' ? 'danger' : 'success' }} btn-sm delete-button"
                                                    data-id="{{ $ingreso->id }}"
                                                    data-estado="{{ $ingreso->estado }}"><i
                                                        class="fas {{ $ingreso->estado === '1' ? 'fa-trash-alt' : 'fa-check' }}"></i></button>
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
