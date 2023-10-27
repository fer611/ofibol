<script>
    $('.tblscroll').niceScroll({
        cursorcolor: "#515365",
        cursorwidth: "30px",
        background: "rgba(20,20,20,0.3)",
        cursorborder: "0px",
        cursorborderradius: 3
    })


    function Confirm(id, eventName, text) {
        Swal.fire({
            title: 'CONFIRMAR',
            text: text,
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit(eventName, id)
                swal.close()
            }
        })
    }


    /* Notificaciones */
    function noty(msg, option = 1) {

        Snackbar.show({
            text: msg.toUpperCase(),
            actionText: 'CERRAR',
            actionTextColor: '#ffff',
            backGroundColor: option == 1 ? '3b#3f5c' : '#e7515a',
            pos: 'top_right'
        });
    }
</script>
