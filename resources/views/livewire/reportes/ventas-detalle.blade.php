<div wire:ignore.self class="modal fade" id="modalDetalles" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b> Detalle de Venta # {{ $ventaId }}</b> | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
                </h5>
                <h6 class="text-center text-warning" wire:loading >POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white text-center">ID</th>
                                <th class="table-th text-white text-center">PRODUCTO</th>
                                <th class="table-th text-white text-center">PRECIO</th>
                                <th class="table-th text-white text-center">CANTIDAD</th>
                                <th class="table-th text-white text-center">SUB TOTAL</th>
                        </thead>
                        <tbody>
                            @foreach ($detalles as $d)
                                <tr>
                                    <td>
                                        <h6>{{ $d->id }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $d->producto }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-right">{{ number_format($d->precio, 2) }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-right">{{ number_format($d->cantidad, 2) }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-right">{{ number_format($d->precio * $d->cantidad, 2) }}</h6>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <h5 class="text-right font-weight-bold"><b>TOTALES</b></h5>
                                </td>
                                <td>
                                    <h5 class="text-right"><b>{{ $countDetails }}</b></h5>
                                </td>
                                <td>
                                    <h5 class="text-right">
                                        Bs. {{ number_format($sumDetails, 2) }}</h5>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark close-btn text-info" data-dismiss="modal">
                    CERRAR
                </button>
            </div>
        </div>
    </div>
</div>
