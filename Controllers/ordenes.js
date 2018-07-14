
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
function guardarClienteNuevo() {
    var cliente1 = $('#nombreNuevoCliente').val();
    var idVendedor1 = document.getElementById('nuevoClienteVendedor').value;
    var direccion1 = $('#direccionNuevoCliente').val();


}
//FIN GUARDAR //