<div class="container-fluid rounded p-4">
    @if (session()->has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('mensaje') }}
        </div>
    @endif
    <form wire:submit.prevent="crearFactura" novalidate>
        <div class="row">

            <div class="col-lg-6">

                <!-- Seleccionar Cliente -->
                {{-- <div class="form-group">
                    <label for="cliente">Cliente</label>
                    <select class="form-control @error('cliente') is-invalid @enderror" id="cliente" wire:model="cliente">
                        <option value="">-- Seleccione --</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                        @endforeach
                    </select>
                    @error('cliente')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div class="form-group">
                    <label for="nit">NIT</label>
                    <input type="text" class="form-control @error('nit') is-invalid @enderror" id="nit"
                        wire:model="nit" placeholder="Ingrese el NIT/CI del cliente">
                    @error('nit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="razon_social">RAZON SOCIAL</label>
                    <input type="text" class="form-control @error('razon_social') is-invalid @enderror"
                        id="razon_social" wire:model="razon_social" placeholder="Ingrese la razon social del cliente">
                    @error('razon_social')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Script para que cargue select2 en el input cliente --}}
                {{-- <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        $('#cliente').select2()  //Inicializar
                        //capturamos valores cuando cambia evento
                    })
                </script> --}}

                <!-- Seleccionar Categoria -->
                <div class="form-group">
                    <label for="categoria">División</label>
                    <select class="form-control @error('categoria') is-invalid @enderror" id="categoria"
                        wire:model="categoria">
                        <option value="">-- Seleccione --</option>
                        <option value="Material De Escritorio" selected>Material De Escritorio</option>
                        <option value="Material De Limpieza">Material De Limpieza</option>
                    </select>
                    @error('categoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Numero de la factura a registrar -->
                <div class="form-group">
                    <label for="numero_factura">NRO. FACTURA</label>
                    <input type="text" class="form-control @error('numero_factura') is-invalid @enderror"
                        id="numero_factura" wire:model="numero_factura" placeholder="Ingrese el número de la factura">
                    @error('numero_factura')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Fecha -->
                <div class="form-group">
                    <label for="fecha">Fecha de Emisión</label>
                    <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha"
                        wire:model="fecha" placeholder="Fecha de emisión de la factura">
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Total -->
                <div class="form-group">
                    <label for="total">total</label>
                    <input type="number" class="form-control @error('total') is-invalid @enderror" id="total"
                        wire:model="total" placeholder="Ingrese el total Bs. de la factura">
                    @error('total')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Estado -->
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-control @error('estado') is-invalid @enderror" id="estado"
                        wire:model="estado">
                        <option value="">-- Seleccione --</option>
                        <option value="Pagado" selected>Pagado</option>
                        <option value="Por Cobrar">Por cobrar</option>
                        <option value="Pago al Contado">Pago al contado</option>
                        <option value="Anulado">Anulado</option>
                    </select>

                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nota -->
                <div class="form-group">
                    <label for="nota">Nota</label>
                    <textarea class="form-control @error('nota') is-invalid @enderror" id="nota" wire:model="nota"></textarea>
                    <small class="text-muted">Máximo 255 caracteres</small>
                    @error('nota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
        </div>

        <!-- Botón de envío -->
        <button type="submit" class="btn btn-dark w-100">Guardar Cambios</button>
    </form>
</div>
