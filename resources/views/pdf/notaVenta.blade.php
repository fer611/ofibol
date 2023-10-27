<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Nota de Venta</title>
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
            display: flex;
            justify-content: space-between;
            /* Espacio entre las dos columnas */
        }

        .header {
            text-align: center;
            margin: 20px 0;
        }

        .company-info {
            text-align: right;
            margin: 20px 0;
        }

        .customer-info {
            margin-top: 20px;
            text-align: left;
            display: flex;
            justify-content: space-between;
            /* Espacio entre los datos del cliente */
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
            <h1>NOTA DE VENTA</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Nombre:</strong> OFIBOL</p>
            <p><strong>NIT:</strong> 4801118019</p>
            <p><strong>Dirección:</strong> Calle Murillo Nº 897</p>
        </div>
        <div class="col-md-6">
            <div>
                <p><strong>NIT:</strong> {{ $venta->cliente->nit }}</p>
                <p><strong>Razón Social:</strong> {{ $venta->cliente->razon_social }}</p>
                <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>
    <table class="items-table">
        <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td align="center">{{ $item->id }}</td>
                <td>{{ $item->producto }}</td>
                <td align="right">{{ $item->precio }}</td>
                <td align="right">{{ $item->cantidad }}</td>
                <td align="right">{{ number_format($item->precio * $item->cantidad, 2) }}</td>
            </tr>
        @endforeach
        <!-- Agrega una fila para el total justo debajo de la tabla de detalles -->
        <tr>
            <td colspan="4" align="right"><strong>Total:</strong></td>
            <td align="right">{{ number_format($data->sum('total'), 2) }}</td>
        </tr>
    </table>
</body>

</html>
