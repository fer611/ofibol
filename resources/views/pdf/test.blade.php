<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <section class="header" style="top:-287px;">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td colspan="2" class="text-center">
                    <span style="font-size: 25px; font-weight: bold;">OFIBOL</span>
                </td>
            </tr>
            <tr>
                <td width="30%" style="vertical-align: top; padding-top: 10px; position: relative">
                    <img src="#" alt="imagen logo" class="invoice-logo">
                </td>
                <td width="70%" class="text-left text-company" style="vertical-align: top; padding-top: 10px">
                    @if ($reportType == 0)
                        {{-- si es 0 es del dia --}}
                        <span style="font-size: 16px"><strong>Reporte de Ventas del Día</strong></span>
                    @else
                        {{-- si es 1 es reporte por fechas --}}
                        <span style="font-size: 16px"><strong>Reporte de Ventas por Fechas</strong></span>
                    @endif
                    <br>
                    @if ($reportType != 0)
                        <span style="font-size: 14px"><strong>Desde:</strong> {{ $dateFrom }}</span>
                        <br>
                        <span style="font-size: 14px"><strong>Hasta:</strong> {{ $dateTo }}</span>
                    @else
                        <span style="font-size: 14px"><strong>Fecha:</strong>
                            {{ \Carbon\Carbon::now()->format('d-M-Y') }}</span>
                    @endif
                    <br>
                    <span style="font-size: 14px"><strong>Usuario:</strong> {{ $user }}</span>
                </td>
            </tr>
        </table>
    </section>
    <section style="margin-top: -110px">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>
                    <th width="10%">FOLIO</th>
                    <th width="12%">TOTAL</th>
                    <th width="10%">ITEMS</th>
                    <th width="12%">ESTADO</th>
                    <th>USUARIO</th>
                    <th width="18%">FECHA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $item->id }}</td>
                        <td class="text-right">{{ number_format($item->total, 2) }}</td>
                        <td class="text-right">{{ $item->items }}</td>
                        <td class="text-center">{{ $item->estado }}</td>
                        <td class="text-center">{{ $item->user->name }}</td>
                        <td class="text-center">{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td class="text-center">
                        <span><b>TOTALES</b></span>
                    </td>
                    <td colspan="1" class="text-right">
                        <span><strong>Bs. {{ number_format($data->sum('total'), 2) }}</strong></span>
                    </td>
                    <td class="text-right">
                        {{ $data->sum('items') }}
                    </td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </section>
    <section class="footer">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <tr>
                <td width="20%">
                    <span>SISTEMA OFIBOL v1</span>
                </td>
                <td width="60%" class="text-center">
                    <span>Ofibol.com</span>
                </td>
                <td class="text-center" width="20%">
                    Página <span class="pagenum"></span>
                </td>
            </tr>
        </table>
    </section>
</body>

</html>
