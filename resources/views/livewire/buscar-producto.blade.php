<div>
    <form>
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
                        <button class="btn btn-dark" type="button" wire:click='buscarProducto()'>
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group w-100">
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#nuevoClienteModal">
                        <i class="fas fa-user-plus"></i> Registrar Nuevo Producto
                    </button>
                </div>
            </div>
        </div>
    </form><br>
    <div class="table">
        <table class="table">
            <thead class="bg-dark">
                <tr>
                    <th>Imagen</th>
                    <th>Descripcion</th>
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
                        <td colspan="3" class="text-center">No hay resultados para la busqueda: {{ $buscar }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
