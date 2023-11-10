<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<style>
    @page {
        margin: 0.5cm;
    }

    .titulo {
        color: rgb(36, 16, 163);
        margin: 1cm 0cm;
    }
</style>

<body>
    <div>
        <img src="{{ public_path('img/logo.png') }}" alt="" width="200px">
        <h1 class="titulo">OFIBOL</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, dolor magni vitae omnis non inventore similique
            minus ab officiis iure. Consequuntur excepturi tenetur repellendus iusto eaque. Autem natus non
            perspiciatis.</p>
    </div>
</body>

</html>
