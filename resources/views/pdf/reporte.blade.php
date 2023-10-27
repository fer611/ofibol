<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ventas</title>
    

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Esto garantiza que el contenido abarque al menos el alto de la ventana */
        }

        section {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px;
        }

        .invoice-logo {
            max-width: 100px;
            max-height: 100px;
        }

        span {
            font-size: 16px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        thead {
            background-color: #f2f2f2;
        }

        th,
        td {
            border: 1px solid #ddd;
        }

        tfoot {
            font-weight: bold;
        }

        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
        }

        .pagenum:before {
            content: counter(page);
        }

        .header {
            align-self: flex-start;
            /* Mueve el header hacia la parte superior */
        }

        .body {
            align-self: center;
            /* Centra el body verticalmente */
        }

        .footer {
            align-self: flex-end;
            /* Mueve el footer hacia la parte inferior */
        }

        .text-start {
            text-align: left !important
        }

        .text-end {
            text-align: right !important
        }

        .text-center {
            text-align: center !important
        }
    </style>

</head>

<body>
    <header class="bg-primary text-white text-center py-3">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>OFIBOL</h1>
                    {{-- <img src="/storage/logo.png" alt="LOGO" width="200"> --}}
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <div class="row">
            <div class="col">
                @if ($reportType == 0)
                    <h2>Reporte de Ventas del Día</h2>
                @else
                    <h2>Reporte de Ventas por Fechas</h2>
                    <p><strong>Desde:</strong> {{ $dateFrom }}</p>
                    <p><strong>Hasta:</strong> {{ $dateTo }}</p>
                @endif
                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::now()->format('d-M-Y') }}</p>
                <p><strong>Usuario:</strong> {{ $user }}</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">FECHA</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">USUARIO</th>
                            <th class="text-center">CLIENTE</th>
                            <th class="text-center">ITEMS</th>
                            <th class="text-center">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="text-center">{{ $item->created_at->format('d/n/Y') }}</td>
                                <td>{{ $item->estado }}</td>
                                <td>{{ $item->user->name }}</td>
                                
                                <td>{{ $item->cliente->razon_social }}</td>
                                <td class="text-end">{{ number_format($item->items, 2) }}</td>
                                <td class="text-end">{{ number_format($item->total, 2) }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end"><strong>TOTALES</strong></td>
                            <td class="text-end">{{ number_format($data->sum('items'), 2) }}</td>
                            <td class="text-end">{{ number_format($data->sum('total'), 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- <footer class="bg-secondary text-white text-center py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span>SISTEMA OFIBOL v1</span>
                </div>
                <div class="col-md-4">
                    <span>Ofibol.com</span>
                </div>
                <div class="col-md-4">
                    Página <span class="pagenum"></span>
                </div>
            </div>
        </div>
    </footer> --}}
</body>

</html>
