<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 12/7/2018
 * Time: 1:36 PM
 */



     function menuSubmenu($per,$focusMenu,$focusSubMenu)
     {

         $accesos = $per;
         $submenu = explode(",",$accesos);

         $miarray = array();

         $miarraySubmenu = array();


//guardamos las coincidencias en un array
         for ($i=0; $i < count($submenu); $i++) {

//sacar submenus : preg_match('/SM[0-9].[0-9]/',$submenu[$i])
             if (preg_match('/^M[0-9]/',$submenu[$i]))
             {
                 //echo "HAY COINCIDENCIA<br>";
                 //imprimo el array en pantalla
                 //var_export ($captura);
                 //seria lo mismo que
                 //echo $captura[0];
                 $miarray[] = $submenu[$i];
             } else
             {
                 //echo "NO HAY COINCIDENCIA";
             } //CIERRE ELSE

         } // FIN FOR

//submenus
         for ($i=0; $i < count($submenu); $i++) {
             # code...
//sacar submenus : preg_match('/SM[0-9].[0-9]/',$submenu[$i])
             if (preg_match('/^SM[0-9].[0-9]/',$submenu[$i]))
             {
                 //echo "HAY COINCIDENCIA<br>";
                 //imprimo el array en pantalla
                 //var_export ($captura);
                 //seria lo mismo que
                 //echo $captura[0];
                 $miarraySubmenu[] = $submenu[$i];
             } else
             {
                 //echo "NO HAY COINCIDENCIA";
             } // FIN IF

         } // FIN FOR


         $accesoMenus = '';

//Seccion para menu
         for ($ff=0; $ff < count($miarray) ; $ff++) {
             # code...

             switch($miarray[$ff]){
                 case 'M1':

                     if($focusMenu == "M1"){
                         $accesoMenus .='  <li class="active">
                            <a href="index.php">
                                <i class="fas fa-chart-bar"></i>INICIO</a>
                        </li>';
                     }else{
                         $accesoMenus .=' <li>
                            <a href="index.php">
                                <i class="fas fa-chart-bar"></i>INICIO</a>
                        </li>';
                     }

                     break;
                 case 'M2':

                     if($focusMenu == "M2"){
                         $accesoMenus .='   <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="zmdi zmdi-ticket-star"></i>TICKETS</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">';
                     }else{
                         $accesoMenus .=' <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="zmdi zmdi-ticket-star"></i>TICKETS</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">';
                     }

                     for ($z=0; $z < count($miarraySubmenu); $z++) {
                         # code...
                         switch ($miarraySubmenu[$z]) {
                             case 'SM2.1':
                                 # code...
                                 if($focusSubMenu == "SM2.1"){
                                     $accesoMenus .='  <li class="active">
                                    <a href="ordenes.php">ORDEN DE SERVICIO</a>
                                </li>';
                                 }else{
                                     $accesoMenus .='   <li>
                                    <a href="ordenes.php">ORDEN DE SERVICIO</a>
                                </li>';
                                 }

                                 break;


                             case 'SM2.2':
                                 # code...
                                 if($focusSubMenu == "SM2.2"){
                                     $accesoMenus .='   <li class="">
                                    <a href="ordenes.php">Dashboard 2</a>
                                </li>';
                                 }else{
                                     $accesoMenus .='   <li>
                                    <a href="ordenes.php">Dashboard 2</a>
                                </li>';
                                 }

                                 break;

                             case 'SM2.0':
                                 # code...
                                 $accesoMenus .="<ul/> 
                                                </li>";
                                 break;
                             default:
                                 # code...
                                 break;
                         }
                     }
                     break;
             }

         }


         echo $accesoMenus;
     }


 ?>