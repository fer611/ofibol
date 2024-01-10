<div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <!-- Botón para abrir el modal -->
                        @can('clientes.create')
                            <button type="button" class="btn" style="background: #3B3F5C; color:white" data-toggle="modal"
                                data-target="#nuevoClienteModal">
                                <li class="fa fa-plus"></li> Registrar Factura
                            </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- <div class="table-responsive" style="max-height:500px; overflow-x:auto;"> --}}
                            <table class="table table-bordered table-striped" id="facturas">
                                <thead class="">
                                    <tr>
                                        <th>Id</th>
                                        <th>Fecha Emisión</th>
                                        <th>Razon Social</th>
                                        <th>Nit</th>
                                        <th>Nro. Factura</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>División</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facturas as $factura)
                                        <tr>
                                            <td>{{ $factura->id }}</td>
                                            <td>{{ $factura->fecha !=null ? \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') : '' }}</td>
                                            <td>{{ $factura->cliente->razon_social }}</td>
                                            <td>{{ $factura->cliente->nit }}</td>
                                            <td>{{ $factura->numero_factura }}</td>
                                            <td>{{ $factura->total }}</td>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ in_array($factura->estado, ['Pagado', 'Venta al contado']) ? 'success' : 'warning' }}">
                                                    {{ $factura->estado }}
                                                </span>
                                            </td>
                                            <td>{{ $factura->categoria }}</td>
                                            <td class="d-flex align-items-center ">
                                                <!-- Mostrar nota -->
                                                <button type="button" wire:click.prevent="getNota({{ $factura->id }})"
                                                    style="background: #3B3F5C; color:white"
                                                    class="btn btn-info btn-sm mr-1 mb-1 show-note-button"
                                                    data-toggle="modal" data-target="#notaModal{{ $factura->id }}">
                                                    <i class="fas fa-sticky-note"></i>
                                                </button>
                                                @can('usuarios.edit')
                                                    {{-- Editar --}}
                                                    <a class="btn btn-warning btn-sm mr-1 mb-1 edit-button"
                                                        href="{{ route('facturas.edit', $factura->id) }}"><i
                                                            class="fas fa-pen"></i></a>
                                                    {{-- Eliminar --}}
                                                    </button>
                                                @endcan
                                                @can('usuarios.destroy')
                                                    <button type="button"
                                                        wire:click="$emit('alertaEliminar',{{ $factura->id }})"
                                                        class="btn btn-outline-danger btn-sm delete-button"><i
                                                            class="fas fa-trash-alt"></i>
                                                    </button>
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
    </section>
    {{-- Modal para crear facturas --}}
    <div class="modal fade" id="nuevoClienteModal" tabindex="-1" role="dialog"
        aria-labelledby="nuevoClienteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevoClienteModalLabel">Registrar Factura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Aca vamos a llamar al componente livewire para registrar un nuevo cliente --}}
                    <livewire:crear-factura />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para mostrar la nota de la factura -->
    <div class="modal fade" id="notaModal" tabindex="-1" role="dialog" aria-labelledby="notaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <!-- Contenido del modal -->
                <div class="modal-header text-white" style="background: #3B3F5C; color:white">
                    <h5 class="modal-title" id="detallesStockModalLabel">
                        Nota de la factura -
                        {{ $id_factura == null ? 'Factura no cargada' : $id_factura }}

                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Iterar sobre las cantidades por sucursal -->
                    <div class="row">
                        <div class="col-12">
                            <p>{{ $facturaNota }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
