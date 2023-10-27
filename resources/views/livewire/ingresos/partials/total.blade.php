<div class="row mt-3">
    <div class="col-sm-12">
        <div class="connect-sorting">

            <div class="connect-sorting-content mt-4">
                <div class="card simplet-title-task ui-sortable-handle">
                    <div class="card-body">
                        <h2>TOTAL: Bs. {{ number_format($total, 2) }}</h2>
                        <input type="hidden" id="hiddenTotal" value="{{ $total }}">
                        <h6>Total items: <span>{{ $itemsQuantity }}</span></h6>
                        <div class="row justify-content-between mt-5">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                @if ($total > 0)
                                    <button onclick="Confirm('','clearCart','¿SEGURO DE ELIMINAR EL CARRITO?')"
                                        class="btn btn-dark mtmobile">
                                        CANCELAR F4
                                    </button>
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <button wire:click.prevent="guardarIngreso" class="btn btn-dark btn-md btn-block">
                                    GUARDAR F9
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
