<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 12/7/2018
 * Time: 8:24 AM
 */


	include '../funciones/enlace.php';
	include '../funciones/pelota.php';
	include '../funciones/ubicacion.php';
		//$boton="ingresar";
		$boton=$_POST['boton'];
		if ($boton=='cerrar')
        {
            session_start();
            session_destroy();
        }else{


            //$email = "1";
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $pass1 = encriptar($pass);
            $sql="SELECT idUsuario,nombre,accesos,usuario FROM usuarios WHERE usuario='".$email."' AND pass='".$pass1."' AND estado=1";
            $stmt = mysqli_query( $enlace, $sql);

            if ($stmt){

                $rows = mysqli_num_rows( $stmt );
                if ($rows == 1){

                    $Datos = mysqli_fetch_array($stmt,MYSQLI_ASSOC);

                    $num_acceso = $Datos["idUsuario"];
                    $nombre = $Datos["nombre"];
                    $area 	= $Datos["accesos"];
                    $nombreFoto =$Datos["usuario"];
                    //INICIO BUSCAR FOTO
                    $rutaImg1="../images/usuarios/";
                    $finRuta=".jpg";
                    $rutaImg2=$rutaImg1.$nombreFoto.$finRuta;

                    if(file_exists($rutaImg2)){
                        $rutaImgagenPerfil=$rutaImg1.$nombreFoto.$finRuta;
                    }else{
                        $rutaImgagenPerfil='../images/usuarios/Usuario.jpg';
                    }
                    // FIN BUSCAR FOTO

                    session_start();
                    $_SESSION['ingreso']='YES';
                    $_SESSION['num_acceso']=$num_acceso;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['area'] = $area;
                    $_SESSION['$rutaImgagenPerfil'] = $rutaImgagenPerfil;
                    $ubicacion = Ubicar($area);
                    echo $ubicacion;
                    //echo " Nombre de usuario: ".$nombre." Y contraseña es :".$nombre;
                }else{
                    echo "0";
                }


            }


        }


?>