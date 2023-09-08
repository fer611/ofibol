<div class="container-fluid rounded p-4">
    <form wire:submit.prevent="crearProducto" novalidate>
        <div class="row">
            <!-- Primera columna -->
            <div class="col-lg-4">
                <!-- Almacén -->
                <div class="form-group">
                    <label for="almacen">Almacén</label>
                    <select class="form-control @error('almacen') is-invalid @enderror" id="almacen"
                        wire:model="almacen">
                        <option value="">-- Seleccione --</option>
                        @foreach ($almacenes as $almacen)
                            <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                        @endforeach
                    </select>
                    @error('almacen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
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
                <!-- Stock Inicial -->
                <div class="form-group">
                    <label for="stock">Stock Inicial</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" wire:model="stock"
                        placeholder="Ingrese el stock inicial">
                        @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Stock Mínimo -->
                <div class="form-group">
                    <label for="stock_minimo">Stock Mínimo</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock_minimo" wire:model="stock_minimo"
                        placeholder="Ingrese el stock minimo">
                        @error('stock_minimo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Segunda columna -->
            <div class="col-lg-4">
                <!-- Nombre del producto -->
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                        wire:model="nombre" placeholder="Ingrese el nombre del producto">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Descripción -->
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" wire:model="descripcion"
                        placeholder="Ingrese una descripción"></textarea>
                    @error('descripcion')
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
                <!-- Precio de Compra -->
                <div class="form-group">
                    <label for="costo_actual">Precio de Compra (Bs.)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Bs.</span>
                        </div>
                        <input type="text" class="form-control @error('costo_actual') is-invalid @enderror"
                            id="costo_actual" wire:model="costo_actual" placeholder="Ej. 12,2">
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
                        placeholder="Ingrese el porcentaje de margen">
                    @error('porcentaje_margen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Tercera columna -->
            <div class="col-lg-4">


                <!-- Precio de Venta -->
                <div class="form-group">
                    <label for="precio_venta">Precio de Venta</label>
                    <input type="number" class="form-control @error('precio_venta') is-invalid @enderror"
                        id="precio_venta" wire:model="precio_venta" readonly>
                    @error('precio_venta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Imagen del Producto -->
                <div class="form-group">
                    <label for="imagen" class="font-weight-bold">Imagen del Producto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('imagen') is-invalid @enderror"
                            id="imagen" wire:model="imagen" >
                        <label class="custom-file-label" for="imagen">Elegir imagen</label>
                        @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Previsualización de la imagen -->
                    @if ($imagen)
                        <div class="mt-2">
                            <img src="{{ $imagen->temporaryUrl() }}" alt="Previsualización" class="img-thumbnail"
                                width="300">
                        </div>
                    @endif
                </div>

            </div>
        </div>
        <!-- Botón de envío -->
        <button type="submit" class="btn btn-primary w-100">Guardar</button>
    </form>
</div>
