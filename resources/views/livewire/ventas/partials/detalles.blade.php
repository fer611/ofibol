    <div class="connect-sorting">
        <div class="conect-sorting-content">
            <div class="card simple-title-task ui-sortable-handle">
                <div class="card-body">
                    @if ($total > 0)
                        <div class="table-responsive tblscroll" style="max-height: 650px; overflow: hidden">
                            <table class="table table-bordered table-striped mt-1">
                                <thead class="text-white table-dark" style="background: #3B3F5C">
                                    <tr>
                                        <th width="10%">IMAGEN</th>
                                        <th width="25%" class="table-th text-left text-white">DESCRIPCIÓN</th>
                                        <th data-toggle="tooltip" data-placement="top"
                                            title="Cantidad de productos en stock">STOCK</th>
                                        <th class="table-th text-center text-white">PRECIO</th>
                                        <th width="13%" class="table-th text-center text-white">CANTIDAD</th>
                                        <th class="table-th text-center text-white">IMPORTE</th>
                                        <th width="20%" class="table-th text-center text-white">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Recorremos la coleccion de productos --}}
                                    @foreach ($carrito as $item)
                                        <tr>
                                            <td class="text-center table-th">
                                                {{-- Si tenemos una imagen disponible --}}
                                                @if (count($item->attributes) > 0)
                                                    <span>
                                                        <img src="{{ asset('storage/productos/' . $item->attributes['0']) }}"
                                                            alt="imagen de producto" height="90" width="90"
                                                            class="rounded">
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <h6>{{ $item->name }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" wire:click.prevent="getStock({{ $item->id }})"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Ver detalles del stock">
                                                    {{ $item->attributes['1'] }}
                                                </a>
                                            </td>
                                            <td class="text-center">Bs. {{ number_format($item->price, 2) }}</td>
                                            <td>
                                                <input type="number" id="r{{ $item->id }}"
                                                    wire:change="updateQty({{ $item->id }}, $('#r' + {{ $item->id }}).val() )"
                                                    style="font-size: 1rem!important" class="form-control text-center"
                                                    value="{{ $item->quantity }}">
                                            </td>
                                            <td class="text-center">
                                                <h6>
                                                    Bs. {{ number_format($item->price * $item->quantity, 2) }}
                                                </h6>
                                            </td>
                                            <td class="text-center">
                                                <button wire:click.prevent="removeItem({{ $item->id }})"
                                                    {{-- onclick="Confirm('{{ $item->id }}', 'removeItem', '¿Confirmas eliminar el registro?')" --}} class="btn btn-dark mbmobile">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <button wire:click.prevent="decreaseQty({{ $item->id }})"
                                                    class="btn btn-dark mbmobile">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button wire:click.prevent="increaseQty({{ $item->id }})"
                                                    class="btn btn-dark mbmobile">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h5 class="text-center text-muted">Agrega productos a la venta</h5>
                    @endif

                    <div wire:loading.inline wire:target="guardarVenta">
                        <h4 class="text-danger text-center">Guardando Venta...</h4>
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal para detalles de stock -->
        <div class="modal fade" id="detallesStockModal" tabindex="-1" role="dialog"
            aria-labelledby="detallesStockModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <!-- Contenido del modal -->
                    <div class="modal-header text-white" style="background: #3B3F5C; color:white">
                        <h5 class="modal-title" id="detallesStockModalLabel">
                            Detalles del Stock -
                            {{ $producto == null ? 'Producto no cargado' : $producto->descripcion }}
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Iterar sobre las cantidades por sucursal -->
                        <div class="row">
                            <div class="col-12">
                                <ul class="list-group">
                                    @forelse ($stocks as $stock)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            @if (is_object($stock) && property_exists($stock, 'nombre'))
                                                {{ $stock->nombre }}
                                            @else
                                                No hay nombre disponible
                                            @endif
                                            <span class="badge badge-pill"
                                                style="background: #3B3F5C; color: white; font-size: 1.2em;">
                                                @if (is_object($stock) && property_exists($stock, 'stock'))
                                                    {{ $stock->stock }}
                                                @else
                                                    No hay stock disponible
                                                @endif
                                            </span>
                                        </li>
                                    @empty
                                        <li class="list-group-item">No hay stocks disponibles.</li>
                                    @endforelse

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
