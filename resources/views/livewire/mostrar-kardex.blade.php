<div class="table-responsive">
    <table class="table table-bordered table-striped" id="kardex">
        <thead class="table text-white" style="background: #3B3F5C;">
            <tr>
                <th>Nº</th>
                <th>Fecha</th>
                <th>Descripcion</th>
                <th>Almacén</th>
                <th>Entradas</th>
                <th>Salidas</th>
                <th>Costo Unitario</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kardex as $key => $registro)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $registro->created_at->format('d/m/Y') }}</td>
                    <td>{{ $registro->producto->descripcion }}</td>
                    <td>{{ $registro->almacen->nombre }}</td>
                    <td>{{ $registro->entradas }}</td>
                    <td>{{ $registro->salidas }}</td>
                    <td class="text-right">Bs. {{ $registro->precio_producto }}</td>
                    <td class="text-right">Bs. {{ $registro->saldo }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            {{-- Totales --}}
            <tr>
                <th class="text-right" colspan="5">Stock:</th>
                <th class="text-right" colspan="1">{{ $stock }}</th>
                <th class="text-right">Bs. {{ $producto->costo_actual }}</th>
                <th class="text-right">Bs. {{ $saldoActual->saldo }}</th>
        </tfoot>
    </table>

    <style>
        #kardex tfoot {
            background-color: #3B3F5C;
            /* Color de fondo verde oscuro */
            color: white;
            /* Color de texto blanco */
            font-weight: bold;
            /* Texto en negrita */
        }
    </style>
</div>
