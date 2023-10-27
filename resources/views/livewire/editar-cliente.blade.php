<div class="container-fluid rounded p-4">
    <form wire:submit.prevent="editarCliente" novalidate>
        <div class="row">
            <!-- Razon Social -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="razon_social">Razón Social</label>
                    <input type="text" class="form-control @error('razon_social') is-invalid @enderror"
                        id="razon_social" wire:model="razon_social" placeholder="Ingrese la Razón Social">
                    @error('razon_social')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- NIT -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="nit">NIT</label>
                    <input type="text" class="form-control @error('nit') is-invalid @enderror" id="nit"
                        wire:model="nit" placeholder="Ingrese el NIT">
                    @error('nit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Teléfono -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                        wire:model="telefono" placeholder="Ingrese el Teléfono">
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Dirección -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion"
                        wire:model="direccion" placeholder="Ingrese la Dirección">
                    @error('direccion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        wire:model="email" placeholder="Ingrese el Email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Botón de envío -->
        <button type="submit" class="btn btn-dark w-100">Guardar Cambios</button>
    </form>
</div>