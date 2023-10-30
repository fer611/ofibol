<div class="row mt-3">
    <div class="col-sm-12">
            <div class="connect-sorting-content mt-4">
                <div class="card simplet-title-task ui-sortable-handle">
                    <div class="card-body">
                        <h4>TOTAL: Bs. {{ number_format($total, 2) }}</h4>
                        <input type="hidden" id="hiddenTotal" value="{{ $total }}">
                        <h6>Total items: <span>{{ $itemsQuantity }}</span></h6>
                        <div class="row justify-content-between mt-2">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                @if ($total > 0)
                                    <button onclick="Confirm('','clearCart','¿SEGURO DE ELIMINAR EL CARRITO?')"
                                        class="btn btn-dark mtmobile">
                                        CANCELAR
                                    </button>
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <button wire:click.prevent="guardarIngreso" class="btn btn-dark btn-md btn-block">
                                    GUARDAR
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
