<div>
    <div class="input-group w-100">
        <input type="text" class="form-control @error('producto') is-invalid @enderror" id="producto"
            wire:model='buscar' wire:keydown.enter.prevent="$emit('scan-code', $('#code').val())"
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            livewire.on('scan-code', action => {
                $('#code').val('');
            })
        })
    </script>
</div>
