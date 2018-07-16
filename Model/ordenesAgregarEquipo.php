<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 16/7/2018
 * Time: 1:38 PM
 */

include '../funciones/enlace.php';

$marca= $_POST['phpMarca'];
$modelo= $_POST['phpModelo'];
$serie= $_POST['phpSerie'];
$falla= $_POST['phpFalla'];
$pn= $_POST['phpPn'];
$incluye= $_POST['phpIncluye'];


$queryMarca = mysqli_query($enlace,"SELECT * from marcas where idMarca = $marca");
$datosMarca = mysqli_fetch_array($queryMarca,MYSQLI_ASSOC);
$marcaNombre = $datosMarca["descripcion"];

$queryModelo= mysqli_query($enlace,"SELECT * FROM modelos where idModelo = $modelo");
$datosModelo = mysqli_fetch_array($queryModelo,MYSQLI_ASSOC);
$modeloNombre = $datosModelo["descripcion"];

echo'<tr align="center" id="'.$serie.'">';
    echo'<td name="marcaA[]">'.$marcaNombre.'</td>';
    echo'<td name="modeloA[]">'.$modeloNombre.'</td>';
    echo'<td name="modeloA[]">'.$serie.'</td>';
    echo'<td  name="serie[]" style="color: #c82333">'.$falla.'</td>';
    echo'<td>';
        echo'<button type="button" class="btn btn-outline-danger">';
            echo'<i class="zmdi zmdi-delete"></i>';
        echo'</button>';
        echo'<input type="hidden" value="'.$pn.'" name="pnA[]">';
        echo'<input type="hidden" value="'.$incluye.'" name="incluyeA[]">';
    echo'</td>';
echo'</tr>';



?>