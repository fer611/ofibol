<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota de Venta</title>
    <style>
        /* Estilos CSS para la nota de venta */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            width: 100%;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }


        .header img {
            max-width: 100%;
            height: auto;
        }

        .details {
            margin-bottom: 30px;
        }

        .items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items th,
        .items td {
            border: 1px solid #000000;
            padding: 8px;
        }

        .items th {
            background-color: #3B3F5C;
            color: white;
        }

        .total {
            text-align: right;
        }

        .text-sm {
            font-size: 14px;
        }

        .bold {
            font-family: "Roboto";
            font-weight: 700;
        }

        /* Nueva regla para la clase .border */
        .border {
            border: 0 !important;
            /* !important para aumentar la especificidad */
            padding: 0;
            /* Puedes agregar esto si también quieres quitar el relleno */
        }

        
    </style>
</head>

<body>
    <div class="container">
        <div class="head">
            <table>
                <tbody>
                    <tr>
                        <td class="logo"><img class="imgHeader" src="{{ public_path('img/logo.png') }}"
                                alt="Logo de la Empresa" width="150px"></td>
                        <td width="170"></td>
                        <td class="section-content">
                            <div class="normal"><span class="bold">Dirección: </span>Calle Murillo Nº897, esq
                                Sagarnaga
                            </div>
                            <div class="normal"><span class="bold">Email: </span>Ofibol@hotmail.com</div>
                            <div class="normal"><span class="bold">Celular: </span>76202463 - 74005262</div>
                            <div class="normal"><span class="bold">NIT: </span>4801118019</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="header">
            <h1 style="font-size: 25px;">NOTA DE VENTA</h1>
        </div>

        <div class="details">
            <p><strong>Cliente:</strong> {{ $venta->cliente->razon_social }}</p>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($venta->created_at)->format('d/m/Y') }}</p>
        </div>

        <table class="items">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CANTIDAD</th>
                    <th>DESCRIPCION</th>
                    <th>U. MEDIDA</th>
                    <th>PRECIO</th>
                    <th>SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td align="center">{{ number_format($item->cantidad, 0) }}</td>
                        <td>{{ $item->descripcion }}</td>
                        <td align="center">{{ $item->medida }}</td>
                        <td align="right">{{ $item->precio }}</td>
                        <td align="right">{{ number_format($item->precio * $item->cantidad, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="border" colspan="3"></td>
                    <!-- Agrega celdas vacías para ocupar las primeras 4 columnas -->
                    <td  colspan="2" align="right"><strong>SUBTOTAL Bs</strong></td>
                    <td align="right">{{ number_format($data->sum('total'), 2) }}</td>
                </tr>
                <tr>
                    <td class="border" colspan="3"></td>
                    <!-- Agrega celdas vacías para ocupar las primeras 4 columnas -->
                    <td  colspan="2" align="right"><strong>DESCUENTO Bs</strong></td>
                    <td align="right">0.00</td>
                </tr>
                <tr>
                    <td class="border" colspan="3"></td>
                    <!-- Agrega celdas vacías para ocupar las primeras 4 columnas -->
                    <td  colspan="2" align="right"><strong>TOTAL Bs</strong></td>
                    <td align="right">{{ number_format($data->sum('total'), 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(500, 810, "Página $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
    </script>
</body>

</html>
