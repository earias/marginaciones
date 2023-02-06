function msg_type(type,title,msg){
    Swal.fire({
        title: title,
        text: msg,
        type: type,
        confirmButtonClass: 'btn btn-'+type,
    })
}

function autClose(title){
    var timerInterval
    Swal.fire({
        title: title,
        timer: 2000,
        confirmButtonClass: 'btn btn-primary',
        buttonsStyling: false,
        onBeforeOpen: function () {
            Swal.showLoading()
            timerInterval = setInterval(function () {
                Swal.getContent().querySelector('strong').textContent = Swal.getTimerLeft()
            }, 100)
        },
        onClose: function () {
            clearInterval(timerInterval)
        },
        allowOutsideClick: function () {
            !Swal.isLoading()
        }
    }).then(function (result) {
        if (result.dismiss === Swal.DismissReason.timer) {
            // al cerrar alert
        }
    })
}