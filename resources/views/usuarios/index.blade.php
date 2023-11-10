@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">LISTA DE USUARIOS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
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

    <livewire:mostrar-usuarios :usuarios="$usuarios" />
@stop

@section('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usuarios').DataTable({
                responsive: true,
                autoWidth: false,
                /* language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                } */
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
                            columns: ':not(:eq(6))' //excluyendo la fila de opciones
                        },
                    },
                    {

                        extend: 'pdf',
                        pageSize: 'A4',
                        exportOptions: {
                            modifier: {
                                page: 'current'
                            },
                            columns: ':not(:eq(5))'
                        },
                        // Personalizar la apariencia del PDF
                        customize: function(doc) {
                            doc.defaultStyle.alignment =
                            'center'; // Configura la alineación predeterminada
                            doc.content[1].table.widths = Array(doc.content[1].table.body[0]
                                .length + 1).join('*').split('');

                            // Configura la alineación izquierda para la primera y segunda columna (0 y 1)
                            doc.content[1].table.widths[0] = 30;
                            doc.content[1].table.body.forEach(function(row) {
                                if (row) {
                                    row[1].alignment = 'left';
                                    row[2].alignment = 'left';
                                }
                            });
                        },
                        exportOptions: {
                            modifier: {
                                page: 'current'
                            },
                            columns: ':not(:eq(5))'
                        }

                    }, {
                        extend: 'print',
                        text: 'Imprimir',
                        exportOptions: {
                            modifier: {
                                // Exportar solo las filas que están actualmente en la vista (las que se muestran)
                                page: 'current'
                            },
                            columns: ':not(:eq(6))' //excluyendo la fila de opcionesF
                        },
                    }, {
                        extend: 'colvis',
                        text: 'Ver Columnas',
                    },
                ]
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(function(deleteButton) {
                deleteButton.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const estado = this.getAttribute('data-estado');
                    const texto = estado === '1' ?
                        '¿Estás seguro de que quieres desactivar este usuario?' :
                        '¿Quieres activar este usuario?';

                    Swal.fire({
                        title: texto,
                        text: "",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            sessionStorage.setItem('deleted', 'true');
                            sessionStorage.setItem('estado', estado);
                            document.getElementById(`deleteForm-${id}`).submit();
                        }
                    })
                });
            });

            // Verificar si se debe mostrar el segundo SweetAlert
            if (sessionStorage.getItem('deleted') === 'true') {
                const estado = sessionStorage.getItem('estado');
                let mensaje = '';
                if (estado === '1') {
                    mensaje = 'La cuenta del usuario está inactiva.';
                } else {
                    mensaje = 'La cuenta del usuario está activa.';
                }
                Swal.fire(
                    'Realizado!',
                    mensaje,
                    'success'
                );
                sessionStorage.removeItem('deleted'); // Limpiar la variable para futuras recargas
                sessionStorage.removeItem('estado'); // Limpiar la variable para futuras recargas
            }
        });
    </script>
@stop
