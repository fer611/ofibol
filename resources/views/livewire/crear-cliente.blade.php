<div class="container-fluid rounded p-4">
    <form wire:submit.prevent="crearCliente" novalidate>
        <div class="row">
            <div class="col-lg-12">
                <!-- razon_social del cliente -->
                <div class="form-group">
                    <label for="razon_social">Razon Social</label>
                    <input type="text" class="form-control @error('razon_social') is-invalid @enderror"
                        id="razon_social" wire:model="razon_social" placeholder="Ingrese la razon social o nombre completo del cliente">
                    @error('razon_social')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- NIT -->
                <div class="form-group">
                    <label for="nit">Nit</label>
                    <input type="number" class="form-control @error('nit') is-invalid @enderror" id="nit"
                        wire:model="nit" placeholder="Ingrese el Nit o Ci del cliente">
                    @error('nit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Telefono -->
                <div class="form-group">
                    <label for="telefono">Celular</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+591</span>
                        </div>
                        <input type="number" class="form-control @error('telefono') is-invalid @enderror"
                            id="telefono" wire:model="telefono" placeholder="Opcional">
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Porcentaje de Margen -->
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        wire:model="email" placeholder="Opcional">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Cantidad por Unidad de Medida -->
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion"
                        wire:model="direccion" placeholder="Opcional">
                    @error('direccion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <!-- Botón de envío -->
        <button type="submit" class="btn btn-primary w-100">Guardar</button>
    </form>
</div>
