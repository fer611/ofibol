<div class="table-responsive">
    <table class="table table-bordered table-striped" id="kardex">
        <thead class="">
            <tr>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Entradas</th>
                <th>Salidas</th>
                <th>Almacén</th>
                <th>Precio Producto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kardex as $registro)
                <tr>
                    <td>{{ $registro->producto->descripcion }}</td>
                    <td>{{ $registro->created_at->format('d/m/Y') }}</td>
                    <td>{{ $registro->entradas }}</td>
                    <td>{{ $registro->salidas }}</td>
                    <td>{{ $registro->almacen->nombre }}</td>
                    <td>{{ $registro->precio_producto }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
