<?php
include('../../Models/conexion.php');
$orden = "";
$clientes ="";
$fechas = "";

	$normal = "";
	$adomicilio = "";
	$garantia = "";
	$contrato = "";
	$demo = "";
	$visita = "";
	$cortesia = "";

function decrypt($string, $key) {
						   $result = '';
						   $string = base64_decode($string);
						   for($i=0; $i<strlen($string); $i++) {
							  $char = substr($string, $i, 1);
							  $keychar = substr($key, ($i % strlen($key))-1, 1);
							  $char = chr(ord($char)-ord($keychar));
							  $result.=$char;
						   }
						   return $result;
						}

$buscar = $_GET['valor'];
if(is_numeric($buscar)){
	header("location: ../");
	session_start();
	session_destroy();
}
$id1 = addslashes(decrypt($buscar,'6ec1325d1d31a5fd4f52ee279e7ab5ab6dd638fe12e0d55cccf83901f728cca66f30da0f7add49f44519a5c2bc4988705508eac2b0b8428b033776fba73bb26d'));

$sql1 = "SELECT idregistro,num_ticket, cliente.nombreCliente AS Cliente, fechaR,servicios FROM ticket
INNER JOIN cliente ON ticket.idE = cliente.idCliente
WHERE ticket.idregistro =".$id1;

$stmt1 = sqlsrv_query( $conn, $sql1 );
$filas = sqlsrv_has_rows( $stmt1);
if($filas === true){

}else{
	header("location: ../");
	session_start();
	session_destroy();
}
while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ){
	$orden = $row1['num_ticket'];
	$clientes = urldecode($row1['Cliente']);
	$fechas = $row1['fechaR'];
	$servicios1 = explode(",", $row1['servicios']);
$contador = 0;
	while ($contador <= count($servicios1)) {
	# code...
switch($servicios1[$contador]){
	case 1:
		$normal = "checked";
	 break;
	 case 2:
		$visita = "checked";
	 break;
	 case 3:
		$garantia = "checked";
	 break;
	 case 4:
		$contrato = "checked";
	 break;
	 case 5:
		$demo = "checked";
	 break;
	 case 6:
		$cortesia = "checked";
	 break;
}// end switch

$contador++;
}
}
sqlsrv_free_stmt( $stmt1);
$fechaSistema = date('Y-m-d H:i:s');
$contenido = '

<p style="margin-left: 220px; margin-top:-108px; position: absolute; font-size: 14px;"> Tel. +504 2566-0426 </p>
<div> 
	<table  WIDTH=500 > 
		<tr>
			<td align="left"> <img align="left" src="photos/LOGO1.png" border="0"> </td>	
<td  WIDTH=380 > <h3>'.$orden.'</h3> </td>
		</tr>
	<table>

</div>

<div>
	<table  WIDTH="100%" cellspacing="0" cellpadding="0" style="margin-top:15px; font-size: 14px;">
		<tr>
			<td style="padding: 0; text-align: center;">____________________________________________</td>
			<td style="padding: 0; text-align: center;">_____________________________________________</td>
		</tr>

		<tr>
			<td style="padding: 0; text-align: center;">Por el CLIENTE</td>
			<td style="padding: 0; text-align: center;">Por MEGACENTER</td>
		</tr>

		<tr>
			<td COLSPAN=2 style="padding: 1; text-align: center; font-size: 8px;">Es responsabilidad del cliente tener COPIAS DE RESPALDO de los datos de su equipo, MEGACENTER no se hace responsable por perdidas parciales o totales de ellos.</td>
		</tr>

		<tr>
			<td COLSPAN=2 style="padding: 1; text-align: center; font-size: 8px;">Los Servicios Tienen una GARANTIA de 30 dias, no se aceptan reclamos posteriores o por otra falla distinta. Los repuestos o Materiales tienen una garantia limitada segun los terminos del fabricante.</td>
		</tr>

		<tr>
			<td COLSPAN=2 style="padding: 1; text-align: center; font-size: 9px;">Horario: Lunes a Viernes 8:30 AM - 12:00 M / 1:00-4:30 PM - Sabado: 8:30 - 11:30 AM.  Es obligacion del CLIENTE retirar sus equipos a un maximo de 90 dias despues de la fecha de aviso.</td>
		</tr>
	</table>
</div>

