@extends('adminlte::page')
@section('title', 'Dashboard')


@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tablero Principal</h1>
                    <a href="#" class="btn btn-dark"> Enviar Notificación</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Tablero Principal</li>

                        
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@stop
@section('content')
    <!-- Main content -->
    <div class="content">

        <div class="container-fluid">

            <!-- row Tarjetas Informativas -->
            <div class="row">

                <div class="col-lg-2">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4 id="">{{ $productos->count() }}</h4>
                            <p>Productos registrados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="{{ route('productos.index') }}" class="small-box-footer">Mas Info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- TARJETA TOTAL COMPRAS -->
                <div class="col-lg-2">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4 id="totalCompras">Bs. {{ $totalCompras }}</h4>
                            <p>Total Compras</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                        <a style="cursor:pointer;" href="{{ route('ingresos.index') }}" class="small-box-footer">Mas Info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- TARJETA TOTAL VENTAS -->
                <div class="col-lg-2">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h4 id="totalVentas">Bs. {{ $totalVentas }}</h4>

                            <p>Total Ventas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-cart"></i>
                        </div>
                        <a href="{{ route('ventas.index') }}" style="cursor:pointer;" class="small-box-footer">Mas Info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- TARJETA TOTAL GANANCIAS -->
                <div class="col-lg-2">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h4 id="totalGanancias">Bs. {{ $totalGanancias }}</h4>

                            <p>Total Ganancias</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-pie"></i>
                        </div>
                        <a href="{{ route('ventas.index') }}" style="cursor:pointer;" class="small-box-footer">Mas Info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- TARJETA PRODUCTOS POCO STOCK -->
                <div class="col-lg-2">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h4 id="totalProductosMinStock">{{ $productosPocoStock->count() }}</h4>
                            <p>Productos poco stock</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-remove-circle"></i>
                        </div>
                        <a href="{{ route('productos.pdf') }}" target="_blank" style="cursor:pointer;" class="small-box-footer">Mas Info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- TARJETA TOTAL VENTAS DIA ACTUAL -->
                <div class="col-lg-2">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h4 id="totalVentasHoy">Bs. {{ $totalVentasDia }}</h4>

                            <p>Ventas del día</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-calendar"></i>
                        </div>
                        <a href="{{ route('reportes.index') }}" style="cursor:pointer;" class="small-box-footer">Mas Info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>


            </div> <!-- ./row Tarjetas Informativas -->

            <!-- row Grafico de barras -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title" id="title-header">Ventas del Mes: Bs:
                                {{ number_format($total_venta_mes, 2) }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div> <!-- ./ end card-tools -->
                        </div> <!-- ./ end card-header -->
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;">
                                </canvas>
                            </div>
                        </div> <!-- ./ end card-body -->
                    </div>
                </div>
            </div><!-- ./row Grafico de barras -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Los 10 productos mas vendidos</h3>
                            <div class="card-tools">
                                <a href="{{ route('masVendidos.pdf') }}" class="btn btn-danger" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div> <!-- ./ end card-tools -->
                        </div> <!-- ./ end card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="tbl_productos_mas_vendidos">
                                    <thead>
                                        <tr class="text-danger">
                                            <th>ID</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Ventas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productosMasVendidos as $producto)
                                            <tr>
                                                <td>{{ $producto->id }}</td>
                                                <td>{{ $producto->descripcion }}</td>
                                                <td>{{ $producto->cantidad }}</td>
                                                <td>{{ number_format($producto->total_ventas, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- ./ end card-body -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Listado de productos con poco stock</h3>
                            <div class="card-tools">
                                <a href="{{ route('productos.pdf') }}" class="btn btn-danger" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>

                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div> <!-- ./ end card-tools -->
                        </div> <!-- ./ end card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="tbl_productos_poco_stock">
                                    <thead>
                                        <tr class="text-danger">
                                            <th>ID</th>
                                            <th>Producto</th>
                                            <th>Stock Actual</th>
                                            <th>Mín. Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productosPocoStock as $producto)
                                            <tr>
                                                <td>{{ $producto->id }}</td>
                                                <td>{{ $producto->descripcion }}</td>
                                                <td>{{ $producto->stock }}</td>
                                                <td>{{ $producto->stock_minimo }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- ./ end card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@stop

@section('css')

@stop

@section('js')
    {{-- Aca importamos Chart.min.js --}}
    <script src="{{ asset('dist/js/chart.js/Chart.min.js') }}"></script>
    <script>
        var fecha_venta = @json($fecha_venta);
        var total_venta = @json($total_venta);
        /* console.log(total_venta); */
        var barChartCanvas = $('#barChart').get(0).getContext('2d');
        var areaChartData = {
            labels: fecha_venta,
            datasets: [{
                label: 'Ventas del Mes',
                backgroundColor: 'rgba(60,141,188,0.9)',
                data: total_venta,
            }]
        }

        var barChartData = $.extend(true, {}, areaChartData);
        var temp0 = areaChartData.datasets[0];
        barChartData.datasets[0] = temp0;

        var barCharOptions = {
            maintainAspectRatio: false,
            responsive: true,
            events: false,
            legend: {
                display: true
            },
            animation: {
                duration: 500,
                easing: "easeOutQuart",
                onComplete: function() {
                    var ctx = this.chart.ctx;
                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal',
                        Chart.defaults.global.defaultFontFamily);
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';

                    this.data.datasets.forEach(function(dataset) {
                        for (var i = 0; i < dataset.data.length; i++) {
                            var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model;
                            var scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale
                                .maxHeight;

                            ctx.fillStyle = '#444';
                            var y_pos = model.y - 5;

                            if ((scale_max - model.y) / scale_max >= 0.93) {
                                y_pos = model.y + 20;
                            }

                            // Aquí deberías mostrar el valor de cada barra encima de la columna
                            ctx.fillText(dataset.data[i], model.x, y_pos);
                        }
                    });

                }
            }
        }

        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barCharOptions
        })
    </script>
@stop
