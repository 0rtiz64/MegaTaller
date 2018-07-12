<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 12/7/2018
 * Time: 4:24 PM
 */
include '../funciones/enlace.php';

$idUsuario = $_POST['idUsuario'];

$confirm =mysqli_num_rows(mysqli_query($enlace,"SELECT * from notificaciones WHERE idRecibe = $idUsuario and estado =1"));

if($confirm >0){
    $Querynotificaciones = mysqli_query($enlace,"SELECT * from notificaciones 
INNER JOIN usuarios ON notificaciones.idRecibe = usuarios.idUsuario
INNER JOIN usuarios as usuarios2 ON notificaciones.idProduce = usuarios2.idUsuario
WHERE notificaciones.idRecibe = $idUsuario and notificaciones.estado=1");


    $QuerycontarNotificaciones= mysqli_query($enlace,"SELECT COUNT(*) as cantidad  from notificaciones 
WHERE notificaciones.idRecibe = $idUsuario and notificaciones.estado=1");
    $datosCantidadNotificaciones = mysqli_fetch_array($QuerycontarNotificaciones);
    while ($datosNotificaciones = mysqli_fetch_array($Querynotificaciones,MYSQLI_ASSOC)){
        $notificaciones = '
          <div class="notifi-dropdown js-dropdown">
                                        <div class="notifi__title">
                                            <p>Tienes '.$datosCantidadNotificaciones["cantidad"].' notificaciones pendientes</p>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <p>'.$datosNotificaciones["nombre"].'</p>
                                                <span class="date">'.$datosNotificaciones["mensaje"].'</span>
                                            </div>
                                        </div>
                                    </div>
        ';
    }
}else{

}