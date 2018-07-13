<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 12/7/2018
 * Time: 8:36 AM
 */


	function Ubicar($per){

        $accesos = $per;
        $direccion = "";
        $submenu = explode(",",$accesos);

        $miarray = array();
        $miarraySubmenu = array();

        for ($i=0; $i < count($submenu); $i++){
            # code...
            //sacar submenus : preg_match('/SM[0-9].[0-9]/',$submenu[$i])
            if (preg_match('/^M[0-9]/',$submenu[$i]))
            {

                $miarray[] =$submenu[$i];
            } else
            {
                //echo "NO HAY COINCIDENCIA";
            }

        }

        //submenus
        for ($i=0; $i < count($submenu); $i++) {
            # code...
            //sacar submenus : preg_match('/SM[0-9].[0-9]/',$submenu[$i])
            if (preg_match('/^S'.$miarray[0].'.[0-9]/',$submenu[$i]))
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
            }

        }
        switch ($miarray[0]) {
            case 'M1':
                $direccion = "Views/index.php";
                break;


            case 'M2':
                # code...
                switch ($miarraySubmenu[0]) {
                    case 'SM2.1':
                        # code...
                        $direccion = "Views/ordenes.php";
                        break;
                }
                break;
        }
        return $direccion;
    }

 ?>