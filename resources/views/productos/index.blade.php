@extends('adminlte::page')

@section('title', 'productos')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">LISTADO DE PRODUCTOS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">productos</li>
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

    <livewire:mostrar-productos :productos="$productos" />
@stop

@section('css'){{-- 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">
    <style>
        .my-custom-img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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
    <script>
        $(document).ready(function() {
            var table = $('#productos').DataTable({
                responsive: true,
                autoWidth: false,
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
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel',
                    {
                        extend: 'pdf',
                        orientation: 'landscape', // Orientación horizontal
                        pageSize: 'LEGAL', // Tamaño del papel
                        exportOptions: {
                            columns: ':not(:eq(11), :eq(13))' // Excluye la columna 11 y 13 (0-indexadas)
                        }
                    }, 'print', 'colvis'
                ]
            });
            table.buttons().container().appendTo('#productos_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        // El siguiente código es el Alert utilizado
        /* Swal.fire({
            title: '¡Estas seguro?',
            text: "El producto pasará a un estado inactivo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, inactivar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        }) */
    </script>
@stop
