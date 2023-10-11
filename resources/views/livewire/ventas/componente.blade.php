<div>
    <style></style>
    <div class="row">
        <div class="col-sm-12 col-md-8">
            @if (session()->has('mensaje'))
                <div id="myAlert" class="alert-container">
                    <div class="alert alert-primary alert-dismissible fade show text-center custom-alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('mensaje') }}
                    </div>
                </div>
                <script>
                    // Desaparecer el alert después de 3 segundos
                    setTimeout(function() {
                        $('#myAlert').alert('close');
                    }, 3000);
                </script>
            @endif
            <livewire:search-controller />
            {{-- DETALLES --}}
            @include('livewire.ventas.partials.detalles')
        </div>
        <div class="col-sm-12 col-md-4">
            {{-- TOTAL  --}}
            @include('livewire.ventas.partials.total')

            {{-- DENOMINACIONES --}}
            @include('livewire.ventas.partials.monedas')
        </div>
    </div>
    <script></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('dist/js/keypress.js') }}"></script>
    <script src="{{ asset('dist/js/onscan.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.nicescroll.min.js') }}"></script>
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
