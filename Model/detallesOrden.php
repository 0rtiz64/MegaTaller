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
                                            </tr>
                                            </thead>
                                            <tbody>';
$contador =1;
while($datosEquiposEnOrden = mysqli_fetch_array($queryTomarEquipos,MYSQLI_ASSOC)){
    if($datosEquiposEnOrden["estado"]==1){
        $estado = "PENDIENTE";
        $clase= "style='color:#FA4251'";
    }else{
        if($datosEquiposEnOrden["estado"]==2){
            $estado = "FINALIZADO";
            $clase= "style='color:#E0A800'";
        }else{
            if($datosEquiposEnOrden["estado"]==2){
                $estado = "ENTREGADO";
                $clase= "style='color:#FA4D5B'";
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
                                                <td><strong>'.$fCompleta.'</strong></td>

                                            </tr>
';
    $contador++;
}

$tablaModal.= '
    </tbody>
 </table>
';



$datos = array(
    0 => $cliente,
    1 => $correlativo,
    2 => $tablaModal,
);
echo json_encode($datos);