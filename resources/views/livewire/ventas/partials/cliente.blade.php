<div class="row">
    <div class="col-sm-12">
        <div class="connect-sorting">
            <h5 class="text-center mb-3">DATOS DEL CLIENTE</h5>
            <div class="connect-sorting-content">
                <div class="card simple-title-task ui-sortable-handle">
                    <div class="card-body">
                        <div class="task-header">
                            <div class="form-group">
                                 <!-- Botón para registrar un nuevo cliente -->
                                <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#nuevoClienteModal">
                                    <i class="fas fa-user-plus"></i> Registrar Nuevo Cliente
                                </button><br><br>
                                <label for="nit">NIT del Cliente:</label>
                                <div class="input-group">
                                    <input wire:keydown.enter.prevent='buscarCliente' type="text"
                                        class="form-control @error('nit') is-invalid @enderror" id="nit"
                                        wire:model='nit' placeholder="Ingrese el NIT del Cliente"
                                        @if ($venta_sin_datos) readonly @endif>
                                    @error('nit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" type="button" wire:click='buscarCliente'>
                                            <i class="fas fa-search"></i> Buscar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="razon-social">Razón Social del Cliente:</label>
                                <input type="text" class="form-control @error('razon_social') is-invalid @enderror"
                                    id="razon-social" placeholder="Razón Social del Cliente" value="{{ $razon_social }}"
                                    readonly>
                                @error('razon_social')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="venta_sin_datos">Venta sin datos:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="venta_sin_datos"
                                        wire:model="venta_sin_datos">
                                    <label class="form-check-label" for="venta_sin_datos">Marcar si es una venta sin datos</label>
                                </div>
                            </div>
                            @if (session()->has('mensaje'))
                                <div class="alert btn-dark alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    {{ session('mensaje') }}
                                </div>
                            @endif
                    
                           
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para crear clientes --}}
    <div class="modal fade" id="nuevoClienteModal" tabindex="-1" role="dialog"
        aria-labelledby="nuevoClienteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevoClienteModalLabel">Registrar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Aca vamos a llamar al componente livewire para registrar un nuevo cliente --}}
                    <livewire:crear-cliente />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