<div>
													
	<table border=1 WIDTH="100%" cellspacing="0" cellpadding="15" style="margin-top:10px; align: center; font-size: 14px;">
		
		<tr>
			<td style="padding: 0; text-align: center">Descripcion del Servicio Solicitado o Falla Reportada</td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
		<td style="padding: 0; text-align: center">Descripcion del Trabajo Realizado / Repuestos o Materiales Utilizados</td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</table>
</div>

<div>
	
	<p style="margin-left: 220px; margin-top:-120px; position: absolute; font-size: 14px;"> Tel. +504 2566-0426 </p>

	<p style="margin-left: 220px; margin-top:-152px; position: absolute; font-size: 14px;"> Direccion. Col. Jardines del Valle, Etapa 1, Calle 27, No. 20, San Pedro Sula, Honduras C.A. </p>

	<p style="margin-left: 565px; margin-top:28px; position: absolute; font-size: 12px;"> <input type="checkbox" '.$normal.'> </p>
	<p style="margin-left: 581px; margin-top:35px; position: absolute; font-size: 10px;"> Normal </p>
	
	<p style="margin-left: 620px; margin-top:28px; position: absolute; font-size: 12px;"> <input type="checkbox" '.$visita.'> </p>
	<p style="margin-left: 638px; margin-top:35px; position: absolute; font-size: 10px;"> Visita </p>


	<p style="margin-left: 565px; margin-top:49px; position: absolute; font-size: 12px;"> <input type="checkbox" '.$garantia.'> </p>
	<p style="margin-left: 581px; margin-top:56px; position: absolute; font-size: 10px;"> Garantia </p>

	<p style="margin-left: 620px; margin-top:49px; position: absolute; font-size: 12px;"> <input type="checkbox" '.$contrato.'> </p>
	<p style="margin-left: 638px; margin-top:56px; position: absolute; font-size: 10px;"> Contrato </p>
	

	<p style="margin-left: 565px; margin-top:69px; position: absolute; font-size: 12px;"> <input type="checkbox" '.$demo.'> </p>
	<p style="margin-left: 581px; margin-top:76px; position: absolute; font-size: 10px;"> Demo </p>

	<p style="margin-left: 620px; margin-top:69px; position: absolute; font-size: 12px;"> <input type="checkbox" '.$cortesia.'> </p>
	<p style="margin-left: 638px; margin-top:76px; position: absolute; font-size: 10px;"> Cortesia </p>


	<table border=1 WIDTH="80%" cellspacing="0" cellpadding="10" style="margin-top:10px; align: center; font-size: 14px;">
		
		<tr>
			<td style="padding: 0; text-align: center;">Descripcion del Equipo</td>
			
		</tr>
		<tr>
			<td></td>
			
		</tr>
		<tr>
			<td></td>
			
		</tr>
		<tr>
			<td></td>
			
		</tr>
		<tr>
			<td></td>
			
		</tr>
	</table>


	<table border=1 WIDTH="79.5%" cellspacing="0" cellpadding="10" style="margin-left: 420px; margin-top:-105px; font-size: 14px;">
	
		<tr>
			<td style="padding: 0; text-align: center;"> Servicio </td>
		</tr>
		
		<tr>
			<td> </td>
		</tr>
		<tr>
			<td></td>
			
		</tr>
		<tr>
			<td></td>
			
		</tr>
		<tr>
			<td></td>
			
		</tr>

		 

	</table>

</div>

<div style="margin-top: 120px;">
<table  border=1 cellspacing="0" style="text-align: center; font-size: 14px; margin-right: 5px;" WIDTH="100%"> 
<tbody>
	<tr>
		<td WIDTH="20%">Cliente : </td>
		<td WIDTH="40%" style="font-size: 12px;">'.$clientes.'</td>
		<td WIDTH="20%"> Fecha / Hora</td>
		<td WIDTH="20%">'.$fechas.'</td>
	</tr>
	
	<tr>
		<td>Contacto : </td>
		<td></td>
		<td COLSPAN="2">
			<table  cellspacing="0" WIDTH="100%">
				<tr>
					<td>Telefono : </td>
					<td>Movil : </td>
				</tr>
			</table> 
		</td>
	</tr>
	
	<tr>
		<td>Otros Datos : </td>
		<td></td>
		<td colspan="2" align="left">Correo : </td>
		
	</tr>
</tbody>
</table>
</div>



';


require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml($contenido); 
 $dompdf->setPaper('A4', 'portrait');
 $dompdf->render();
 $dompdf->stream("Orden de servicio -".$clientes." ".$fechaSistema,array('Attachment'=>0));
 ?>