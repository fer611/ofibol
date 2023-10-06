<div>
    <style></style>
    <div class="row">
        <div class="col-sm-12 col-md-8">
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
    <script>

    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('dist/js/keypress.js') }}"></script>
    <script src="{{ asset('dist/js/onscan.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.nicescroll.min.js') }}"></script>
    @include('livewire.ventas.scripts.shortcuts')
    @include('livewire.ventas.scripts.events')
    @include('livewire.ventas.scripts.general')
    @include('livewire.ventas.scripts.scan')
</div>
