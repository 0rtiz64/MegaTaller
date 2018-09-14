<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 14/9/2018
 * Time: 9:48 AM
 */

include '../funciones/enlace.php';
require_once '../vendor/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$filas = "";
$idOrden=$_GET["id"];
$contador =1;

//INICIO RUTA IMAGEN
$rutaImg1="../imgFirmas/";
$finRuta=".jpg";

$rutaImg2=$rutaImg1.$idOrden.$finRuta;
//FIN RUTA IMAGEN

if(file_exists($rutaImg2)){
    $foto='<img src="'.$rutaImg2.'" style="width: 210px; height: 235px">';
}else{
    $foto='';
}




    $queryDatos = mysqli_query($enlace,"SELECT modelos.descripcion as modelo,marcas.descripcion as marca,equipos.serie,detalleordenesservicio.incluye,CAST(ordenesservicio.fechaIngreso AS DATE) as fecha,
clientes.nombre as cliente ,ordenesservicio.correlativo,detalleordenesservicio.falla
 from ordenesservicio
INNER JOIN detalleordenesservicio ON detalleordenesservicio.idOrdenServicio = ordenesservicio.idOrden
INNER JOIN equipos ON detalleordenesservicio.idEquipo = equipos.idEquipo
INNER JOIN marcas on equipos.idMarca = marcas.idMarca
INNER JOIN modelos on equipos.idModelo = modelos.idModelo
INNER JOIN clientes on ordenesservicio.idCliente = clientes.idCliente
WHERE ordenesservicio.idOrden =".$idOrden);

$queryDatosOrden = mysqli_query($enlace,"SELECT CAST(ordenesservicio.fechaIngreso AS DATE) as fecha,clientes.nombre as cliente,ordenesservicio.correlativo from ordenesservicio
INNER JOIN detalleordenesservicio ON detalleordenesservicio.idOrdenServicio = ordenesservicio.idOrden
INNER JOIN clientes on ordenesservicio.idCliente = clientes.idCliente
WHERE ordenesservicio.idOrden =".$idOrden);
$datosOrden = mysqli_fetch_array($queryDatosOrden,MYSQLI_ASSOC);


$fecha = $datosOrden["fecha"];
$dia = substr($fecha,8,2);
$mes = substr($fecha,5,2);
$aaa = substr($fecha,0,4);

switch ($mes){
    case 01:
        $miMes = "ENERO";
        break;

    case 02:
        $miMes = "FEBRERO";
        break;

    case 03:
        $miMes = "MARZO";
        break;

    case 04:
        $miMes = "ABRIL";
        break;

    case 05:
        $miMes = "MAYO";
        break;

    case 06:
        $miMes = "JUNIO";
        break;

    case 07:
        $miMes = "JULIO";
        break;

    case "08":
        $miMes = "AGOSTO";
        break;

    case "09":
        $miMes = "SEPTIEMBRE";
        break;

    case 10:
        $miMes = "OCTUBRE";
        break;

    case 11:
        $miMes = "NOVIEMBRE";
        break;

    case 12:
        $miMes = "DICIEMBRE";
        break;
}


$fCompleta = $dia."-".$miMes."-".$aaa;

$color = 'style="background-color: #d3d3d3;"';
    while ($rows = mysqli_fetch_array($queryDatos,MYSQLI_ASSOC)){
        $filas.= '

   <table style ="width: 100%;" border=2     cellspacing=0>

<tr align="center" style="background-color: #0083ce; color: #ffffff; ">
<td colspan="3"><strong>DATOS DEL EQUIPO # '.$contador.'</strong></td>
</tr>


<tr align="center" '.$color.'>
<td><strong>MARCA</strong></td>
<td><strong>MODELO</strong></td>
<td><strong>SERIE</strong></td>
</tr>

<tr align="center" '.$color.'>
 <td>' .$rows["modelo"].'</td>
 <td >'.$rows["marca"].'</td>
 <td >'.$rows["serie"].'</td>
</tr>

<tr align="center" '.$color.'>
<td colspan="3"><strong>INCLUYE</strong></td>
</tr>

<tr align="center" '.$color.'>
<td colspan="3">'.$rows["incluye"].'</td>
</tr>

<tr align="center" '.$color.'>
<td colspan="3"><strong>FALLA</strong></td>
</tr>

<tr align="center" '.$color.'>
<td colspan="3" >'.$rows["falla"].'</td>
</tr>


 </table>
 <br><br>
       ';
        $contador++;
    }


    $contenido= '

<div style="float: left">
<img src="../images/icon/logoMG.png" width="170px" height="170px">
</div>  

<div style="float: left; margin-left: 35%" align="center">
<h3>ORDEN DE SERVICIO: '.$datosOrden["correlativo"].'</h3>
<h4>CLIENTE: '.$datosOrden["cliente"].' FECHA: '.$fCompleta.'</h4>
</div>  
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  '.$filas.'
 
 <div align="center">
 <p>FIRMA DEL CLIENTE:</p>
</div>

<div align="center">
  '.$foto.'
</div>
  ';








$dompdf = new DOMPDF();
$dompdf->load_html( $contenido);
$dompdf->render();
//$dompdf->stream("mi_archivo.pdf");
$dompdf->stream("OrdenDeServicio.pdf",array('Attachment'=>0));
?>