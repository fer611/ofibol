<div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoProductoModal">
                            Nuevo Producto
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="productos">
                                <thead class="">
                                    <tr>
                                        <th>Id</th>
                                        <th>Categoria</th>
                                        <th>Marca</th>
                                        <th>Origen</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Unidad Medida</th>
                                        <th>Cantidad Cja/pqte</th>
                                        <th>Precio Compra</th>
                                        <th>Margen</th>
                                        <th>Precio_venta</th>
                                        <th>Imagen</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->id }}</td>
                                            <td>{{ $producto->categoria->nombre }}</td>
                                            <td>{{ $producto->marca->nombre }}</td>
                                            <td>{{ $producto->origen->nombre }}</td>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->descripcion }}</td>
                                            <td>{{ $producto->unidad_medida }}</td>
                                            <td>{{ $producto->cantidad_unidad }}</td>
                                            <td>{{ $producto->costo_actual }}</td>
                                            <td>{{ $producto->porcentaje_margen }}</td>
                                            <td>{{ $producto->costo_actual + ($producto->costo_actual * $producto->porcentaje_margen / 100) }}</td>
                                            <td><img src="{{ asset('storage/productos/' . $producto->imagen) }}" alt="{{ 'Imagen producto ' . $producto->nombre }}" class="img-fluid w-60 img-thumbnail my-custom-img"></td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $producto->estado === '1' ? 'success' : 'danger' }}">
                                                    {{ $producto->estado === '1' ? 'Activo' : 'Inactivo' }}
                                                </span>
                                            </td>
                                            <td class="d-flex align-items-center ">
                                                <a href="{{ route('productos.edit', $producto->id) }}"
                                                    class="btn btn-warning btn-sm mr-1 mb-1"><i class="fas fa-pen"></i></a>
                                            
                                                <form id="deleteForm-{{ $producto->id }}"
                                                    action="{{ route('productos.destroy', $producto->id) }}" method="post"
                                                    class="mb-1">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-outline-{{ $producto->estado === '1' ? 'danger' : 'success' }} btn-sm delete-button"
                                                        data-id="{{ $producto->id }}"
                                                        data-estado="{{ $producto->estado }}"><i
                                                            class="fas {{ $producto->estado === '1' ? 'fa-trash-alt' : 'fa-check' }}"></i>
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
{{-- Modal para crear productos --}}
    <div class="modal fade" id="nuevoProductoModal" tabindex="-1" role="dialog" aria-labelledby="nuevoProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevoProductoModalLabel">Nuevo Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <livewire:crear-producto />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
