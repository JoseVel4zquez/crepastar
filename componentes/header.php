<?php
include_once('php/conexion.php');
include_once('assets/roles.php');
session_start();
if (!isset($_SESSION['codigo'])) {
    echo '<script>alert("Inicia session")</script>';
    header("location:login.php");
    session_destroy();
    die();
}

$nombre = $_SESSION['codigo'];
$sucursal = $_SESSION['sucursal'];
$Rol_name = obtner_rol($nombre);
$obtener_id_usuario = "SELECT id_usuario from usuarios where codigo ='$nombre'";
$id_usuario = current($conexion->query($obtener_id_usuario)->fetch_array());
//obtener sucursal
$selectSucursal = "SELECT nombre_sucursal from sucursales where id_sucursal = '$sucursal' ";
$sucursalNombre = current($conexion->query($selectSucursal)->fetch_array());
// obtener la informacion completa del usuario
$infuser = "SELECT * FROM usuarios where id_usuario='$id_usuario'";
$responseUser = $conexion->query($infuser);

$selectImgProfile = "SELECT img_profile from usuarios where id_usuario = '$id_usuario'";
$imgRequest = current($conexion->query($selectImgProfile)->fetch_array());

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">



    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="bootstrap.bundle.min.js / bootstrap.bundle.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script ref="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>



    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>
    .logo {
        /* position: fixed; */
        top: 15px;
        left: 10px;
        width: 80px;
        /* border-radius: 100px; */
        object-fit: contain;
        cursor: pointer;
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img class="logo" src="img/logo2.png">
                </div>
                <div class="sidebar-brand-text mx-3">Comandas 2022</div>
            </a>
            <div class="sidebar-brand-text mx-3 text-white">Version 2.0.1</div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Panel de administracion</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Interface
            </div> -->



            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li> -->
            <?php
            if ($Rol_name == 'Admin' || $Rol_name == 'Supervisor') {
            ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Opciones de Administrador</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Opciones de admin:</h6>
                            <a class="collapse-item" href="sucursales.php"> Sucursales</a>
                            <a class="collapse-item" href="log_view.php"> Registro de funciones </a>
                            <a class="collapse-item" href="register.php">Registrar nuevo usuario</a>
                            <a class="collapse-item" href="mesas.php">Mesas</a>
                            <a class="collapse-item" href="./usuarios/usuarios.php">Usuarios</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <?php
            if ($Rol_name == 'Admin' || $Rol_name == 'Supervisor') {
            ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Opciones de Cocina</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Opciones de cocina</h6>
                            <a class="collapse-item" href="opcionesCocina.php">Pedidos</a>
                        </div>
                    </div>
                </li>
            <?php } ?>

            <?php
            if ($Rol_name == 'Mesero' || $Rol_name == 'Admin' || $Rol_name == 'Supervisor') {
            ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Opciones de Mesero </span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Opciones de mesero</h6>
                            <a class="collapse-item" href="orden.php">Crear Comanda</a>
                        </div>
                    </div>
                </li>
            <?php } ?>



            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Heading -->
            <div class="sidebar-heading">
                secciones
            </div>



            <!-- Nav Item - Charts -->
            <?php if ($Rol_name == "Admin" || $Rol_name == "Supervisor" || $Rol_name == "Mesero") { ?>
                <li class="nav-item">
                    <a class="nav-link" href="orden.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Crear Servicio</span></a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <?php if ($Rol_name == "Admin" || $Rol_name == "Supervisor" || $Rol_name == "Cocinero") { ?>
                    <a class="nav-link" href="recetasIndex.php">
                        <i class="fas fa-book-open"></i>
                        <span>Crear Recetas</span></a>
            </li>
        <?php } ?>

        <!-- Crear orden -->
        <!-- <li class="nav-item">
                <a class="nav-link" href="crearOrden.php">
                    <i class="fas fa-fw fa-utensils"></i>
                    <span>Crear Orden</span></a>
            </li> -->

        <!-- Nav Item - Tables -->

        <?php if ($Rol_name == "Admin" || $Rol_name == "Supervisor" || $Rol_name == "Cocinero") { ?>

            <li class="nav-item">
                <a class="nav-link" href="inventarios.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Inventario</span></a>
            </li>
        <?php } ?>

        <?php
        // } 
        ?>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <a class="nav-link" href="misVentas.php">
                <i class="fas fa-dollar-sign"></i>
                <span>Mis Ventas</span></a>
        </li>
        <?php
        if ($Rol_name == 'Admin' || $Rol_name == 'Supervisor') {
        ?>

            <!-- <li class="nav-item">
                    <a class="nav-link" href="log_view.php">
                        <i class="fas fa-file"></i>
                        <span>Log</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sucursales.php">
                        <i class="fas fa-store"></i>
                        <span>Sucursales</span></a>
                </li> -->

        <?php
        }
        ?>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nombre; ?></span>
                                <?php if ($imgRequest) { ?>
                                    <img class="img-profile rounded-circle" src="<?php echo 'img/' . $imgRequest ?>">
                                <?php } else { ?>
                                    <img class="img-profile rounded-circle"" src=" img/profile.png">
                                <?php } ?>

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="userProfile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuracion
                                </a> -->
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-store fa-sm fa-fw mr-2 text-gray-400"></i>
                                    <?php echo $sucursalNombre; ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="php/cerrar_session.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>