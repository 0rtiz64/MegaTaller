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
$fechaentrada = date('Y-m-d  h:i:s');

$marca= explode(",", $marca1);
$modelo= explode(",", $modelo1);
$serie= explode(",", $serie1);
$falla= explode(",", $falla1);
$pn= explode(",", $pn1);
$incluye= explode(",", $incluye1);

$i =1;

while ($i < count($marca)){
//EJECUTA ESTO

    $queryVerificarEquipo  = mysqli_num_rows(mysqli_query($enlace,"SELECT * from equipos where serie = '".$serie[$i]."' "));
    if($queryVerificarEquipo>0){
        $queryTomarIdEquipo = mysqli_query($enlace,"SELECT * from equipos where serie = '".$serie[$i]."' ");
        $datosTomarIdEquipo = mysqli_fetch_array($queryTomarIdEquipo,MYSQLI_ASSOC);
        $idEquipo = $datosTomarIdEquipo["idEquipo"];
    }else{
        $queryInsertarEquipos = mysqli_query($enlace,"INSERT INTO equipos (idMarca,idModelo,serie,pn,fechaRegistro) VALUES
 (".intval($marca[$i]).",".intval($modelo[$i]).",'".$serie[$i]."','".$pn[$i]."','".$fechaentrada."')");

        $queryTomarIdEquipo = mysqli_query($enlace,"SELECT * from equipos where serie = '".$serie[$i]."' ");
        $datosTomarIdEquipo = mysqli_fetch_array($queryTomarIdEquipo,MYSQLI_ASSOC);
        $idEquipo = $datosTomarIdEquipo["idEquipo"];
    }
    echo $idEquipo;

    $queryCorrelatioMayor = mysqli_query($enlace,"");
    $i++;
}

?>