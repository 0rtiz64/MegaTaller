<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 15/7/2018
 * Time: 21:57
 */


include '../funciones/enlace.php';

$modelo= $_POST['phpModelo'];




$queryConfirmar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from modelos where descripcion =  '".$modelo."'  "));

if($queryConfirmar>0){
    echo 0;
}else{
    $queryGuardar = mysqli_query($enlace,"insert into modelos(descripcion,estado) values 
	('".$modelo."',1)");


    echo'<div class="input-group">';
    echo'<div class="input-group-addon  btn btn-primary" onclick="modalNuevoModelo()">';
    echo'<i class="fa fa-plus-circle"></i>';
    echo'</div>';
    echo'<select  id="marcaNuevaOrden" class="form-control">';
    echo'<option value="">MARCA</option>';
    $queryModelos = mysqli_query($enlace,"SELECT * from modelos WHERE estado = 1 GROUP BY descripcion ASC");

    while($datosModelos = mysqli_fetch_array($queryModelos,MYSQLI_ASSOC)){
        echo'<option value="'.$datosModelos["idModelo"].'">'.$datosModelos["descripcion"].'</option>';
    }
    echo'</select>';
    echo '</div>';
}

?>