<div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn" style="background: #3B3F5C; color:white" data-toggle="modal"
                            data-target="#nuevoProductoModal">
                            <li class="fa fa-plus"></li> Nuevo Producto
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="productos">
                                <thead style="background: #3B3F5C; color:white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Imagen</th>
                                        <th>Codigo de Barras</th>
                                        <th>Descripcion</th>
                                        <th>Stock</th>
                                        <th>Unidad Medida</th>
                                        <th>Fecha de Vencimiento</th>
                                        <th>Precio_venta</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->id }}</td>

                                            <td><img src="{{ asset('storage/productos/' . $producto->imagen) }}"
                                                    alt="{{ 'Imagen producto ' . $producto->nombre }}"
                                                    class="img-fluid w-60 img-thumbnail my-custom-img"></td>
                                            <td>{{ $producto->barcode }}</td>
                                            <td><a href="{{ route('productos.kardex', $producto) }}">
                                                    {{ $producto->descripcion }} </a></td>
                                            <td>{{ $producto->stock }}</td>
                                            <td>{{ $producto->unidad_medida }}</td>
                                            <td
                                                class="{{ $producto->fecha_vencimiento && now()->greaterThan($producto->fecha_vencimiento) ? 'bg-danger' : '' }}">
                                                @if ($producto->fecha_vencimiento)
                                                    {{ \Carbon\Carbon::parse($producto->fecha_vencimiento)->format('d/n/Y') }}
                                                @else
                                                    No Aplica
                                                @endif
                                            </td>
                                            <td>{{ $producto->precio_venta ? $producto->precio_venta : 0 }}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $producto->estado === '1' ? 'success' : 'danger' }}">
                                                    {{ $producto->estado === '1' ? 'Activo' : 'Inactivo' }}
                                                </span>
                                            </td>
                                            <td class="d-flex align-items-center ">
                                                <a href="{{ route('productos.show', $producto->id) }}"
                                                    class="btn btn-outline-primary  btn-sm mr-1"><i
                                                        class="fas fa-eye"></i></a>
                                                {{-- Editar --}}
                                                <a class="btn btn-warning btn-sm mr-1 mb-1 edit-button"
                                                    href="{{ route('productos.edit', $producto->id) }}"><i
                                                        class="fas fa-pen"></i></a>
                                                {{-- Eliminar --}}
                                                <button type="button"
                                                    wire:click="$emit('{{ $producto->estado === '1' ? 'alertaInactivar' : 'alertaActivar' }}',{{ $producto->id }})"
                                                    class="btn btn-outline-{{ $producto->estado === '1' ? 'danger' : 'success' }} btn-sm delete-button"><i
                                                        class="fas {{ $producto->estado === '1' ? 'fa-trash-alt' : 'fa-check' }}"></i>
                                                </button>
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
    <div>
        <div class="modal fade" id="nuevoProductoModal" tabindex="-1" role="dialog"
            aria-labelledby="nuevoProductoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nuevoProductoModalLabel">Nuevo Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- Aca el formulario --}}
                        <livewire:crear-producto />
                        {{-- Modal para crear productos --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .modal-md {
                max-width: 50%;
                /* Ajusta el tamaño medio deseado */
                width: auto;
            }
        </style>
    </div>
</div>
