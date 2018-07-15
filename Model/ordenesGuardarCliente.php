<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 15/7/2018
 * Time: 14:30
 */
include '../funciones/enlace.php';

$nombreCliente = $_POST['phpNombreCliente'];
$idVendedor = $_POST['phpidVendedor'];
$direccion = $_POST['phpDireccion'];
$fechaentrada = date('Y-m-d  h:i:s');


$queryConfirmar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from clientes where nombre = '".$nombreCliente."'  "));

if($queryConfirmar>0){
    echo 0;
}else{
$queryGuardar = mysqli_query($enlace,"insert into clientes(idVendedor,nombre,direccion,fechaRegistro,estado) values 
	($idVendedor,'".$nombreCliente."','".$direccion."','".$fechaentrada."',1)");
$queryConsultarClientes = mysqli_query($enlace,"SELECT * from clientes WHERE estado = 1 GROUP BY nombre ASC");

    echo'<div class="input-group">';
        echo'<div class="input-group-addon  btn btn-primary" onclick="modalNuevoCliente()">';
            echo'<i class="fa fa-plus-circle"></i>';
        echo'</div>';
            echo'<select  id="clienteNuevaOrden" class="form-control">';
                echo'<option value="">CLIENTE</option>';
while($datosClientesQuery = mysqli_fetch_array($queryConsultarClientes,MYSQLI_ASSOC)){
    echo ' <option value="'.$datosClientesQuery["idCliente"].'">'.$datosClientesQuery["nombre"].'</option>';
}
    echo'</select>';
echo '</div>';
}

?>