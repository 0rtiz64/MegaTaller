
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
// FIN GUARDAR CLIENTE

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


//INICIO GUARDAR MODELO
function guardarModeloNueva(){
    var modelo1 = $('#inputModeloNuevo').val();

    var modelo =modelo1.toUpperCase();


    var url = '../Model/ordenesGuardarModelo.php';

    if(modelo.trim().length ==""){
        $('#inputModeloNuevo').addClass('is-invalid');
        alertify.error("MODELO VACIO");
        return false;
    }else {
        $('#inputModeloNuevo').removeClass('is-invalid');
        $('#inputModeloNuevo').addClass('is-valid');
    }


    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpModelo: modelo
        },
        success: function(respuesta){

            if(respuesta == 0){
                alertify.error("MODELO DUPLICADO");
                $('#inputModeloNuevo').val("");
            }else{
                $('#inputModeloNuevo').val("");
                alertify.success("MODELO GUARDADO");
                $('#divNuevoModelos').html(respuesta);
                $('#modalNuevoModelo').modal('hide');
            }

            //SUCCESS

            return false;


        }
    });

    return false;
}
//FIN GUARDAR MODELO

//FIN GUARDAR //


//INICIO AGREGAR EQUPO A ORDEN
var equiposEnOrden = [];

function agregarEquipo() {
    var marca = document.getElementById('marcaNuevaOrden').value;
    var modelo = document.getElementById('modeloNuevaOrden').value;
    var serie1  = $('#inputSerieEquipo').val();
    var falla1  = $('#inputFallaEquipo').val();
    var numeroParte1  = $('#inputNumeroParte').val();
    var incluye1  = $('#inputIncluye').val();


    var  serie =serie1.trim().toUpperCase();
    var  falla =falla1.trim().toUpperCase();
    var  numeroParte =numeroParte1.trim().toUpperCase();
    var  incluye =incluye1.trim().toUpperCase();

var url ='../Model/ordenesAgregarEquipo.php';

    if(marca.trim().length ==""){
        $('#marcaNuevaOrden').addClass('is-invalid');
        alertify.error("MARCA VACIA");
        return false;
    }else{
        $('#marcaNuevaOrden').removeClass('is-invalid');
        $('#marcaNuevaOrden').addClass('is-valid');
        if(modelo.trim().length==""){
            $('#modeloNuevaOrden').addClass('is-invalid');
            alertify.error("MODELO VACIO");
            return false;
        }else{
            $('#modeloNuevaOrden').removeClass('is-invalid');
            $('#modeloNuevaOrden').addClass('is-valid');
            if(serie.trim().length ==""){
                $('#inputSerieEquipo').addClass('is-invalid');
                alertify.error("SERIE VACIA");
                return false;
            }else{
                $('#inputSerieEquipo').removeClass('is-invalid');
                $('#inputSerieEquipo').addClass('is-valid');
                if(falla.trim().length ==""){
                    $('#inputFallaEquipo').addClass('is-invalid');
                    alertify.error("FALLA VACIA");
                    return false;
                }else{
                    $('#inputFallaEquipo').removeClass('is-invalid');
                    $('#inputFallaEquipo').addClass('is-valid');
                }// FIN FALLA
            }//FIN SERIE
        }// FIN MODELO
    }//FIN MARCA


    if (equiposEnOrden.includes(serie)== true){
        alertify.error("EQUIPO DUPLICADO");
        return false;
    }// FIN ESTA EN ARRAY
    equiposEnOrden.push(serie);

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpMarca: marca,
            phpModelo: modelo,
            phpSerie: serie,
            phpFalla: falla,
            phpPn: numeroParte,
            phpIncluye: incluye
        },
        success: function(respuesta){

            add(respuesta);

            return false;


        }
    });

}

var cont = 0;
function add(fila) {

    cont++;
    $('#tablaEquiposEnOrden').append(fila);
    $('#marcaNuevaOrden').val("");
    $('#modeloNuevaOrden').val("");
    $('#inputSerieEquipo').val("");
    $('#inputFallaEquipo').val("");
    $('#inputNumeroParte').val("");
    $('#inputIncluye').val("");

}

function remover(serie){
    $('#'+serie).remove();
    cont= cont-1;
    var  indice = equiposEnOrden.indexOf(serie);
    if (indice == -1){
        alertify.error("Se produjo un error, notificar al desarrollador");
    }else{
        equiposEnOrden.splice(indice,1);

    }


}

//FIN AGREGAR EQUIPO A ORDEN

//INICIO CONFIRMAR ORDEN
function confirmarOrden(){
    var cliente = document.getElementById('');
    var nombreContacto = $('#').val();
    var numeroContacto = $('#').val();


}
//FIN CONFIRMAR ORDEN
