<div class="container mt-5">
    <div class="row">
        <!-- Imagen del producto -->
        <div class="col-md-6">
            <img src="{{ asset('storage/productos/' . $producto->imagen) }}"
                alt="{{ 'Imagen producto ' . $producto->nombre }}" class="img-fluid">
            <button type="button" class="btn btn-primary w-100 mt-4" data-toggle="modal" data-target="#traspasoModal">
                Realizar Traspaso
            </button>
        </div>

        <!-- Detalles del producto -->
        <div class="col-md-6">
            
            <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
            <p><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
            <p><strong>Unidad de Medida:</strong> {{ $producto->unidad_medida }}</p>
            <p><strong>Cantidad por Caja/Paquete:</strong> {{ $producto->cantidad_unidad }}</p>
            <p><strong>Costo Actual:</strong> {{ $producto->costo_actual }}</p>
            <p><strong>Porcentaje de Margen:</strong> {{ $producto->porcentaje_margen }}%</p>
            <p><strong>Precio de Venta:</strong>
                {{ $producto->costo_actual + ($producto->costo_actual * $producto->porcentaje_margen) / 100 }} (Bs.)</p>
            <p><strong>Stock Mínimo:</strong> {{ $producto->stock_minimo }}</p>
            <p><strong>Estado:</strong> {{ $producto->estado === '1' ? 'Activo' : 'Inactivo' }}</p>

            <!-- Stock en cada sucursal -->
            <h4>Stock en Sucursales</h4>
            <ul>
                @foreach ($stocks as $stock)
                    <li> <strong> {{ $stock->nombre }}: </strong> {{ $stock->stock }} unidades</li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- Modal Para realizar el traspaso-->
    <div class="modal fade" id="traspasoModal" tabindex="-1" role="dialog" aria-labelledby="traspasoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="traspasoModalLabel">Realizar Traspaso de Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="realizarTraspaso" novalidate>
                        <div class="form-group">
                            <label for="cantidad">Cantidad a Transferir</label>
                            <input type="number" class="form-control @error('cantidad') is-invalid @enderror"
                                id="cantidad" placeholder="Ingrese la cantidad" wire:model="cantidad">
                            @error('cantidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="origen">Sucursal de Origen</label>
                            <select class="form-control @error('origen') is-invalid @enderror" id="origen"
                                wire:model="origen">
                                <option value="">-- Seleccione --</option>
                                @foreach ($almacenes as $almacen)
                                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                                @endforeach
                            </select>
                            @error('origen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="destino">Sucursal de Destino</label>
                            <select class="form-control @error('destino') is-invalid @enderror" id="destino"
                                wire:model="destino">
                                <option value="">-- Seleccione --</option>
                                @foreach ($almacenes as $almacen)
                                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                                @endforeach
                            </select>
                            @error('destino')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Realizar Traspaso</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>


</div>
