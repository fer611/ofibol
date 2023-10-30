<div class="row mt-3">
    <div class="col-sm-12">
        <div class="connect-sorting">
            
            <div class="connect-sorting-content mt-4">
                <div class="card simplet-title-task ui-sortable-handle">
                    <div class="card-body">
                        <h4 >TOTAL: Bs. {{ number_format($total, 2) }}</h4>
                                    <input type="hidden" id="hiddenTotal" value="{{ $total }}">
                        <div class="input-group input-group-md mb-3">
                            <div class="input-group-prepend">
                                <button wire:click.prevent="exacto" class="input-group-text input-gp hideonsm"
                                    style="background: #3B3F5C; color:white">
                                    EXACTO F8
                                </button>
                            </div>
                            <input type="number" id="cash" wire:model="efectivo" wire:keydown.enter="guardarVenta"
                                class="form-control text-center" value="{{ $efectivo }}" style="height: 50px;">

                            {{-- <div class="input-group-append">
                                <span wire:click.prevent="limpiarEntrada" class="input-group-text"
                                    style="background: #3B3F5C; color: white">
                                    <i class="fas fa-backspace fa-2x"></i>
                                </span>
                            </div> --}}
                        </div>
                        <h4 class="text-muted">Cambio: {{ number_format($cambio, 2) }}</h4>

                        <div class="row justify-content-between mt-5">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                @if ($total > 0)
                                <button onclick="Confirm('','clearCart','¿SEGURO DE ELIMINAR EL CARRITO?')" class="btn btn-dark mtmobile">
                                    CANCELAR F4
                                </button>
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                @if($efectivo >= $total && $total > 0)
                                <button wire:click.prevent="guardarVenta" class="btn btn-dark btn-md btn-block">
                                    GUARDAR F9
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
