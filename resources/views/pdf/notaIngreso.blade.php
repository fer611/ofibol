<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Nota de Ingreso</title>
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin: 20px 0;
        }

        .customer-info {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .company-info {
            text-align: right;
        }

        /* Estilo para la sección izquierda (cliente) */
        .left-section {
            float: left;
            width: 50%;
        }

        /* Estilo para la sección derecha (empresa) */
        .right-section {
            float: right;
            width: 50%;
        }

        .clear {
            clear: both;
        }

        /* Otras clases CSS (row, col-md-6, items-table, total) permanecen iguales */
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin: 20px 0;
        }

        .customer-info {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .company-info {
            text-align: left; /* Alinea los datos de la empresa a la izquierda */
            margin: 20px 0;
        }

        /* Clase personalizada para emular una fila (simulando Bootstrap) */
        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-.5 * var(--bs-gutter-x));
            margin-left: calc(-.5 * var(--bs-gutter-x))
        }

        /* Clase personalizada para emular una columna (simulando Bootstrap) */
        .col-md-6 {
            flex: 0 0 auto;
            width: 50%
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .items-table th,
        .items-table td {
            border: 1px solid #000;
            padding: 8px;
        }
        .items-table th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>NOTA DE INGRESO</h1>
            <h2>{{ $ingreso->almacen->nombre }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="left-section">
            <p><strong>Datos del Proveedor</strong></p>
            <p><strong>Nombre:</strong> {{ $ingreso->proveedor->nombre }}</p>
            <p><strong>Representante:</strong> {{ $ingreso->proveedor->representante }}</p>
            <p><strong>Fecha:</strong> {{ $ingreso->created_at->format('d/m/Y') }}</p>
        </div>
        <div class="right-section">
            <p><strong>Datos de la Empresa</strong></p>
            <p><strong>Nombre:</strong> OFIBOL</p>
            <p><strong>NIT:</strong> 4801118019</p>
            <p><strong>Dirección:</strong> Calle Murillo Nº 897</p>
        </div>
    </div><br><br><br><br><br><br><br><br><br>
    <table class="items-table">
        <!-- Resto del código permanece igual -->
        <tr>
            <th>ID</th>
            <th>Cantidad</th>
            <th>Descripción</th>
            <th>U. Medida</th>
            <th>Precio</th>
            <th>Subtotal</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td align="center">{{ $item->id}}</td>
                <td align="center">{{ number_format($item->cantidad,0) }}</td>
                <td>{{ $item->descripcion }}</td>
                <td>{{ $item->medida }}</td>
                <td align="right">{{ $item->precio_compra }}</td>
                <td align="right">{{ number_format($item->precio_compra * $item->cantidad, 2) }}</td>
            </tr>
        @endforeach
        <!-- Agrega una fila para el total justo debajo de la tabla de detalles -->
        <tr>
            <td colspan="5" align="right"><strong>Total:</strong></td>
            <td align="right">{{ number_format($data->sum('total'), 2) }}</td>
        </tr>
    </table>
</body>
</html>
