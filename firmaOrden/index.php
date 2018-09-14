<?php
include '../funciones/enlace.php';
$idOrden =$_GET["id"];

$query = mysqli_query($enlace,"select ordenesservicio.correlativo,clientes.nombre from ordenesservicio
INNER JOIN clientes ON ordenesservicio.idCliente = clientes.idCliente WHERE idOrden = $idOrden");
$datos = mysqli_fetch_array($query,MYSQLI_ASSOC);
$correlativo= $datos["correlativo"];
$cliente= $datos["nombre"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>FIRMA ORDEN DE SERVICIO</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <link rel="shortcut icon" href="../images/icon/megaIco.ico" type="image/png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
    <!--ALERTIFY INICIO-->
    <link rel="stylesheet" href="../vendor/alertify/css/alertify.css">
    <link rel="stylesheet" href="../vendor/alertify/css/themes/bootstrap.css">
    <!--ALERTIFY FIN-->
</head>
<body>
	
	
	<div class="size1 bg0 where1-parent">
		<!-- Coutdown -->
		<div class="flex-c-m bg-img1 size2 where1 overlay1 where2 respon2" style="background-image: url('images/bg01.jpg');">
			<div class="wsize2 flex-w flex-c-m cd100 js-tilt">
				<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15" id="guardar">

                    <span class="l2-txt1 p-b-9 ">
                        <i class="fa fa-check-circle" style="color:#59BD60;"></i>
                    </span>
                    <span class="s2-txt4">GUARDAR FIRMA</span>

				</div>

				<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15" id="reset">
					<span class="l2-txt1 p-b-9 ">
                           <i class="fa fa-trash" style="color: #cb0000"></i>
                    </span>
                    <span class="s2-txt4">BORRAR FIRMA</span>
				</div>

                <div id="pdf" class="collapse">
                    <div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15">

                    <span class="l2-txt1 p-b-9 ">
                        <i class="fa fa-file-text" style="color:#cb0000;"></i>
                    </span>
                        <span class="s2-txt4">EXPORTAR PDF</span>

                    </div>
                </div>





			</div>
		</div>







		<!-- Form -->
        <div class="respon1">
            <div>
                <img src="../images/icon/logoNegro.png" alt="LOGO" width="745" height="149">
            </div>

            <div class="form-group" style="margin-left: 5%">
                <h1 class="m1-txt1 p-b-36">
                    <input type="hidden" value="<?php  echo $idOrden  ?>" id="idOrden">
                    ORDEN DE SERVICIO <span class="m1-txt2"><?php  echo $correlativo  ?></span>, <?php echo $cliente ?>
                </h1>

                <form class="contact100-form validate-form">

                    <div id="toolbar" class="collapse">
                        <button id="yellow">Yellow</button>
                        <button id="blue">Blue</button>
                        <button id="red">Red</button>
                        <button id="reset2">Reset</button>
                    </div>


                    <canvas id="myCanvas" width="200"></canvas>
                </form>

                <p class="s2-txt3 p-t-18">
                    SU FIRMA EN EL AREA GRIS.
                </p>
            </div>


        </div>
	</div>



	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/moment.min.js"></script>
	<script src="vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeYear: 0,
			endtimeMonth: 0,
			endtimeDate: 35,
			endtimeHours: 18,
			endtimeMinutes: 0,
			endtimeSeconds: 0,
			timeZone: ""
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script src="js/functions.js"></script>
    <script src="../vendor/alertify/alertify.js"></script>
</body>
</html>