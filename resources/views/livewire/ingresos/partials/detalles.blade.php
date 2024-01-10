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
                                        <th class="table-th text-center text-white">COSTO Bs.</th>
                                        <th width="13%" class="table-th text-center text-white">CANTIDAD</th>
                                        <th class="table-th text-center text-white">Sub total Bs.</th>
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
                                                <input type="number" id="p{{ $item->id }}"
                                                    wire:change="updatePrice({{ $item->id }}, $('#p' + {{ $item->id }}).val() )"
                                                    style="font-size: 1rem!important" class="form-control text-center"
                                                    value="{{ $item->price==0.01 ? 0.00 : $item->price }}">
                                            </td>
                                            <td>
                                                <input type="number" id="r{{ $item->id }}"
                                                    wire:change="updateQty({{ $item->id }}, $('#r' + {{ $item->id }}).val() )"
                                                    style="font-size: 1rem!important" class="form-control text-center"
                                                    value="{{ $item->quantity }}">
                                            </td>
                                            <td class="text-center">
                                                <h6>
                                                    {{ number_format($item->price * $item->quantity, 2) }}
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
                        <h5 class="text-center text-muted">Agrega productos al Ingreso</h5>
                    @endif

                    <div wire:loading.inline wire:target="guardarVenta">
                        <h4 class="text-danger text-center">Guardando Venta...</h4>
                    </div>

                </div>
            </div>
        </div>
    </div>
