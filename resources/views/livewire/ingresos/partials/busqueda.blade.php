<div>

    <div class="row">
        <div class="col-md-8">
            <div class="input-group w-100">
                <input type="text" class="form-control @error('producto') is-invalid @enderror" id="producto"
                    wire:model='buscar' wire:keydown.enter.prevent='agregarProducto' placeholder="Ingrese el producto">
                @error('producto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="input-group-append">
                    <button class="btn btn-dark" type="button">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group w-100">
                <button type="button" class="btn" style="background: #3B3F5C; color:white" data-toggle="modal"
                    data-target="#nuevoProductoModal">
                    <li class="fa fa-plus"></li> Nuevo Producto
                </button>
            </div>
        </div>
    </div>
    {{-- <ul class="list-group">
        @if ($productos && $productos->count() > 0)
            <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-2">
                            <p>Imagen</p>
                        </div>
                        <div class="col-md-4">
                            <p>Descripcion</p>
                        </div>
                    </div>
            </li>
            @foreach ($productos as $producto)
                <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ asset('storage/productos/' . $producto->imagen) }}" alt="imagen"
                                    width="40px">
                            </div>
                            <div class="col-md-4">
                                <p>{{ $producto->descripcion }}</p>
                            </div>
                        </div>
                </li>
            @endforeach
        @else
            <p>No hay resultados para la búsqueda: {{ $buscar }}</p>
        @endif
    </ul> --}}


    <div class="table-responsive" style="max-height: 200px;">
        <table class="table table-hover table-striped">
            <thead class="bg-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Marca</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if ($productos && $productos->count() > 0)
                    @foreach ($productos as $producto)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/productos/' . $producto->imagen) }}" alt="imagen" width="40px" wire:click="agregarProducto({{ $producto->id }})">
                            </td>
                            <td>{{ $producto->marca->nombre }}</td>
                            <td wire:click="agregarProducto({{ $producto->id }})">{{ $producto->descripcion }}</td>
                            <td>
                                <button class="btn btn-dark" wire:click="agregarProducto({{ $producto->id }})">
                                    Agregar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center">No hay resultados para la búsqueda: {{ $buscar }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Modal para crear productos --}}
    <div class="modal fade" id="nuevoProductoModal" tabindex="-1" role="dialog"
        aria-labelledby="nuevoProductoModalLabel" aria-hidden="true">
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
