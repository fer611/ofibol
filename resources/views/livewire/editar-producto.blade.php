<div class="container-fluid rounded p-4 ">
    <form wire:submit.prevent="editarProducto" novalidate>
        <div class="row">
            <!-- Primera columna -->
            <div class="col-lg-4">
                <!-- Categoría -->
                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select class="form-control @error('categoria') is-invalid @enderror" id="categoria"
                        wire:model="categoria">
                        <option value="">-- Seleccione --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Origen -->
                <div class="form-group">
                    <label for="origen">Origen</label>
                    <select class="form-control @error('origen') is-invalid @enderror" id="origen"
                        wire:model="origen">
                        <option value="">-- Seleccione --</option>
                        @foreach ($origenes as $origen)
                            <option value="{{ $origen->id }}">{{ $origen->nombre }}</option>
                        @endforeach
                    </select>
                    @error('origen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Marca -->
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <select class="form-control @error('marca') is-invalid @enderror" id="marca" wire:model="marca">
                        <option value="">-- Seleccione --</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                        @endforeach
                    </select>
                    @error('marca')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Stock Mínimo -->
                <div class="form-group">
                    <label for="stock_minimo">Stock Mínimo</label>
                    <input type="number" class="form-control @error('stock_minimo') is-invalid @enderror"
                        id="stock_minimo" wire:model="stock_minimo" placeholder="Ingrese el stock minimo">
                    @error('stock_minimo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Unidad de Medida -->
                <div class="form-group">
                    <label for="unidad_medida">Unidad de Medida</label>
                    <input type="text" class="form-control @error('unidad_medida') is-invalid @enderror"
                        id="unidad_medida" wire:model="unidad_medida" placeholder="Ingrese la unidad de medida">
                    @error('unidad_medida')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Cantidad por Unidad de Medida -->
                <div class="form-group">
                    <label for="cantidad_unidad">Cantidad por Unidad de Medida</label>
                    <input type="text" class="form-control @error('cantidad_unidad') is-invalid @enderror"
                        id="cantidad_unidad" wire:model="cantidad_unidad"
                        placeholder="Ingrese la cantidad por caja/paquete etc.">
                    @error('cantidad_unidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Segunda columna -->
            <div class="col-lg-4">

                <!-- Descripción -->
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" wire:model="descripcion"
                        placeholder="Ingrese una descripción"></textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Precio de Compra -->
                <div class="form-group">
                    <label for="costo_actual">Costo Actual (Bs.)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Bs.</span>
                        </div>
                        <input type="text" class="form-control @error('costo_actual') is-invalid @enderror"
                            id="costo_actual" wire:model="costo_actual" placeholder="Ej. 12,2" readonly>
                        @error('costo_actual')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Porcentaje de Margen -->
                <div class="form-group">
                    <label for="porcentaje_margen">Porcentaje de Margen</label>
                    <input type="number" class="form-control @error('porcentaje_margen') is-invalid @enderror"
                        id="porcentaje_margen" wire:model="porcentaje_margen"
                        placeholder="Ingrese el porcentaje de margen" wire:input.debounce.500ms="calcularPrecioVenta">
                    @error('porcentaje_margen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Precio de Venta -->
                <div class="form-group">
                    <label for="precio_venta">Precio de Venta</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Bs.</span>
                        </div>
                        <input type="text" class="form-control @error('precio_venta') is-invalid @enderror"
                            id="precio_venta" wire:model="precio_venta" readonly>
                        @error('precio_venta')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Codigo de barras del producto -->
                <div class="form-group">
                    <label for="barcode">Codigo de Barras</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('barcode') is-invalid @enderror"
                            id="barcode" wire:model="barcode" placeholder="Ingrese el barcode del producto">
                        <div class="input-group-append">
                            <button class="btn" style="background: #3B3F5C; color:white" type="button"
                                id="generateBarcodeBtn" wire:click='generarBarcode'>Generar</button>
                        </div>
                    </div>
                    @error('barcode')
                        <p class="text-sm text-red">{{ $message }}</p>
                    @enderror
                    {{-- si barcode tiene un valor y sea numerico... --}}
                    @if ($barcode != null && is_numeric($barcode))
                        {!! DNS1D::getBarcodeHTML("$barcode", 'CODABAR', 2, 50) !!}
                    @endif
                </div>

                {{-- Fecha de vencimiento del producto --}}
                {{-- <div class="form-group">
                    <label for="fecha_vencimiento">Fecha de Vencimiento (Opcional)</label>
                    <input type="date" class="form-control @error('fecha_vencimiento') is-invalid @enderror"
                        id="fecha_vencimiento" wire:model="fecha_vencimiento"
                        placeholder="Ingrese la fecha de vencimiento del producto">
                    @error('fecha_vencimiento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}
            </div>
            <!-- Tercera columna -->
            <div class="col-lg-4">
                <!-- Imagen del Producto -->
                <div class="form-group">
                    <label for="imagen" class="font-weight-bold">Imagen del Producto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('imagen_nueva') is-invalid @enderror"
                            id="imagen" wire:model="imagen_nueva" accept="image/*">
                        <label class="custom-file-label" for="imagen">Elegir imagen</label>
                        @error('imagen_nueva')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <label class="font-weight-bold">Imagen Actual</label>
                        <div>
                            <img src="{{ asset('storage/productos/' . $imagen) }}"
                                alt="{{ 'Imagen Producto: ' . $nombre }}" class="img-thumbnail"
                                style="width: 300px;">
                        </div>
                    </div>

                    <!-- Previsualización de la imagen -->
                    @if ($imagen_nueva)
                        <div class="mt-2">
                            <label class="font-weight-bold">Nueva imagen</label>
                            <div>
                                <img src="{{ $imagen_nueva->temporaryUrl() }}" alt="Previsualización"
                                    class="img-thumbnail" style="width: 300px;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-dark w-100">Guardar Cambios</button>
        </div>

    </form>
</div>
