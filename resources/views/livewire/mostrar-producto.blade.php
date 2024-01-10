<div class="container mt-5">
    <div class="row">
        <!-- Imagen del producto -->
        <div class="col-md-6">
            <img src="{{ asset('storage/productos/' . $producto->imagen) }}"
                alt="{{ 'Imagen producto ' . $producto->nombre }}" class="img-fluid img-thumbnail">
            <button type="button" class="btn w-100 mt-4" data-toggle="modal" data-target="#traspasoModal"
                style="background: #3B3F5C; color:white">
                Realizar Traspaso
            </button>
        </div>

        <!-- Detalles del producto -->
        <div class="col-md-6">

            @if ($producto->barcode)
                <p><strong>Codigo de Barras:</strong>{!! DNS1D::getBarcodeHTML("$producto->barcode", 'CODABAR', 2, 50) !!} {{ $producto->barcode }}
                    {{-- <br><button class="btn" style="background: #3B3F5C; color:white"
                        onclick="imprimirCodigoBarras()">Imprimir</button> --}}
                </p>
                
            @else
                <p><strong>Codigo de Barras:</strong> No generado</p>
            @endif
            <p><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
            <p><strong>Marca:</strong> {{ $producto->marca->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
            <p><strong>Unidad de Medida:</strong> {{ $producto->unidad_medida }}</p>
            <p><strong>Cantidad por Caja/Paquete:</strong> {{ $producto->cantidad_unidad }}</p>
            <p><strong>Costo Actual:</strong>
                {{ $producto->costo_actual == null ? 'No se registró ninguna entrada' : $producto->costo_actual }}</p>
            <p><strong>Porcentaje de Margen:</strong> {{ $producto->porcentaje_margen }}%</p>
            <p><strong>Precio de Venta:</strong>
                {{ $producto->precio_venta == null ? 'No se registró ninguna entrada' : $producto->precio_venta }} (Bs.)</p>
            <p><strong>Stock Mínimo:</strong> {{ $producto->stock_minimo }}</p>
            <p><strong>Estado:</strong> {{ $producto->estado === '1' ? 'Activo' : 'Inactivo' }}</p>

            <!-- Stock en cada sucursal -->
            <h4>Stock en Sucursales</h4>
            <ul>
                @foreach ($stocks as $stock)
                    <li> <strong> {{ $stock->nombre }}: </strong> {{ $stock->stock }} unidades</li>
                @endforeach
            </ul>
            <h4>Stock total: <span>{{ $stock_total == null ? 'No se registró ninguna entrada' : $stock_total}}</span></h4>
        </div>
    </div>
    <!-- Modal Para realizar el traspaso-->
    <div class="modal fade" id="traspasoModal" tabindex="-1" role="dialog" aria-labelledby="traspasoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="traspasoModalLabel">Realizar Traspaso de Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <livewire:realizar-traspaso :producto="$producto" />
                </div>

            </div>
        </div>
    </div>

    
</div>
