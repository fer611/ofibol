<div class="container-fluid rounded p-4">
    <form wire:submit.prevent='editarFactura'>
        <div class="form-group">
            <label for="cliente">CLIENTE</label>
            <select class="form-control" id="cliente" wire:model='cliente'>
                <option value="">-- Seleccione una opcion --</option>
                @foreach ($clientes as $cliente)
                    <option  value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                @endforeach
            </select>
        </div>

        <input type="text" value='{{ $salida }}' class="form-control" disabled>
        <input type="submit" class="btn btn-primary" value="Guardar">
    </form>
</div>
