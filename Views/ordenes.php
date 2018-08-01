<?php
session_start();
if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES')
{?>
    <?php
    include '../funciones/noCache.php';
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="shortcut icon" href="../images/icon/megaIco.ico" type="image/png">
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="au theme template">
        <meta name="author" content="Hau Nguyen">
        <meta name="keywords" content="au theme template">

        <!-- Title Page-->
        <title>ORDENES DE SERVICIO</title>

        <!-- Fontfaces CSS-->
        <link href="../css/font-face.css" rel="stylesheet" media="all">
        <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="../vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
        <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

        <!-- Bootstrap CSS-->
        <link href="../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

        <!-- Vendor CSS-->
        <link href="../vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
        <link href="../vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
        <link href="../vendor/wow/animate.css" rel="stylesheet" media="all">
        <link href="../vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
        <link href="../vendor/slick/slick.css" rel="stylesheet" media="all">
        <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="../vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
        <link href="../vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">

        <!-- Main CSS-->
        <link href="../css/theme.css" rel="stylesheet" media="all">

        <!--ALERTIFY INICIO-->
        <link rel="stylesheet" href="../vendor/alertify/css/alertify.css">
        <link rel="stylesheet" href="../vendor/alertify/css/themes/bootstrap.css">
        <!--ALERTIFY FIN-->
    </head>

    <body class="animsition">

    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo">
                <a href="#">
                    <img src="../images/icon/logoAzul.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="<?php  echo $_SESSION['$rutaImgagenPerfil']; ?>"  />
                    </div>
                    <h4 class="name"><?php  echo $_SESSION['nombre']; ?></h4>
                    <a href="javascript: void(0)" onclick='cerrar();'><i class="fa fa-power-off"></i> Cerrar Sesion</a>
                </div>
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <?php
                        include '../funciones/menu.php';
                        $permisos = $_SESSION['area'];
                        $focusMenu = "M2";
                        $focusSubMenu = "SM2.1";
                        menuSubmenu($permisos,$focusMenu,$focusSubMenu);
                        ?>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <img src="../images/icon/logo-white.png" alt="CoolAdmin" />
                                </a>
                            </div>


                            <div class="header-button2">


                                <div class="header-wrap"style="margin-left: -65%">
                                    <p style="color: white">ORDENES DE HOY: </p>
                                    <div id="contadorOrdenes" style="margin-right: -7%">
                                        <?php
                                        include '../funciones/enlace.php';
                                        $fechaContador = date('Y-m-d ');
                                        $queryContarOrdenes = mysqli_query($enlace,"SELECT COUNT(*) as ordenes from ordenesservicio where CAST(fechaIngreso AS DATE) = '".$fechaContador."'");
                                        $datosContarOrdenes = mysqli_fetch_array($queryContarOrdenes,MYSQLI_ASSOC);
                                        $cantidad = $datosContarOrdenes["ordenes"];
                                        $divOrdenes = '<span class="badge badge-warning" >'.$cantidad.' </span>';
                                        echo $divOrdenes;
                                        ?>
                                    </div>
                                </div>
                                <div class=header-wrap" style="margin-left: 60%;margin-right: 5%">
                                    <div class="form-header">
                                        <input style="text-transform: uppercase" class="au-input au-input--xl" type="text" placeholder="Busca el Historial de un Equipo" id="inputBuscarHistorial" />
                                        <button class="btn btn-info" type="button" onclick="historialEquipo();">
                                            <i class="zmdi zmdi-search"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="header-button-item has-noti js-item-menu">
                                    <i class="zmdi zmdi-notifications" onclick="notificaciones();"></i>
                                    <input type="hidden" value="<?php  echo $_SESSION['idUsuario']; ?>" id="idUsuario">
                                    <div class="notifi-dropdown js-dropdown">
                                        <div id="mostrarNotificaciones"></div>
                                    </div>
                                </div>

                                <div class="header-button-item mr-0 js-sidebar-btn collapse">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Setting</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-money-box"></i>Billing</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-globe"></i>Language</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-pin"></i>Location</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-email"></i>Email</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-notifications"></i>Notifications</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <a href="#">
                        <img src="../images/icon/logo-white.png" alt="Cool Admin" />
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2">
                        <div class="image img-cir img-120">
                            <img src="../images/icon/avatar-big-01.jpg" alt="John Doe" />
                        </div>
                        <h4 class="name">john doe</h4>
                        <a href="#">Sign out</a>
                    </div>
                    <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <li class="active has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="index.html">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 1</a>
                                    </li>
                                    <li>
                                        <a href="index2.html">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 2</a>
                                    </li>
                                    <li>
                                        <a href="index3.html">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 3</a>
                                    </li>
                                    <li>
                                        <a href="index4.html">
                                            <i class="fas fa-tachometer-alt"></i>Dashboard 4</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="inbox.html">
                                    <i class="fas fa-chart-bar"></i>Inbox</a>
                                <span class="inbox-num">3</span>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fas fa-shopping-basket"></i>eCommerce</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-trophy"></i>Features
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="table.html">
                                            <i class="fas fa-table"></i>Tables</a>
                                    </li>
                                    <li>
                                        <a href="form.html">
                                            <i class="far fa-check-square"></i>Forms</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-calendar-alt"></i>Calendar</a>
                                    </li>
                                    <li>
                                        <a href="map.html">
                                            <i class="fas fa-map-marker-alt"></i>Maps</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-copy"></i>Pages
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="login.html">
                                            <i class="fas fa-sign-in-alt"></i>Login</a>
                                    </li>
                                    <li>
                                        <a href="register.html">
                                            <i class="fas fa-user"></i>Register</a>
                                    </li>
                                    <li>
                                        <a href="forget-pass.html">
                                            <i class="fas fa-unlock-alt"></i>Forget Password</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-desktop"></i>UI Elements
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="button.html">
                                            <i class="fab fa-flickr"></i>Button</a>
                                    </li>
                                    <li>
                                        <a href="badge.html">
                                            <i class="fas fa-comment-alt"></i>Badges</a>
                                    </li>
                                    <li>
                                        <a href="tab.html">
                                            <i class="far fa-window-maximize"></i>Tabs</a>
                                    </li>
                                    <li>
                                        <a href="card.html">
                                            <i class="far fa-id-card"></i>Cards</a>
                                    </li>
                                    <li>
                                        <a href="alert.html">
                                            <i class="far fa-bell"></i>Alerts</a>
                                    </li>
                                    <li>
                                        <a href="progress-bar.html">
                                            <i class="fas fa-tasks"></i>Progress Bars</a>
                                    </li>
                                    <li>
                                        <a href="modal.html">
                                            <i class="far fa-window-restore"></i>Modals</a>
                                    </li>
                                    <li>
                                        <a href="switch.html">
                                            <i class="fas fa-toggle-on"></i>Switchs</a>
                                    </li>
                                    <li>
                                        <a href="grid.html">
                                            <i class="fas fa-th-large"></i>Grids</a>
                                    </li>
                                    <li>
                                        <a href="fontawesome.html">
                                            <i class="fab fa-font-awesome"></i>FontAwesome</a>
                                    </li>
                                    <li>
                                        <a href="typo.html">
                                            <i class="fas fa-font"></i>Typography</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- END HEADER DESKTOP-->

            <!-- BREADCRUMB-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">ORDEN DE SERVICIO</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue" onclick="abrirModal()">
                                        <i class="zmdi zmdi-plus"></i>Nueva Orden</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="main-content" style="margin-top: -4%">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
<div class="form-group col-md-12" >
    <div class="form-group col-md-6">
        <label>BUSCAR ORDEN POR CLIENTE</label>
    </div>
    <div class="form-group col-md-12" id="divSelectClienteOrden">
        <select id="selectClientesOrden" class="form-control">
            <option value="">CLIENTE</option>
            <?php
            $queryClientesBusqueda= mysqli_query($enlace,"SELECT * from clientes where estado =1 GROUP BY nombre ASC");
            while ($datosClientesBusqueda = mysqli_fetch_array($queryClientesBusqueda,MYSQLI_ASSOC)){
               echo'<option value="'.$datosClientesBusqueda["idCliente"].'">'.$datosClientesBusqueda["nombre"].'</option>';
            }
            ?>
        </select>
    </div>
</div>


                            <div class="table-responsive" id="tableOrdenesServicio">
                            </div>
                        </div>
                    </div>
                </div>

            <!-- modal large -->
            <div class="modal fade" id="largeModalOrdenesServicio" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="largeModalLabel">NUEVA ORDEN DE SERVICIO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <div class="col-md-12">
                               <form class="form-horizontal">
                                   <div class="row form-group">

                                   <div class="form-group col-md-4" id="divClientes">
                                       <div class="input-group">
                                           <div class="input-group-addon  btn btn-primary" onclick="modalNuevoCliente()">
                                               <i class="fa fa-plus-circle"></i>
                                           </div>
                                                <select  id="clienteNuevaOrden" class="form-control">
                                                    <option value="">CLIENTE</option>
                                                    <?php
                                                    include '../funciones/enlace.php';
                                                    $queryClientes= mysqli_query($enlace,"SELECT * from clientes where estado =1 GROUP BY nombre ASC");
                                                    while($datosClientes = mysqli_fetch_array($queryClientes,MYSQLI_ASSOC)){
                                                        echo '<option value="'.$datosClientes["idCliente"].'">'.$datosClientes["nombre"].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                       </div>
                                   </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" placeholder="NOMBRE CONTACTO" style="text-transform: uppercase" id="nombreContacto">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="number" class="form-control" placeholder="TELEFONO CONTACTO" min="0" id="telefonoContacto">
                                    </div>
                                </div>

                                   <div class="row form-group">

                                       <div class="form-group col-md-4" id="divNuevaMarca">
                                           <div class="input-group">
                                               <div class="input-group-addon  btn btn-primary" onclick="modalNuevaMarca()">
                                                   <i class="fa fa-plus-circle"></i>
                                               </div>
                                               <select  id="marcaNuevaOrden" class="form-control">
                                                   <option value="">MARCA</option>
                                                   <?php
                                                   include '../funciones/enlace.php';
                                                   $queryMarcas = mysqli_query($enlace,"SELECT * from marcas WHERE estado = 1 GROUP BY descripcion ASC");

                                                   while($datosMarcas = mysqli_fetch_array($queryMarcas,MYSQLI_ASSOC)){
                                                       echo'<option value="'.$datosMarcas["idMarca"].'">'.$datosMarcas["descripcion"].'</option>';
                                                   }
                                                   ?>
                                               </select>
                                           </div>
                                       </div>

                                       <div class="form-group col-md-4" id="divNuevoModelos">
                                           <div class="input-group">
                                               <div class="input-group-addon  btn btn-primary" onclick="modalNuevoModelo()">
                                                   <i class="fa fa-plus-circle"></i>
                                               </div>
                                               <select  id="modeloNuevaOrden" class="form-control">
                                                   <option value="">MODELO</option>
                                                   <?php
                                                   include '../funciones/enlace.php';
                                                   $queryModelos = mysqli_query($enlace,"SELECT * from modelos WHERE estado = 1 GROUP BY descripcion ASC");

                                                   while($datosModelos = mysqli_fetch_array($queryModelos,MYSQLI_ASSOC)){
                                                       echo'<option value="'.$datosModelos["idModelo"].'">'.$datosModelos["descripcion"].'</option>';
                                                   }
                                                   ?>
                                               </select>
                                           </div>
                                       </div>

                                       <div class="form-group col-md-4">
                                           <input type="text" class="form-control" placeholder="SERIE" style="text-transform: uppercase" id="inputSerieEquipo">
                                       </div>
                                   </div>

                                   <div class="row form-group">

                                       <div class="form-group col-md-4">
                                           <input type="text" class="form-control" placeholder="FALLA REPORTADA" style="text-transform: uppercase" id="inputFallaEquipo">
                                       </div>

                                       <div class="form-group col-md-4">
                                           <input type="text" class="form-control" placeholder="NUMERO DE PARTE (OPCIONAL)" style="text-transform: uppercase" id="inputNumeroParte">
                                       </div>

                                       <div class="form-group col-md-4">
                                           <input type="text" class="form-control" placeholder="INCLUYE" style="text-transform: uppercase" id="inputIncluye">
                                       </div>
                                   </div>

                                   <div class="col-md-12 form-group" align="center">
                                       <input type="button" class="btn btn-outline-info" value="AGREGAR EQUIPO" onclick="agregarEquipo()">
                                   </div>

                                   <div class="col-md-12 form-group">
                                       <!-- DATA TABLE-->
                                       <div class="table-responsive m-b-40">
                                           <table class="table table-borderless table-data3" id="tablaEquiposEnOrden">
                                               <thead>
                                               <tr align="center">
                                                   <td style="color: white;font-size: small">MARCA</td>
                                                   <td style="color: white;font-size: small">MODELO</td>
                                                   <td style="color: white;font-size: small">SERIE</td>
                                                   <td style="color: white;font-size: small">FALLA</td>
                                                   <td style="color: white;font-size: small">OPCION</td>

                                               </tr>
                                               </thead>
                                               <tbody>

                                               </tbody>
                                           </table>
                                       </div>
                                       <!-- END DATA TABLE-->
                                   </div>

                               </form>
                           </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
                            <button type="button" class="btn btn-primary" onclick="confirmarOrden()">CONFIRMAR ORDEN</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal large -->

            <!-- NUEVO  CLIENTE-->
            <div  class="modal fade" id="modalNuevoCliente" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
                 data-backdrop="static">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="staticModalLabel" style="color: white">NUEVO CLIENTE</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                           <div class="col-md-12">
                               <div class="form-group">
                                   <input type="text" class="form-control" placeholder="NOMBRE CLIENTE" id="nombreNuevoCliente" style="text-transform: uppercase">
                               </div>
                               <div class="form-group">
                                   <select  id="nuevoClienteVendedor" class="form-control">
                                       <option value="">VENDEDOR</option>
                                       <?php
                                       include '../funciones/enlace.php';
                                       $queryVendedores= mysqli_query($enlace,"select * from usuarios where tipoUsuario = 3 and estado =1");
                                        while($datosVendedores = mysqli_fetch_array($queryVendedores,MYSQLI_ASSOC)){
                                            echo' <option value="'.$datosVendedores["idUsuario"].'">'.$datosVendedores["nombre"].'</option>';
                                        }
                                       ?>
                                   </select>
                               </div>
                              <div class="form-group">
                                  <input type="text" class="form-control" placeholder="DIRECCION" id="direccionNuevoCliente" style="text-transform: uppercase">
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
                            <button type="button" class="btn btn-primary" onclick="guardarClienteNuevo()">CONFIRMAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN NUEVO CLIENTE -->

            <!-- NUEVA MARCA-->
            <div  class="modal fade" id="modalNuevaMarca" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
                  data-backdrop="static">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="staticModalLabel" style="color: white">NUEVA MARCA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="NOMBRE MARCA" id="inputMarcaNueva" style="text-transform: uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
                            <button type="button" class="btn btn-primary" onclick="guardarMarcaNueva()">CONFIRMAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN NUEVA MARCA-->

            <!-- NUEVO MODELO-->
            <div  class="modal fade" id="modalNuevoModelo" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
                  data-backdrop="static">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="staticModalLabel" style="color: white">NUEVO MODELO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="NOMBRE MODELO" style="text-transform: uppercase" id="inputModeloNuevo">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
                            <button type="button" class="btn btn-primary" onclick="guardarModeloNueva()">CONFIRMAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN NUEVO MODELO-->


                <!-- INICIO MODAL DETALLE ORDEN  -->
                <div class="modal fade" id="modalDetalleOrden" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="scrollmodalLabel">DETALLES ORDEN DE SERVICIO</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row form-group">
                                    <div class="form-group col-md-6" id="clienteDetalleOrden"></div>

                                    <div class="form-group col-md-6" id="correlativoDetalleOrden"></div>
                                </div>

                                <div class="form-group col-md-12" id="tablaEquiposEnOrdenDetalle" >

                                </div>


                                <div class="progress mb-2">
                                    <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 90%" aria-valuenow="90"
                                         aria-valuemin="0" aria-valuemax="100">90%</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- INICIO MODAL DETALLE ORDEN  -->


            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="../vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="../vendor/slick/slick.min.js">
    </script>
    <script src="../vendor/wow/wow.min.js"></script>
    <script src="../vendor/animsition/animsition.min.js"></script>
    <script src="../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="../vendor/select2/select2.min.js">
    </script>
    <script src="../vendor/vector-map/jquery.vmap.js"></script>
    <script src="../vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="../vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="../vendor/vector-map/jquery.vmap.world.js"></script>

    <script src="../vendor/alertify/alertify.js"></script>
    <!-- Main JS-->
    <script>


        function cerrar()
        {
            $.ajax({
                url:'../Model/ingreso.php',
                type:'POST',
                data:"boton=cerrar"
            }).done(function(resp){
                location.href = '/megataller/index.php';
            });
        }


        function notificaciones() {
            var idUsuario = $('#idUsuario').val();
            var url ='../Model/notificaciones.php';
            $.ajax({
                url:url,
                method :"POST",
                data:{idUsuario:idUsuario},
                success: function (datos) {
                    $('#mostrarNotificaciones').html(datos);

                    return false;


                }
            });

            return false;
        }


        function historialEquipo() {
            var serie1= $('#inputBuscarHistorial').val();
            var serie =serie1.toUpperCase();
            alert("RECUERDA AGREGAR FUNCION BUSCAR HISTORIAL EN TODAS LAS VIEWS");
        }
    </script>
    <script src="../js/main.js"></script>
    <script src="../Controllers/ordenes.js"></script>

    </body>

    </html>
    <!-- end document-->

    <?php

}
else
{
    header("location: ../");
    session_start();
    session_destroy();
}
?>