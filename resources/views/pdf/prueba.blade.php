<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    <p>Texto por defecto</p>
    <p class="ligera">Ligera</p>
    <p class="normal">Normal</p>
    <p class="bold">Bold</p>
    <div id="header">
        <img class="imgHeader" src="{{ public_path('img/logo.png') }}" alt="" width="200px">
        <div class="infoHeader">
            <h1 class="normal">NOTA DE VENTA</h1>
            <p>Especialistas en material de escritorio y escolar</p>
        </div>
    </div>
    <div id="footer">
        <p class="textFooter">Ofibol.com</p>
    </div>
    <div class="container">
        @for ($i = 0; $i < 400; $i++)
            <div class="hijo">{{ $i }}</div>
        @endfor
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
