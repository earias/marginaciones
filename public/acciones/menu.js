var registro             = 0;

$("#btn-show-modal").click(function() {

    var $_getValidationField    = document.getElementsByClassName('validation-text');

    $('#c-title').val('');
    $('#c-description').val('');
    $_getValidationField[0].style.display = 'none';
    $_getValidationField[1].style.display = 'none';

    $('#inlineForm').modal('show');
    $('#btn-add').css('display','block');
    $('#btn-edit').css('display','none');
   
}); 


$('body').on('click', '#items a', function(){
    var id      = $(this).data("id");
    var tipo    = $(this).attr('id');
    // editar
    if (tipo == 1) {
        editar(id);
    }else if(tipo == 2){ // Anular
        anular(id);
    }else if(tipo == 3){ // Activar
        activar(id);
    }else if(tipo == 4){
        eliminar(id);
    }
})

function editar(id){
    $('#btn-add').css('display','none');
    $('#btn-edit').css('display','block');

    $('#form-action').attr('action','/menu/update');
    $('#form-action').attr('method','PUT');

    var title        = $('#text-title-'+id).text();
    var url          = $('#text-url-'+id).text();
    var description  = $('#text-description-'+id).text();
    registro         = id;  
   
    $('#c-id').val(id);
    $('#titulo').val(title);
    $('#url').val(url);
    $('#descripcion').val(description);

}



function eliminar(id) {
    Swal.fire({
        title: 'Quiere eliminar este registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!',
        confirmButtonClass: 'btn btn-warning',
        cancelButtonText: 'Cancelar',
        cancelButtonClass: 'btn btn-danger ml-1',
        buttonsStyling: false,
        allowOutsideClick: function () {
            !Swal.isLoading()
        },
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: '/menu/delete/'+id,
                data: $(this).serialize(),
                success: function(data) {
                    if (data.type == 'success'){
                        
                        autClose(data.title);
                        setTimeout(function(){ location.reload(); }, 1500);
                        
                    }else if(data.type == 'error'){ 
                        msg_type(data.type,data.title,'');
                    }
                }   
            });
            
        }
        else if (result.dismiss === Swal.DismissReason.cancel) {
            msg_type('success','Tu registro imaginario ha sido salvado','');
        }
    })
}
 
function activar(id){

    Swal.fire({
        title: 'Activar Registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, activar!',
        confirmButtonClass: 'btn btn-warning',
        cancelButtonText: 'Cancelar',
        cancelButtonClass: 'btn btn-info ml-1',
        buttonsStyling: false,
        allowOutsideClick: function () {
            !Swal.isLoading()
        },
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: '/menu/activar/'+id,
                data: $(this).serialize(),
                success: function(data) {
                    if (data.type == 'success'){
                        
                        autClose(data.title);
                        setTimeout(function(){ location.reload(); }, 1500);
                        
                    }else if(data.type == 'error'){ 
                        msg_type(data.type,data.title,'');
                    }
                }   
            });
            
        }
        else if (result.dismiss === Swal.DismissReason.cancel) {
            msg_type('success','Tu registro imaginario ha sido salvado','');
        }
    })
}

function anular(id){

    Swal.fire({
        title: 'Anular Registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, anular!',
        confirmButtonClass: 'btn btn-warning',
        cancelButtonText: 'Cancelar',
        cancelButtonClass: 'btn btn-info ml-1',
        buttonsStyling: false,
        allowOutsideClick: function () {
            !Swal.isLoading()
        },
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: '/menu/anular/'+id,
                data: $(this).serialize(),
                success: function(data) {
                    if (data.type == 'success'){
                        
                        autClose(data.title);
                        setTimeout(function(){ location.reload(); }, 1500);
                        
                    }else if(data.type == 'error'){ 
                        msg_type(data.type,data.title,'');
                    }
                }   
            });
            
        }
        else if (result.dismiss === Swal.DismissReason.cancel) {
            msg_type('success','Tu registro imaginario ha sido salvado','');
        }
    })
}