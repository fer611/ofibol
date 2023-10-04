<div>
    <form wire:submit.prevent="agregarProducto">
        <div class="form-group">
            <label for="producto">Producto</label>
            <input wire:model="producto" type="text" class="form-control">
        </div>
        <!-- Otros campos como cantidad, precio de compra, precio de venta, etc. -->

        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>

    <ul>
        @foreach ($detalles as $index => $detalle)
            <li>
                {{ $detalle['producto'] }} - Cantidad: {{ $detalle['cantidad'] }}
                <button wire:click="eliminarProducto({{ $index }})">Eliminar</button>
            </li>
        @endforeach
    </ul>
</div>
