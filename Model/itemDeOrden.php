<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 4/9/2018
 * Time: 11:01 AM
 */
include '../funciones/enlace.php';

$correlativoOrden= $_POST['phpCorrelativoOrden'];
$rawdata = array();
$i=0;

$queryObtenerIdOrden= mysqli_query($enlace,"SELECT idOrden from ordenesservicio WHERE correlativo = $correlativoOrden");
$datosIdOrden = mysqli_fetch_array($queryObtenerIdOrden,MYSQLI_ASSOC);
$idOrden = $datosIdOrden["idOrden"];

$queryObtenerItemsDeOrden = mysqli_query($enlace,"SELECT detalleordenesservicio.correlativoDetalle,detalleordenesservicio.idEquipo,equipos.serie from detalleordenesservicio 
INNER JOIN equipos on detalleordenesservicio.idEquipo = equipos.idEquipo
WHERE idOrdenServicio = $idOrden");
while ($datosItemsEnOrden = mysqli_fetch_array($queryObtenerItemsDeOrden)){
    $rawdata[$i]= $datosItemsEnOrden;
    $i++;
}
echo json_encode($rawdata);



?>


