$(".formulario-eliminar").submit(function (e) {
    e.preventDefault();
    Swal.fire({
        title: '¿Está seguro?',
        text: '¡ No podrá recuperar este registro !',
        icon: 'warning',	/*icono que va mostrar success-error-info-warning-question*/
        showCancelButton: true,
        confirmButtonColor: '#2CB073',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Salir',
        reverseButtons: true,
        //width:'300px',
        padding: '20px',
        background: 'rgb(139, 198, 223)',
        backdrop: true,	/* color oscuro de la pagina true-false */

        position: 'top',	/* posicion de ubicacion top--bottom--center top-end bottom-end top-start */
        /* bottom-start center-start center-end */

        allowOutsideClick: true,	/* para NO salir con un click */
        allowEscapeKey: true,	/* para SI salir con un escape */
        allowEnterKey: false,	/* para SI salir con un enter */

    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            this.submit();
        }
    })
})


