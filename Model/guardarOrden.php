<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 18/7/2018
 * Time: 9:05 AM
 */

include '../funciones/enlace.php';

$idCliente= $_POST['phpIdCliente'];
$nombreContacto= $_POST['phpNombreContacto'];
$numeroContacto= $_POST['phpNumeroContacto'];
$marca1= $_POST['phpMarca'];
$modelo1= $_POST['phpModelo'];
$serie1= $_POST['phpSerie'];
$falla1= $_POST['phpFalla'];
$pn1= $_POST['phpPn'];
$incluye1= $_POST['phpIncluye'];
$idUsuarioRecibe= $_POST['phpIdUsuarioRecibe'];
$fechaentrada = date('Y-m-d  h:i:s');
$fechaContador = date('Y-m-d ');
$marca= explode(",", $marca1);
$modelo= explode(",", $modelo1);
$serie= explode(",", $serie1);
$falla= explode(",", $falla1);
$pn= explode(",", $pn1);
$incluye= explode(",", $incluye1);

$i =1;

// INICIO CREAR ORDEN DE SERVICIO
$queryCorrelativoMayor = mysqli_query($enlace,"SELECT MAX(correlativo +1 ) as nuevoCorr from ordenesservicio");
$datosNuevoCorr = mysqli_fetch_array($queryCorrelativoMayor,MYSQLI_ASSOC);
$correlativoNuevo =$datosNuevoCorr["nuevoCorr"];

$queryCrearOrden = mysqli_query($enlace,"insert into ordenesservicio (idCliente,idUsuarioRecibe,nombreContacto,celContacto,fechaIngreso,correlativo,estado) values 
	(".$idCliente.",".$idUsuarioRecibe.",'".$nombreContacto."',".$numeroContacto.",'".$fechaentrada."',".$correlativoNuevo.",1)");

$queryIdOrdenDeServicio = mysqli_query($enlace,"SELECT idOrden from ordenesservicio where correlativo = $correlativoNuevo");
$datosIdOrdenServicio =mysqli_fetch_array($queryIdOrdenDeServicio,MYSQLI_ASSOC);
$idOrdenServicio = $datosIdOrdenServicio["idOrden"];

//FIN ORDEN DE SERVICIO



//INICIO GUARDAR EQUIPOS EN ORDEN
while ($i < count($marca)){
//EJECUTA ESTO

    $queryVerificarEquipo  = mysqli_num_rows(mysqli_query($enlace,"SELECT * from equipos where serie = '".$serie[$i]."' "));
    if($queryVerificarEquipo>0){
        $queryTomarIdEquipo = mysqli_query($enlace,"SELECT * from equipos where serie = '".$serie[$i]."' ");
        $datosTomarIdEquipo = mysqli_fetch_array($queryTomarIdEquipo,MYSQLI_ASSOC);
        $idEquipo = $datosTomarIdEquipo["idEquipo"];
$serieOrg=$datosTomarIdEquipo["serie"];

if($datosTomarIdEquipo["pn"]==""){
    $queryUpedatePn= mysqli_query($enlace,"UPDATE equipos set pn ='".$pn[$i]."' WHERE serie= '".$serieOrg."'");
}

    }else{

        $queryInsertarEquipos = mysqli_query($enlace,"INSERT INTO equipos (idMarca,idModelo,serie,pn,fechaRegistro) VALUES
 (".intval($marca[$i]).",".intval($modelo[$i]).",'".$serie[$i]."','".$pn[$i]."','".$fechaentrada."')");

        $queryTomarIdEquipo = mysqli_query($enlace,"SELECT * from equipos where serie = '".$serie[$i]."' ");
        $datosTomarIdEquipo = mysqli_fetch_array($queryTomarIdEquipo,MYSQLI_ASSOC);
        $idEquipo = $datosTomarIdEquipo["idEquipo"];
    }


    $queryInsertarEquipoEnOrden= mysqli_query($enlace,"INSERT INTO detalleordenesservicio (idOrdenServicio,idEquipo,incluye,estado,falla) VALUES
 (".$idOrdenServicio.",".$idEquipo.",'".$incluye[$i]."',1,'".$falla[$i]."')");
    $i++;
}
//FIN GUARDAR EQUIPOS EN ORDEN
$queryContarOrdenes = mysqli_query($enlace,"SELECT COUNT(*) as ordenes from ordenesservicio where CAST(fechaIngreso AS DATE) = '".$fechaContador."'");
$datosContarOrdenes = mysqli_fetch_array($queryContarOrdenes,MYSQLI_ASSOC);
$cantidad = $datosContarOrdenes["ordenes"];

$divOrdenes = '<span class="badge badge-warning" >'.$cantidad.' </span>';



$datos = array(
    0 => $divOrdenes,
);
echo json_encode($datos);

?>