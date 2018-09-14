<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 11/9/2018
 * Time: 10:09 AM
 */

$idOrden =$_POST['idOrden'];



$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$im = imagecreatefromstring($data);  //convertir text a imagen



$ruta1 = '../imgFirmas/';
$extencion = '.jpg';

$rutaFinal = $ruta1.$idOrden.$extencion;
if ($im !== false) {
    imagejpeg($im, $rutaFinal); //guardar a server
    imagedestroy($im); //liberar memoria
    echo 1;
}else {
    echo 0;
}
