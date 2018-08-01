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


$queryConfirmar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from clientes where nombre = '".$nombreCliente."'"));

if($queryConfirmar>0){
    $datos = array(
        0 => 0,
        1 => 0,
    );
    echo json_encode($datos);
}else{
$queryGuardar = mysqli_query($enlace,"insert into clientes(idVendedor,nombre,direccion,fechaRegistro,estado) values 
	($idVendedor,'".$nombreCliente."','".$direccion."','".$fechaentrada."',1)");
$queryConsultarClientes = mysqli_query($enlace,"SELECT * from clientes WHERE estado = 1 GROUP BY nombre ASC");

$selectClientesModal= '
<div class="input-group">
    <div class="input-group-addon  btn btn-primary" onclick="modalNuevoCliente()">
        <i class="fa fa-plus-circle"></i>
    </div>
    <select  id="clienteNuevaOrden" class="form-control">
        <option value="">CLIENTE</option>
';

while($datosClientesQuery = mysqli_fetch_array($queryConsultarClientes,MYSQLI_ASSOC)){
    $selectClientesModal.='
        <option value="'.$datosClientesQuery["idCliente"].'">'.$datosClientesQuery["nombre"].'</option>
    ';

}
$selectClientesModal.='
    </select>
</div>
';


$selecClientesBusqueda ='
 <select id="selectClientesOrden" class="form-control">
            <option value="">CLIENTE</option>
';

            $queryClientesBusqueda= mysqli_query($enlace,"SELECT * from clientes where estado =1 GROUP BY nombre ASC");
            while ($datosClientesBusqueda = mysqli_fetch_array($queryClientesBusqueda,MYSQLI_ASSOC)){
               $selecClientesBusqueda.='
               <option value="'.$datosClientesBusqueda["idCliente"].'">'.$datosClientesBusqueda["nombre"].'</option>
               ';
            }

        $selecClientesBusqueda.='</select>';


    $datos = array(
        0 => $selectClientesModal,
        1 => $selecClientesBusqueda,
    );
    echo json_encode($datos);

}

?>