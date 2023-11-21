<div class="container-fluid rounded p-4">
    <form wire:submit.prevent="crearProducto" novalidate>
        <div class="row">
            <!-- Primera columna -->
            <div class="col-lg-6">
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
                <!-- Stock Mínimo -->
                <div class="form-group">
                    <label for="stock_minimo">Stock Mínimo</label>
                    <input type="number" class="form-control @error('stock_minimo') is-invalid @enderror"
                        id="stock_minimo" wire:model="stock_minimo" placeholder="Ingrese el stock mínimo">
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
                    <label for="cantidad_unidad">Cantidad por Unidad de Medida (Opcional)</label>
                    <input type="text" class="form-control @error('cantidad_unidad') is-invalid @enderror"
                        id="cantidad_unidad" wire:model="cantidad_unidad"
                        placeholder="Ingrese la cantidad por caja/paquete, etc.">
                    @error('cantidad_unidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Segunda columna -->
            <div class="col-lg-6">
                <!-- Descripción -->
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" wire:model="descripcion"
                        placeholder="Ingrese una descripción"></textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                <!-- Codigo de barras del producto -->
                <div class="form-group">
                    <label for="barcode">Codigo de Barras</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('barcode') is-invalid @enderror" id="barcode"
                            wire:model.debounce.1000ms="barcode" placeholder="Ingrese el barcode del producto"
                            maxlength="20">
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
                <!-- Imagen del Producto -->
                <div class="form-group">
                    <label for="imagen" class="font-weight-bold">Imagen del Producto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('imagen') is-invalid @enderror"
                            id="imagen" wire:model="imagen" accept="image/*">
                        <label class="custom-file-label" for="imagen">Elegir imagen</label>
                        @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Previsualización de la imagen -->
                    @if ($imagen)
                        <div class="mt-2">
                            <img src="{{ $imagen->temporaryUrl() }}" alt="Previsualización" class="img-thumbnail"
                                width="150">
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Botones de envío y limpieza en la misma fila -->
        <div class="row mt-2">
            <div class="col-lg-6">
                <button type="reset" class="btn btn-secondary w-100">Limpiar</button>
            </div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary w-100">Guardar</button>
            </div>
        </div>
    </form>
</div>
