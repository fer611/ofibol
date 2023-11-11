<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ventas</title>
    <link rel="stylesheet" href="{{ public_path('css/custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/custom_page.css') }}">
</head>

<body>
    <section class="header" style="top: -287px;">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td colspan="2" class="text-center">
                    <span style="font-size: 25px; font-weight: bold;">Sistema OFIBOL</span>
                </td>
            </tr>
            <tr>
                <td width="30%" style="vertical-align: top; padding-top: 10px; position: relative">
                    <img src="{{ public_path('img/logo.png') }}" alt="" class="invoice-logo">
                </td>
                <td width="70%" class="text-left text-company" style="vertical-align: top; padding-top: 10px">
                    @if ($reportType == 0)
                        <span style="font-size: 16px; "><strong>Reporte de Ventas del Día </strong></span>
                    @else
                        <span style="font-size: 16px; "><strong>Reporte de Ventas por fecha </strong></span>
                    @endif
                    <br>
                    @if ($reportType != 0)
                        <span style="font-size: 16px; "><strong>Fecha de Consulta: </strong>{{ $dateFrom }} al
                            {{ $dateTo }}</span>
                    @else
                        <span style="font-size: 16px; "><strong>Fecha de Consulta:
                            </strong>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span>
                    @endif
                    <br>
                    <span style="font-size: 14px">Usuario: {{ $user }}</span>
                </td>
            </tr>
        </table>
    </section>

    <section style="margin-top: -110px">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>
                    <th class="text-center" width="5%">ID</th>
                    <th class="text-center" width="15%">FECHA</th>
                    <th class="text-center" width="10%">ESTADO</th>
                    <th class="text-center" width="22%">USUARIO</th>
                    <th class="text-center" width="22%">CLIENTE</th>
                    <th class="text-center" width="6%">ITEMS</th>
                    <th class="text-center" width="20%">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $item->id }}</td>
                        <td class="text-center">{{ $item->created_at->format('d/n/Y') }}</td>
                        <td>{{ $item->estado }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->cliente->razon_social }}</td>
                        <td align="right">{{ number_format($item->items, 2) }}</td>
                        <td align="right">{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" align="right"><strong>TOTALES</strong></td>
                    <td align="right">{{ number_format($data->sum('items'), 2) }}</td>
                    <td align="right">{{ number_format($data->sum('total'), 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </section>

    <section class="footer">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <tr>
                <td width="20%">
                    <span>Sistema Ofibol V1</span>
                </td>
                <td class="text-center" width="60%">
                    Ofibol.com
                </td>
                <td class="text-center" width="20%">
                    <span class="pagenum"></span>
                </td>
            </tr>
        </table>
    </section>
</body>

</html>
