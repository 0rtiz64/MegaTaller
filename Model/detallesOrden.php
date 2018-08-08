<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 1/8/2018
 * Time: 2:34 PM
 */
include '../funciones/enlace.php';
$idOrdenServicio= $_POST['phpIdOrden'];



$queryCliente = mysqli_query($enlace,"SELECT clientes.nombre,ordenesservicio.correlativo from ordenesservicio 
INNER JOIN detalleordenesservicio on ordenesservicio.idOrden = detalleordenesservicio.idOrdenServicio
INNER JOIN clientes on ordenesservicio.idCliente = clientes.idCliente
where ordenesservicio.idOrden = $idOrdenServicio");
$datosClienteOrden = mysqli_fetch_array($queryCliente,MYSQLI_ASSOC);
$cliente = '<h4>'.$datosClienteOrden["nombre"].'</h4>';
$correlativo= '<h4 align="right">'.$datosClienteOrden["correlativo"].'</h4>';





$queryTomarEquipos = mysqli_query($enlace,"SELECT clientes.nombre,ordenesservicio.correlativo,modelos.descripcion,equipos.serie,detalleordenesservicio.estado,detalleordenesservicio.fechaEntrega from ordenesservicio 
INNER JOIN detalleordenesservicio on ordenesservicio.idOrden = detalleordenesservicio.idOrdenServicio
INNER JOIN clientes on ordenesservicio.idCliente = clientes.idCliente
INNER JOIN  equipos on detalleordenesservicio.idEquipo = equipos.idEquipo
INNER JOIN modelos on equipos.idModelo = modelos.idModelo
where ordenesservicio.idOrden = $idOrdenServicio");
$tablaModal ='
 <table class="table table-borderless table-data3" >
                                            <thead>
                                            <tr align="center">
                                                <td style="color: #ffffff;"><strong>#</strong></td>
                                                <td style="color: #ffffff;"><strong>EQUIPO</strong></td>
                                                <td style="color: #ffffff;"><strong>SERIE</strong></td>
                                                <td style="color: #ffffff;"><strong>ESTADO</strong></td>
                                                <td style="color: #ffffff;"><strong>FECHA ENTREGA</strong></td>
                                                <td style="color: #ffffff;"><strong>COMPROBANTE</strong></td>
                                            </tr>
                                            </thead>
                                            <tbody>';
$contador =1;
while($datosEquiposEnOrden = mysqli_fetch_array($queryTomarEquipos,MYSQLI_ASSOC)){

   if($datosEquiposEnOrden["estado"]==1){
        $estado = "PENDIENTE";
        $clase= "style='color:#FA4251'";
        $botonOrden = "";
    }else{
        if($datosEquiposEnOrden["estado"]==2){
            $estado = "FINALIZADO";
            $clase= "style='color:#218838'";
            $botonOrden =  '<button onclick="verComprobante(\''.$datosEquiposEnOrden["serie"].'\');" type="button" class="btn btn-outline-primary btn-sm" title="VER ORDEN">
                              <i class="fa fa-location-arrow"></i>&nbsp;
                             </button>';
        }else{
            if($datosEquiposEnOrden["estado"]==3){
                $estado = "ENTREGADO";
                $clase= "style='color:#0069D9'";
                $botonOrden ='<button onclick="verComprobante(\''.$datosEquiposEnOrden["serie"].'\');" type="button" class="btn btn-outline-primary btn-sm" title="VER ORDEN">
                              <i class="fa fa-location-arrow"></i>&nbsp;
                             </button>';
            }else{
            }
        }
    }

    if($datosEquiposEnOrden["fechaEntrega"]==""){
        $fCompleta = '';
    }else{
        $fecha = $datosEquiposEnOrden["fechaEntrega"];
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

    }

    $tablaModal.='
<tr align="center">
                                                <td><strong>'.$contador.'</strong></td>
                                                <td><strong>'.$datosEquiposEnOrden["descripcion"].'</strong></td>
                                                <td><strong>'.$datosEquiposEnOrden["serie"].'</strong></td>
                                                <td '.$clase.'><strong>'.$estado.'</strong></td>
                                                <td style="font-size: small"><strong>'.$fCompleta.'</strong></td>
                                                <td>
                                                    <strong>
                                                      '.$botonOrden.'
                                                    </strong>
                                                </td>

                                            </tr>
';
    $contador++;
}

$tablaModal.= '
    </tbody>
 </table>
';



//INICIO BARRA DE CARGA
$queryCantidadTotalPorOrden = mysqli_query($enlace,"select  COUNT(*) as cantidad from detalleordenesservicio 
WHERE detalleordenesservicio.idOrdenServicio = $idOrdenServicio");
$datosTotalEquiposEnOrden = mysqli_fetch_array($queryCantidadTotalPorOrden,MYSQLI_ASSOC);
$totales = $datosTotalEquiposEnOrden["cantidad"];

$queryCantidadTotalPorOrdenFinalizados =mysqli_query($enlace,"select  COUNT(*) as finalizados from detalleordenesservicio 
WHERE detalleordenesservicio.estado >=2 and detalleordenesservicio.idOrdenServicio =$idOrdenServicio");
$datosTotalEquiposEnOrdenFinalizados = mysqli_fetch_array($queryCantidadTotalPorOrdenFinalizados,MYSQLI_ASSOC);
$finalizados = $datosTotalEquiposEnOrdenFinalizados["finalizados"];

$porcentaje1 = ($finalizados*100)/$totales;
$porcentaje = round($porcentaje1);

if($porcentaje <=50){
    $claseBarra = 'progress-bar bg-danger progress-bar-striped progress-bar-animated';
}else{
    if($porcentaje>50 && $porcentaje <=75){
        $claseBarra = 'progress-bar bg-primary progress-bar-striped progress-bar-animated';
    }else{
        if($porcentaje>75){
            $claseBarra = 'progress-bar bg-success progress-bar-striped progress-bar-animated';
        }
    }
}
if($porcentaje == 0){
    $barra = '
<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width:10%" aria-valuenow="90"aria-valuemin="0" aria-valuemax="100">
                                         '.$porcentaje.'%
                                         </div>
';
}else{
    $barra = '
<div class="'.$claseBarra.'" role="progressbar" style="width:'.$porcentaje.'%" aria-valuenow="90"aria-valuemin="0" aria-valuemax="100">
                                         '.$porcentaje.'%
                                         </div>
';
}


//FIN BARRA DE CARGA

$datos = array(
    0 => $cliente,
    1 => $correlativo,
    2 => $tablaModal,
    3 => $barra,
);
echo json_encode($datos);