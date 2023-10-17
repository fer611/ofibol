<div>
    <style></style>
    <div class="row">
        <div class="col-sm-12 col-md-8">
            {{-- BUSCADOR --}}
            <h5>Seleccione el producto</h5>
            <livewire:search-controller />
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
</div>
