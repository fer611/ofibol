@extends('adminlte::page')

@section('title', 'Licitaciones')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">LISTADO DE FACTURAS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Facturas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('mensaje') }}
        </div>
    @endif

    {{-- Aca el componente livewire --}}
    <livewire:mostrar-facturas />
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">
    {{-- Encabezados fijos --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.dataTables.min.css">

    {{-- CDN select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@stop

@section('js')

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
    {{-- encabezados fijos --}}
    <script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>

    {{-- CDN select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // Crear una variable global para almacenar la instancia de DataTables
        var table;
        $(document).ready(function() {
            table = $('#facturas').DataTable({
                fixedHeader: true,
                pageLength: 10, // Cantidad inicial de registros por página
                responsive: true,
                autoWidth: false,
                order: [
                    [0, 'desc'] // 0 es el índice de la columna 'id'
                ],
                "language": {
                    "lengthMenu": "Mostrar " +
                        '<select class="custom-select custom-select-sm form-control form-control-sm">' +
                        '<option value=\'10\'>10</option>' +
                        '<option value=\'25\'>25</option>' +
                        '<option value=\'50\'>50</option>' +
                        '<option value=\'100\'>100</option>' +
                        '<option value=\'-1\'>All</option>' +
                        '</select>' +
                        " registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "Ningún dato disponible en esta tabla",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'copy',
                        text: 'Copiar',
                        exportOptions: {
                            modifier: {
                                // Exportar solo las filas que están actualmente en la vista (las que se muestran)
                                page: 'current'
                            }
                        },
                    }, 'csv', {
                        extend: 'excel',
                        text: 'Excel',
                        exportOptions: {
                            modifier: {
                                // Exportar solo las filas que están actualmente en la vista (las que se muestran)
                                page: 'current'
                            },
                            columns: ':not(:eq(8))' //excluyendo la fila de opciones
                        },
                    },
                    {
                        extend: 'pdf',
                        //orientation: 'landscape', // Orientación horizontal
                        pageSize: 'A4', // Tamaño del papel
                        exportOptions: {
                            modifier: {
                                // Exportar solo las filas que están actualmente en la vista (las que se muestran)
                                page: 'current'
                            },
                            columns: ':not(:eq(8))' // Excluye la columna 11 y 13 (0-indexadas)
                        }
                    }, {
                        extend: 'print',
                        text: 'Imprimir',
                        exportOptions: {
                            modifier: {
                                // Exportar solo las filas que están actualmente en la vista (las que se muestran)
                                page: 'current'
                            },
                            columns: ':not(:eq(8))' //excluyendo la fila de opcionesF
                        },
                    }, {
                        extend: 'colvis',
                        text: 'Ver Columnas',
                    },
                ]
            });
            table.buttons().container().appendTo('#clientes_wrapper .col-md-6:eq(0)');
        });

        /* Evento de livewire */
        document.addEventListener('DOMContentLoaded', function() {
            //eventos
            Livewire.on('show-modal', Msg => {
                $('#notaModal').modal('show');
            });
        });
    </script>

@stop
