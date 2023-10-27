<div>
    @if (session()->has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('mensaje') }}
        </div>
    @endif
    <form wire:submit.prevent="crearProveedor" novalidate>
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                id="nombre" wire:model='nombre' placeholder="Nombre del proveedor"
                value="{{ old('nombre') }}">
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="representante">Representante</label>
            <input type="text" class="form-control @error('representante') is-invalid @enderror"
                id="representante" wire:model="representante" placeholder="Nombre del representante"
                value="{{ old('representante') }}">
            @error('representante')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                id="direccion" wire:model="direccion" placeholder="Dirección del proveedor"
                value="{{ old('direccion') }}">
            @error('direccion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                id="telefono" wire:model="telefono" placeholder="Teléfono de contacto"
                value="{{ old('telefono') }}">
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                id="email" wire:model="email" placeholder="email electrónico"
                value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
            <div
                class="col-md-6 offset-md-6 d-flex flex-md-row flex-column justify-content-between">
                <button type="submit"
                    class="btn btn-success mb-2 mb-md-0 flex-fill mx-1">Guardar</button>
                <button type="reset" class="btn btn-secondary flex-fill mx-1">Cancelar</button>
            </div>
        </div>
    </form>
</div>
