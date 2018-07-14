
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });
});

function abrirModal(){
    $('#largeModalOrdenesServicio').modal({
        show:true,
        backdrop:'static'
    });//FIN ABRIR MODAL
}