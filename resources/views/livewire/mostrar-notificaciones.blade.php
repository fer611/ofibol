<div>
    @if (session()->has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('mensaje') }}
        </div>
    @endif
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h6 class="mb-0 text-center mr-auto">Mis Notificaciones.</h6>
                        @if ($notificaciones->count() > 0)
                            <div>
                                <a href="#" wire:click.prevent="marcarTodasLeidas" class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i> Marcar Todas como Leídas
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        @forelse ($notificaciones as $notificacion)
                            <div class="notification-item border mb-3 p-3">

                                {{-- Aca preguntamos por el tipo de notificacion --}}
                                @if ($notificacion->type === 'App\Notifications\NuevaVenta')
                                    {{-- Aca mostramos el vendedor, el total de la venta y la antigüedad de la notificación --}}
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="mb-0">Nueva Venta Realizada por:
                                                <strong>{{ $notificacion->data['vendedor'] }}</strong> por un total de
                                                <strong>{{ $notificacion->data['total'] }} Bs.</strong>
                                            </p>
                                            <strong>Hace {{ $notificacion->created_at->diffForHumans() }}</strong>
                                        </div>
                                        <div>
                                            <a href="{{ route('ventas.pdf', $notificacion->data['id_venta']) }}"
                                                target="_blank" class="btn btn-danger btn-sm"> <i
                                                    class="fas fa-file-pdf"></i> VER DETALLES</a>
                                        </div>
                                    </div>
                                @endif

                                {{-- Aca preguntamos por el tipo de notificacion --}}
                                @if ($notificacion->type === 'App\Notifications\NuevoCliente')
                                    {{-- Aca mostramos la razon social, el nit y la antigüedad de la notificación --}}
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="mb-0">Nuevo Cliente Registrado:
                                                <strong>{{ $notificacion->data['razon_social'] }}</strong> con NIT:
                                                <strong>{{ $notificacion->data['nit'] }}</strong>
                                            </p>
                                            <strong>Hace {{ $notificacion->created_at->diffForHumans() }}</strong>
                                        </div>
                                        {{-- Boton para ver más --}}
                                        <div>
                                            <a href="{{ route('clientes.index') }}" class="btn btn-dark btn-sm"> <i
                                                    class="fas fa-eye"></i> VER MÁS</a>
                                        </div>
                                    </div>
                                @endif
                                @if ($notificacion->type === 'App\Notifications\BajoStock')
                                    {{-- Aca mostramos la información relevante de Bajo Stock --}}
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="mb-0">Producto con Bajo Stock:
                                                <strong>{{ $notificacion->data['producto_descripcion'] }}</strong> de la
                                                marca
                                                <strong>{{ $notificacion->data['producto_marca'] }}</strong>.
                                                Stock actual:
                                                <strong>{{ $notificacion->data['producto_stock'] }}</strong>
                                            </p>
                                            <strong>Hace {{ $notificacion->created_at->diffForHumans() }}</strong>
                                        </div>
                                        {{-- Puedes agregar un botón o enlace para más detalles si es necesario (ID:
                                                <strong>{{ $notificacion->data['producto_id'] }}</strong>) --}}
                                        <div>
                                            <div>
                                                <a href="{{ route('productos.show', $notificacion->data['producto_id']) }}" class="btn btn-dark btn-sm"> <i
                                                        class="fas fa-eye"></i> VER DETALLE</a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="text-center">No Hay Notificaciones Nuevas</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
