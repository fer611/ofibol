<div>
    
        <div class="row">
            <div class="col-md-8">
                <div class="input-group w-100">
                    <input type="text"
                        class="form-control @error('producto') is-invalid @enderror" id="producto" wire:model='buscar'
                        placeholder="Ingrese el producto">
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="button" >
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
        </div><br>
    <div class="table-responsive" style="max-height: 200px;">
        <table class="table table-hover table-striped">
            <thead class="bg-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if ($productos && $productos->count() > 0)
                    @foreach ($productos as $producto)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/productos/' . $producto->imagen) }}" alt="imagen" width="40px">
                            </td>
                            <td>{{ $producto->descripcion }}</td>
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
