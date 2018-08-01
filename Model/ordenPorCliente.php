<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 27/7/2018
 * Time: 10:36 AM
 */
include '../funciones/enlace.php';
$idCliente= $_POST['phpIdCliente'];

$confirmarOrdenes = mysqli_num_rows(mysqli_query($enlace,"SELECT * from ordenesservicio WHERE idCliente = $idCliente"));
if($confirmarOrdenes>0){

    //INICIO
    $queryTomarOrdenesDeCliente = mysqli_query($enlace,"select  clientes.nombre,usuarios.nombre AS recibio,ordenesservicio.correlativo,ordenesservicio.estado from ordenesservicio  
                            INNER JOIN clientes on ordenesservicio.idCliente = clientes.idCliente
                            INNER JOIN usuarios on ordenesservicio.idUsuarioRecibe = usuarios.idUsuario
WHERE ordenesservicio.idCliente= $idCliente GROUP BY ordenesservicio.correlativo DESC");


$tabla = '
<table class="table table-borderless table-data3">
    <thead>
        <tr align="center">
            <td style="color: white"><strong>#</strong></td>
            <td style="color: white"><strong>CLIENTE</strong></td>
            <td style="color: white"><strong>RECIBIO</strong></td>
            <td style="color: white"><strong>EXPEDIENTE</strong></td>
            <td style="color: white"><strong>ESTADO</strong></td>
            <td style="color: white"><strong>OPCIONES</strong></td>
         </tr>   
     </thead>    
     <tbody>
';
$contador = 1;
    while($datosTabla = mysqli_fetch_array($queryTomarOrdenesDeCliente,MYSQLI_ASSOC)){

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

$tabla .='
<tr align="center">
    <td><strong>'.$contador.'</strong></td>
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
$contador++;
    }

   $tabla.='</table>';
    //FIN

echo $tabla;

}else{
    echo 0;
}

?>