<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Nota de Ingreso</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
    <style>
        @font-face {
            font-family: "Roboto";
            src: url('{{ storage_path('fonts/Roboto-Light.ttf') }}') format('truetype');
            font-weight: 100;
            font-style: normal;
        }

        @font-face {
            font-family: "Roboto";
            src: url('{{ storage_path('fonts/Roboto-Regular.ttf') }}') format('truetype');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: "Roboto";
            src: url('{{ storage_path('fonts/Roboto-Bold.ttf') }}') format('truetype');
            font-weight: 700;
            font-style: normal;
        }

        

    </style>
</head>

<body>
    <div id="header">
        <img class="imgHeader" src="{{ public_path('img/logo.png') }}" alt="" width="200px">
        <div class="infoHeader">
            <h1 class="normal">NOTA DE INGRESO</h1>
            <h2 class="ligera"><span class="normal">Ubicación: </span>{{ $ingreso->almacen->nombre }}</h2>
            <h2 class="normal">Nº: {{ $ingreso->id }}</h2>
        </div>
    </div>

    <table class="section">
        <tr>
            <div class="section">
                <div class="section-content">
                    <div class="section-header normal">Recepcionista:</div>
                    <div class="ligera"><span class="normal">Nombre: </span>{{ $ingreso->user->name }}</div>
                    <div class="ligera"><span class="normal">Email: </span>{{ $ingreso->user->email }}</div>
                    <div class="ligera"><span class="normal">Fecha y Hora de Recepción: </span>{{ \Carbon\Carbon::parse($ingreso->created_at)->format('d/m/Y H:i:s') }}</div>
                    
                </div>
            </div>
            
            <td width="120"></td>
            {{-- <td class="section-content">
                <div class="section-header normal">Datos de la Empresa:</div>
                <div class="ligera"><span class="normal">Dirección: </span>Calle Murillo Nº897, esq Sagarnaga</div>
                <div class="ligera"><span class="normal">Email: </span>Ofibol@hotmail.com</div>
                <div class="ligera"><span class="normal">Celular: </span>76202463 - 74005262</div>
                <div class="ligera"><span class="normal">NIT: </span>4801118019</div>
            </td> --}}
            <td class="section-content">
                <!-- Sección del Usuario -->
                <div class="section-header normal">Datos del Proveedor:</div>
                <div class="ligera"><span class="normal">Nombre: </span>{{ $ingreso->proveedor->nombre }}</div>
                {{-- direccion --}}
                <div class="ligera"><span class="normal">Direccion: </span>{{ $ingreso->proveedor->direccion }}</div>
                <div class="ligera"><span class="normal">Representante: </span>{{ $ingreso->proveedor->representante }}
                </div>
                <div class="ligera"><span class="normal">Celular: </span>
                    {{ $ingreso->proveedor->telefono ? $ingreso->proveedor->telefono : 'S/N' }}</div>
            </td>
        </tr>
    </table>
    <div class="container">
        <table class="items-table">
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
                    <td align="center">{{ $item->id }}</td>
                    <td align="center">{{ number_format($item->cantidad, 0) }}</td>
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
    </div>
    {{-- <div id="footer">
        <p class="textFooter">Ofibol.com</p>
    </div> --}}
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
