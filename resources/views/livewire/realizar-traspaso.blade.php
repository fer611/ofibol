<div class="container-fluid rounded p-4">
    <form wire:submit.prevent="realizarTraspaso" novalidate>
        <div class="form-group">


            <label for="cantidad">Cantidad a Transferir</label>
            <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad"
                placeholder="Ingrese la cantidad" wire:model="cantidad">
            @error('cantidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="origen">Sucursal de Origen</label>
            <select class="form-control @error('origen') is-invalid @enderror" id="origen" wire:model="origen">
                <option value="">-- Seleccione --</option>
                @foreach ($almacenes as $almacen)
                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                @endforeach
            </select>
            @error('origen')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="destino">Sucursal de Destino</label>
            <select class="form-control @error('destino') is-invalid @enderror" id="destino" wire:model="destino">
                <option value="">-- Seleccione --</option>
                @foreach ($almacenes as $almacen)
                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                @endforeach
            </select>
            @error('destino')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Realizar Traspaso</button>
        </div>
    </form>
</div>
