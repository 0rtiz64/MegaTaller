$(document).ready(function(){

    $("#password").on('keyup', function (e) {
        if (e.keyCode == 13) {
            var email = $('#userInput').val();
            var password = $('#passInput').val();

            if(email.trim().length == ""){
                $('#usuarioAlert').slideDown(500);
                return false;
            }else{
                $('#usuarioAlert').slideUp(300);
                if(password.trim().length == ""){
                    $('#passAlert').slideDown(500);
                    $('#passInput').focus();
                    return false;
                }else{
                    $('#passAlert').slideUp(300);
                }
            }

            $.ajax({
                url:'Model/ingreso.php',
                type:'POST',
                data:'email='+email+'&password='+password+"&boton=ingresar"
            }).done(function(resp){
                if(resp=='0'){
                    $('#passInput').val("");
                    $('#passAlert').slideDown(500);
                    $('#passInput').focus();
                }else if(resp=='1'){
                    location.href='views/index.php';
                }
                else{
                    location.href=resp;
                }
            });
        }
    });

});//FIN DE DOCUMENT




function confirmar(){

    var email = $('#userInput').val();
    var password = $('#passInput').val();

    if(email.trim().length == ""){
        $('#usuarioAlert').slideDown(500);
        return false;
    }else{
        $('#usuarioAlert').slideUp(300);
        if(password.trim().length == ""){
            $('#passAlert').slideDown(500);
            $('#passInput').focus();
            return false;
        }else{
            $('#passAlert').slideUp(300);
        }
    }

    $.ajax({
        url:'php/ingreso.php',
        type:'POST',
        data:'email='+email+'&password='+password+"&boton=ingresar"
    }).done(function(resp){
        if(resp=='0'){
            $('#password').val("");
            $('#errorContra').html('Contraseña Incorrecta.').slideDown(500);
            $('#password').focus();
        }else if(resp=='1'){
            location.href='Views/index.php';
        }
        else{
            location.href=resp;
        }
    });
}