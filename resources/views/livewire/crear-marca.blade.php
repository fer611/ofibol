<div class="container-fluid rounded p-4">
    <form wire:submit.prevent="crearMarca" novalidate>
        <div class="row">
            <div class="col-lg-6">
                <!-- Nombre de la Marca -->
                <div class="form-group">
                    <label for="nombre">Nombre de la Marca</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                        wire:model="nombre" placeholder="Ingrese el nombre de la marca">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <!-- Botones de envío y limpieza en la misma fila -->
        <div class="row mt-2">
            <div class="col-lg-6">
                <button type="reset" class="btn btn-secondary w-100">Limpiar</button>
            </div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary w-100">Guardar</button>
            </div>
        </div>
    </form>
</div>
