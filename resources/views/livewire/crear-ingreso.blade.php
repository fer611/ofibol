<div class="container-fluid rounded p-4">
    <form wire:submit.prevent="crearIngreso" novalidate>
        @error('crear_ingreso')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
        <div class="row">

            <div class="col-lg-4">
                <!-- Select de Proveedores -->
                <div class="form-group" wire:ignore>
                    <label for="proveedor">Proveedor</label>
                    <select class="form-control @error('proveedor') is-invalid @enderror" id="proveedor"
                        wire:model="proveedor">
                        <option value="">Seleccionar proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                    @error('proveedor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Input de Representante -->
                <div class="form-group">
                    <label for="representante">Representante</label>
                    <input readonly value='representante'
                        class="form-control @error('representante') is-invalid @enderror" id="representante"
                        {{-- wire:model="representante" --}}>
                    @error('representante')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <!-- Select de Productos -->
                {{-- El wire:ignore evita que esta parte del codigo no se renderice con el componente --}}
                <div class="form-group" wire:ignore>
                    <label for="producto">Producto</label>
                    <select class="form-control selectpicker @error('producto') is-invalid @enderror" id="producto"
                        data-live-search="true" wire:model="producto">
                        <option value="">Seleccionar producto</option>
                        @foreach ($productos as $producto)
                            {{-- Aca concatenamos con el codigo del producto, por el momento solo el id --}}
                            <option value="{{ $producto->id }}">{{ $producto->id . ' ' . $producto->nombre }}</option>
                        @endforeach
                    </select>
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <!-- Campo de Cantidad -->
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad"
                        wire:model="cantidad">
                    @error('cantidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <!-- Campo de Precio de Compra -->
                <div class="form-group">
                    <label for="precio_compra">Precio Compra</label>
                    <input type="number" class="form-control @error('precio_compra') is-invalid @enderror"
                        id="precio_compra" wire:model="precio_compra">
                    @error('precio_compra')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <!-- Campo de Precio de Venta -->
                <div class="form-group">
                    <label for="precio_venta">Precio Venta</label>
                    <input type="number" class="form-control @error('precio_venta') is-invalid @enderror"
                        id="precio_venta" wire:model="precio_venta">
                    @error('precio_venta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <!-- Botón para Agregar -->
                <div class="form-group">
                    <label for="btn_agregar">Acción</label>
                    <button type="button" class="btn btn-block btn-outline-success" name="" id="btn_agregar"
                        wire:click='agregarProducto'>Agregar</button>
                </div>
            </div>
        </div>
        @error('agregar')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
        {{-- La tabla donde se almacenarán los productos --}}
        <div class="row">
            <div class="col-md-12">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="detalles">
                                            <thead class="">
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio Compra</th>
                                                    <th>Precio Venta</th>
                                                    <th>Subtotal</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <th colspan="5" class="text-right">total</th>
                                                <th>
                                                    <h4 id="total">Bs. {{ $total }}</h4>
                                                </th>

                                            </tfoot>
                                            <tbody>
                                                @foreach ($productosSeleccionados as $index => $producto)
                                                    <tr>
                                                        <td>{{ $producto['nombre'] }}</td>
                                                        <td>{{ $producto['cantidad'] }}</td>
                                                        <td>{{ $producto['precio_compra'] }}</td>
                                                        <td>{{ $producto['precio_venta'] }}</td>
                                                        <td>{{ $producto['subtotal'] }}</td>
                                                        <td>
                                                            <button wire:click="eliminarProducto({{ $index }})"
                                                                class="btn btn-danger btn-sm">Eliminar</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- Botón de envío -->
        <button type="submit" id="guardar" name="guardar" class="btn btn-primary w-100">Guardar</button>
    </form>

    {{-- El siguiente script modifica el valor del input select de producto, esto debido al wire:ignore  --}}
    <script>
        document.addEventListener('livewire:load', function() {
            $('.selectpicker').on('change', function() {
                @this.set('producto', this.value);
            });
        })
    </script>
</div>
