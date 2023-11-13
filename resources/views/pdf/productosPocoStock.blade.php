<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Productos-Bajo stock</title>
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

        


    .infoHeader {
        text-align: right;
    }

    .title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .subtitle {
        font-size: 16px;
        font-weight: normal;
        margin: 0;
    }

    </style>
</head>

<body>
    <div id="header">
        <img class="imgHeader" src="{{ public_path('img/logo.png') }}" alt="" width="200px">
        <div class="infoHeader">
            <h2 class="title">Informe de Productos con Bajo Stock</h2>
            <h3 class="subtitle">Generado por: {{ auth()->user()->name }} </h3>
            <h4 class="subtitle">Email: {{ auth()->user()->email }}</h4>
            <h4 class="subtitle">Fecha: {{ date('d-m-Y') }}</h4>
        </div>
    </div>
    
    <div class="container">
        <table class="items-table">
            <tr>
                
                <th>ID</th>
                <th>Producto</th>
                <th>Stock Disponible</th>
                <th>Stock Minimo</th>
                <th>Marca</th>
            </tr>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->descripcion }}</td>
                <td>{{ $item->stock }}</td>
                <td>{{ $item->stock_minimo }}</td>
                <td>{{ $item->marca }}</td>
            </tr>
            @endforeach
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
