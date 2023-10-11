
var table;

$(document).ready(function () {
    table = $('#ventas').DataTable({
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
                columns: ':not(:eq(8))' //excluyendo la fila de opciones
            },
        },
        {
            extend: 'pdf',
            pageSize: 'A4',
            //quiero que las columnas ocupen todo el ancho de la pagina
            customize: function (doc) {
                doc.defaultStyle.alignment = 'center';
                doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
            },
            exportOptions: {
                modifier: {
                    page: 'current'
                },
                columns: ':not(:eq(8))'
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
    table.buttons().container().appendTo('#ventas_wrapper .col-md-6:eq(0)');
});


Livewire.on('mostrarAlerta', ventaId => {
    Swal.fire({
        title: '¿Estás seguro de eliminar esta venta?',
        text: "No se podrán revertir los cambios..!!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar venta',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            //Eliminar cliente, emitiendo el evento y pasandole el id
            Livewire.emit('eliminarVenta', ventaId);
            /* Datatabla no se carga a partir de este punto */
            //Volver a cartar los datos de la tabla con datatables

            // Después de eliminar la venta con éxito

            Swal.fire(
                'Venta eliminada!',
                'La venta ha sido eliminada con éxito',
                'success'
            ).then(() => {
                // Actualizar la página para volver a renderizar la vista
                location.reload();
            });
        }
    })
});