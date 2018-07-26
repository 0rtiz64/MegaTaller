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


$fechaActual = date('Y-m-d ');
$queryTomarOrdenesDeFechaActual = mysqli_query($enlace,"select  clientes.nombre,usuarios.nombre AS recibio,ordenesservicio.correlativo,ordenesservicio.estado from ordenesservicio  
                            INNER JOIN clientes on ordenesservicio.idCliente = clientes.idCliente
                            INNER JOIN usuarios on ordenesservicio.idUsuarioRecibe = usuarios.idUsuario
WHERE CAST(ordenesservicio.fechaIngreso AS DATE) = '".$fechaActual."' GROUP BY ordenesservicio.correlativo DESC");


$tabla1 = '
<table class="table table-borderless table-data3">
    <thead>
        <tr align="center">
            <td style="color: white"><strong>CLIENTE</strong></td>
            <td style="color: white"><strong>RECIBIO</strong></td>
            <td style="color: white"><strong>EXPEDIENTE</strong></td>
            <td style="color: white"><strong>ESTADO</strong></td>
            <td style="color: white"><strong>OPCIONES</strong></td>
        </tr>
     </thead>
     <tbody>
';

while($datosTabla = mysqli_fetch_array($queryTomarOrdenesDeFechaActual,MYSQLI_ASSOC)){

    // INICIO ESTADOS
    if($datosTabla["estado"]==1){
        $estado = "PENDIENTE";
        $clase= "style='color:#FA4251'";
    }else{
        if($datosTabla["estado"]==2){
            $estado = "EN PROCESO";
            $clase= "style='color:#E0A800'";
        }else{
            if($datosTabla["estado"]==3){
                $estado = "FINALIZADO";
                $clase= "style='color:#218838'";
            }
        }
    }
    // FIN ESTADOS

$tabla1.='
<tr align="center">
    <td><strong>'.$datosTabla["nombre"].'</strong></td>
    <td><strong>'.$datosTabla["recibio"].'</strong></td>
    <td><strong>'.$datosTabla["correlativo"].'</strong></td>
    <td '.$clase.' ><strong>'.$estado.'</strong></td>
    <td>
        <div class="table-data-feature" style="margin-right: 15%">
            <button class="item" data-toggle="tooltip"  data-placement="top" title="VER DETALLES">
                <i class="zmdi zmdi-eye"></i>
             </button>   
         </div>
     </td>    
</tr>
';
}

$tabla1.= '</table>';

$datos = array(
    0 => $divOrdenes,
    1 => $tabla1,
);
echo json_encode($datos);

?>