<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="text-center mb-3">
               
            </div>
            <div class="connect-sorting-content">
                <div class="card mb-3">
                    <div class="card-header bg-dark"><h6>DATOS DEL INGRESO</h6></div>
                    <div class="card-body">
                        <div class="task-header">
                            <div class="form-group">
                                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#nuevoClienteModal">
                                    <i class="fas fa-user-plus"></i> Registrar Nuevo
                                </button>
                            </div>
                            <div class="form-group">
                                <select class="form-control @error('proveedor') is-invalid @enderror" id="proveedor" wire:model="proveedor" @if ($venta_sin_datos) disabled @endif>
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('proveedor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="venta_sin_datos">Ingreso sin datos:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="venta_sin_datos" wire:model="venta_sin_datos">
                                    <label class="form-check-label" for="venta_sin_datos">Marcar si es un ingreso sin datos</label>
                                </div>
                            </div>
                            @if (session()->has('mensaje'))
                                <div class="alert alert-dark alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    {{ session('mensaje') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="almacen">Seleccione el Almacén de Ingreso</label>
                            <select class="form-control @error('almacen') is-invalid @enderror" id="almacen" wire:model="almacen">
                                <option value="">Seleccione un almacén</option>
                                @foreach ($almacenes as $almacen)
                                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                                @endforeach
                            </select>
                            @error('almacen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear clientes -->
<div class="modal fade" id="nuevoClienteModal" tabindex="-1" role="dialog" aria-labelledby="nuevoClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoClienteModalLabel">Registrar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aquí llamamos al componente Livewire para registrar un nuevo cliente -->
                <livewire:crear-proveedor />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
