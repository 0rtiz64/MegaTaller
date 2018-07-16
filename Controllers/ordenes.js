
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });
});

// INICIO MODALES//
function abrirModal(){
    $('#largeModalOrdenesServicio').modal({
        show:true,
        backdrop:'static'
    });//FIN ABRIR MODAL
}


function modalNuevoCliente(){
    $('#modalNuevoCliente').modal({
        show:true,
        backdrop:'static'
    });//FIN ABRIR MODAL
}


function modalNuevaMarca(){
    $('#modalNuevaMarca').modal({
        show:true,
        backdrop:'static'
    });//FIN ABRIR MODAL
}

function modalNuevoModelo(){
    $('#modalNuevoModelo').modal({
        show:true,
        backdrop:'static'
    });//FIN ABRIR MODAL
}
// FIN MODALES


//INICIO GUARDAR //

//INICIO GUARDAR CLIENTE//
function guardarClienteNuevo() {
    var cliente1 = $('#nombreNuevoCliente').val();
    var idVendedor = document.getElementById('nuevoClienteVendedor').value;
    var direccion1 = $('#direccionNuevoCliente').val();

    var cliente =cliente1.toUpperCase();
    var direccion =direccion1.trim().toUpperCase();

    var url = '../Model/ordenesGuardarCliente.php';

   if(cliente.trim().length ==""){
       $('#nombreNuevoCliente').addClass('is-invalid');
       alertify.error("CLIENTE VACIO");
       return false;
   }else{
       $('#nombreNuevoCliente').removeClass('is-invalid');
       $('#nombreNuevoCliente').addClass('is-valid');
        if(idVendedor.trim().length==""){
            $('#nuevoClienteVendedor').addClass('is-invalid');
            alertify.error("VENDEDOR VACIO");
            return false;
        }else{
            $('#nuevoClienteVendedor').removeClass('is-invalid');
            $('#nuevoClienteVendedor').addClass('is-valid');
        }
   }


    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpNombreCliente: cliente,
            phpidVendedor: idVendedor,
            phpDireccion: direccion
        },
        success: function(respuesta){

            if(respuesta == 0){
                alertify.error("CLIENTE DUPLICADO");
                $('#nombreNuevoCliente').val("");
                $('#nuevoClienteVendedor').val("");
                $('#direccionNuevoCliente').val("");
            }else{
                $('#nombreNuevoCliente').val("");
                $('#nuevoClienteVendedor').val("");
                $('#direccionNuevoCliente').val("");
                alertify.success("CLIENTE GUARDADO");
                $('#divClientes').html(respuesta);
                $('#modalNuevoCliente').modal('hide');
            }

            //SUCCESS

            return false;


        }
    });

   return false;
}


//INICIO GUARDAR MARCA
function guardarMarcaNueva(){
    var marca1 = $('#inputMarcaNueva').val();

    var marca =marca1.toUpperCase();


    var url = '../Model/ordenesGuardarMarca.php';

    if(marca.trim().length ==""){
        $('#inputMarcaNueva').addClass('is-invalid');
        alertify.error("MARCA VACIO");
        return false;
    }else {
        $('#inputMarcaNueva').removeClass('is-invalid');
        $('#inputMarcaNueva').addClass('is-valid');
    }


    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpMarca: marca
        },
        success: function(respuesta){

            if(respuesta == 0){
                alertify.error("MARCA DUPLICADA");
                $('#inputMarcaNueva').val("");
            }else{
                $('#inputMarcaNueva').val("");
                alertify.success("MARCA GUARDADA");
                $('#divNuevaMarca').html(respuesta);
                $('#modalNuevaMarca').modal('hide');
            }

            //SUCCESS

            return false;


        }
    });

    return false;
}
//FIN GUARDAR MARCA

//FIN GUARDAR CLIENTE//
//FIN GUARDAR //



