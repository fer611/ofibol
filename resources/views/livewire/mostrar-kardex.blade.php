<div class="table-responsive">
    <table class="table table-bordered table-striped" id="kardex">
        <thead class="table text-white" style="background: #3B3F5C;">
            <tr>
                <th rowspan="2" class="text-center align-middle">Nº</th>
                <th rowspan="2" class="text-center align-middle">FECHA</th>
                <th rowspan="2" class="text-center align-middle">DETALLE</th>
                <th rowspan="2" class="text-center align-middle">ALMACEN</th>
                <th colspan="3" class="text-center">CANTIDADES</th>
                <th rowspan="2" class="text-center align-middle">COSTO</th>
                <th colspan="3" class="text-center align-middle">VALORES</th>
                {{-- <th rowspan="2" class="text-center align-middle">REF.</th> --}}
            </tr>
            <tr>
                <th>Entradas</th>
                <th>Salidas</th>
                <th>Saldo</th>

                <th>Debe</th>
                <th>Haber</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kardex as $key => $registro)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $registro->created_at->format('d/m/Y') }}</td>
                    <td>{{ $registro->detalle }}</td>
                    <td>{{ $registro->almacen->nombre }}</td>
                    <td class="text-right">
                        {{ number_format($registro->entradas,0) }}
                        @if ($registro->entradas > 0)
                            <i class="fas fa-arrow-up text-success"></i> <!-- Icono de flecha hacia arriba en verde para representar entradas -->
                        @endif
                    </td>
                    <td class="text-right">
                        {{ number_format($registro->salidas,0)}}
                        @if ($registro->salidas > 0)
                            <i class="fas fa-arrow-down text-danger"></i> <!-- Icono de flecha hacia abajo en rojo para representar salidas -->
                        @endif
                    </td>
                    <td class="text-right">{{ number_format($registro->saldo_stock,0) }}</td>
                    <td class="text-right">{{ number_format($registro->costo_producto,2,',','.') }}</td>
                    <td class="text-right">{{ number_format($registro->debe,2,',','.') }}</td>
                    <td class="text-right">{{ number_format($registro->haber,2,',','.') }}</td>
                    <td class="text-right"> {{ number_format($registro->saldo_valorado,2,',','.') }}</td>
                    {{-- @if ($registro->tipo='ingreso')
                    <td class="d-flex align-items-center ">
                        <a href="{{ route('ingresos.pdf', $ingreso) }}"
                            class="btn btn-outline-danger  btn-sm mr-1" target="_blank"><i
                                class="fas fa-file-pdf"></i> PDF</a>
                    </td>
                    @endif --}}
                </tr>
            @empty
                <tr>
                    <td  class="text-center"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>No hay registros en el kardex.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
        </tbody>
        

        <tfoot>
            {{-- Totales --}}
            @if ($stock !== null && $saldoActual !== null)
                <tr>
                    <th class="text-right" colspan="6">Stock:</th>
                    <th class="text-right" colspan="1">{{ $stock }}</th>
                    <th class="text-right">{{ $producto->costo_actual }}</th>
                    <th class="text-right" colspan="2">SALDO VALORADO:</th>
                    <th class="text-right">{{ number_format($saldoActual->saldo_valorado,2,',','.') }}</th>
                </tr>
            @else
                <tr>
                    <td colspan="11" class="text-center">No hay información disponible para mostrar los totales.</td>
                </tr>
            @endif
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
