@extends('adminlte::page')

@section('title', 'productos')

@section('content')

    @if (session()->has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('mensaje') }}
        </div>
    @endif

    <livewire:mostrar-productos />
@stop

@section('css'){{-- 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}

    {{-- El cdn de select con buscador --}}
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-select.min.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">
    {{-- Estilos de la plantilla lw pos --}}
    <link rel="stylesheet" href="{{ asset('apps/scrumboard.css') }}">
    <link rel="stylesheet" href="{{ asset('apps/notes.css') }}">
    {{-- Encabezados fijos --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.dataTables.min.css">
    <style>
        .my-custom-img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
@stop

@section('js')
    {{-- El script de select con buscador --}}
    <script src="{{ asset('dist/js/bootstrap-select.min.js') }}"></script>
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
    {{-- encabezados fijos --}}
    <script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#productos').DataTable({
                fixedHeader: true,
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
                    }, , 'csv', {
                        extend: 'excel',
                        text: 'Excel',
                        exportOptions: {
                            modifier: {
                                // Exportar solo las filas que están actualmente en la vista (las que se muestran)
                                page: 'current'
                            },
                            columns: ':not(:eq(1),:eq(8),:eq(9))' //excluyendo la fila de opciones
                        },
                    },
                    {
                        extend: 'pdf',
                        /* orientacion de papel horizontal */
                        orientation: 'landscape',

                        //quiero que las columnas ocupen todo el ancho de la pagina
                        customize: function(doc) {
                            doc.defaultStyle.alignment = 'center';
                            doc.content[1].table.widths = Array(doc.content[1].table.body[0]
                                .length + 1).join('*').split('');
                        },
                        exportOptions: {
                            modifier: {
                                // Exportar solo las filas que están actualmente en la vista (las que se muestran)
                                page: 'current'
                            },
                            columns: ':not(:eq(1),:eq(8),:eq(9))'
                        },
                    }, {
                        extend: 'print',
                        text: 'Imprimir',
                        exportOptions: {
                            modifier: {
                                // Exportar solo las filas que están actualmente en la vista (las que se muestran)
                                page: 'current'
                            },
                            columns: ':not(:eq(1),:eq(8),:eq(9))' //excluyendo la fila de opcionesF
                        },
                    }, {
                        extend: 'colvis',
                        text: 'Ver Columnas',
                    },
                ]
            });
            table.buttons().container().appendTo('#productos_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        // El siguiente código es el Alert utilizado para activar e inactivar
        Livewire.on('alertaInactivar', productoId => {
            Swal.fire({
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
                    //Eliminar cliente, emitiendo el evento y pasandole el id
                    Livewire.emit('inactivarProducto', productoId);
                    /* Datatabla no se carga a partir de este punto */
                    Swal.fire(
                        '¡Producto inactivado!',
                        'El producto ha sido inactivado con éxito.',
                        'success'
                    ).then(() => {
                        // Actualizar la página para volver a renderizar la vista
                        location.reload();
                    });
                }
            })
        })

        Livewire.on('alertaActivar', productoId => {
            // Mostramos un mensaje de confirmación
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'El producto pasará a un estado activo', // Cambiado el mensaje
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, activar', // Cambiado el texto del botón
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    //Eliminar cliente, emitiendo el evento y pasandole el id
                    Livewire.emit('activarProducto', productoId);
                    /* Datatabla no se carga a partir de este punto */
                    Swal.fire(
                        '¡Producto activado!',
                        'El producto ha sido activado con éxito.',
                        'success'
                    ).then(() => {
                        // Actualizar la página para volver a renderizar la vista
                        location.reload();
                    });
                }
            })
        });

        /* Script para tooltip*/
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        /* Evento de livewire */
        document.addEventListener('DOMContentLoaded', function() {
            //eventos
            Livewire.on('show-modal', Msg => {
                $('#detallesStockModal').modal('show');
            });
        });
    </script>
@stop
