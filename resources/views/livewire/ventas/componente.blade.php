<div>
    <style></style>
    <div class="row">
        <div class="col-sm-12 col-md-8">
            {{-- BUSCADOR --}}
            <h5>Seleccione el producto</h5>
            <div class="input-group w-100">
                <input type="text" class="form-control @error('producto') is-invalid @enderror" id="producto"
                    wire:model='buscar' wire:keydown.enter.prevent="agregarProducto"
                    placeholder="Ingrese el nombre del producto o codigo de barras">
                @error('producto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="input-group-append">
                    <button class="btn btn-dark" type="button">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </div>
            {{-- El buscador --}}
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
            {{-- DETALLES --}}
            @include('livewire.ventas.partials.detalles')
        </div>
        <div class="col-sm-12 col-md-4">
            {{-- CLIENTE --}}
            @include('livewire.ventas.partials.cliente')
            {{-- TOTAL  --}}
            @include('livewire.ventas.partials.total')

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('dist/js/keypress.js') }}"></script>
    <script src="{{ asset('dist/js/onscan.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.nicescroll.min.js') }}"></script>
    {{-- Notificacion superior derecha --}}
    <link rel="stylesheet" href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}">
    <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
    @include('livewire.ventas.scripts.shortcuts')
    @include('livewire.ventas.scripts.events')
    @include('livewire.ventas.scripts.general')
    @include('livewire.ventas.scripts.scan')
    <style>
        .alert-container {
            position: fixed;
            top: 20px;
            /* Ajusta la distancia desde la parte superior según tus necesidades */
            right: 20px;
            /* Ajusta la distancia desde la derecha según tus necesidades */
            z-index: 9999;
            /* Asegura que esté por encima del contenido */
            width: 300px;
            /* Ajusta el ancho según tus necesidades */
        }

        .custom-alert {
            background-color: #3B3F5C;
            color: #fff;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //eventos
            Livewire.on('show-modal', Msg => {
                $('#detallesStockModal').modal('show');
            });
        });
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</div>
