<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 15/7/2018
 * Time: 20:54
 */

include '../funciones/enlace.php';

$marca = $_POST['phpMarca'];

$fechaentrada = date('Y-m-d  h:i:s');


$queryConfirmar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from marcas where descripcion = '".$marca."'  "));

if($queryConfirmar>0){
    echo 0;
}else{
    $queryGuardar = mysqli_query($enlace,"insert into marcas(descripcion,estado) values 
	('".$marca."',1)");
    $queryConsultarClientes = mysqli_query($enlace,"SELECT * from clientes WHERE estado = 1 GROUP BY nombre ASC");

    echo'<div class="input-group">';
    echo'<div class="input-group-addon  btn btn-primary" onclick="modalNuevaMarca()">';
    echo'<i class="fa fa-plus-circle"></i>';
    echo'</div>';
    echo'<select  id="marcaNuevaOrden" class="form-control">';
    echo'<option value="">MARCA</option>';
    $queryMarcas = mysqli_query($enlace,"SELECT * from marcas WHERE estado = 1 GROUP BY descripcion ASC");

    while($datosMarcas = mysqli_fetch_array($queryMarcas,MYSQLI_ASSOC)){
        echo'<option value="'.$datosMarcas["idMarca"].'">'.$datosMarcas["descripcion"].'</option>';
    }
    echo'</select>';
    echo '</div>';
}

?>