<?php
include 'componentes/header.php';
include 'php/conexion.php';

//contar servicios pendientes de $
$contar = "SELECT  COUNT(status_servicio) FROM servicios WHERE id_sucursal = '$sucursal' and status_servicio='0'";
$total = current($conexion->query($contar)->fetch_array());

//obtenemos el producto del inventario que casi se agota
$stock = "SELECT nombre  from inventario where id_sucursal = '$sucursal'  ORDER BY  cantidad ASC";
$query = $conexion->query($stock);
$CountInStock = $conexion->query($stock)->fetch_row();
//contamos los servicios completados
$Compleated = "SELECT  COUNT(status_servicio) FROM servicios WHERE id_sucursal = '$sucursal' and status_servicio='1'";
$taskCompleated = current($conexion->query($Compleated)->fetch_array());
//fecha
date_default_timezone_set('America/Mexico_City');
$fechaActual = date('Y-m-d');

//sucursales

$sucursales = "SELECT * FROM sucursales";
$sucurssalesRequest = $conexion->query($sucursales);
//ordenes pendietnes
$OrdenesPendientes = "SELECT * from servicios where id_sucursal='$sucursal' and status_servicio='0'";
$OrdenesPendientesRequest = $conexion->query($OrdenesPendientes);


//status
// $id = $_GET['id'];

//obtner los servicios por id
$servicios = "SELECT * FROM servicios  WHERE  id_sucursal = '$sucursal' and status_servicio='0' LIMIT 1";
$consulta = $conexion->query($servicios);

//obtener las ordenes por id
$idServicio = "SELECT * FROM orden WHERE  id_sucursal = '$sucursal' and id > 0 LIMIT 1 ";
$exe = $conexion->query($idServicio);

$turnos = "";
//comentarios
$queryComentario = "SELECT * FROM comentarios  LIMIT 1";
$comentario = $conexion->query($queryComentario);
// catalogo de productos
$productos = "SELECT * from productos where id_sucursal = '$sucursal'";
$productResponse = $conexion->query($productos);
//mesas
$Mesas = "SELECT * from mesas";
$MesasQuery = $conexion->query($Mesas);
//meseros
$Meseros = "SELECT * FROM usuarios where Id_rol=4";
$MeserosQuery = $conexion->query($Meseros);

//Opciones cocina
$nombre = $_SESSION['codigo'];
$Rol_name = obtner_rol($nombre);
$obtener_id_usuario = "SELECT id_usuario from usuarios where codigo ='$nombre'";
$id_usuario = current($conexion->query($obtener_id_usuario)->fetch_array());

$sql = "SELECT * from mesas";
$sql2 = "SELECT * from usuarios";
$sql3 = "SELECT * from servicios WHERE status_servicio = 0";
// $id = $_GET['id'];
$res = $conexion->query($sql);
$resul = $conexion->query($sql2);
$resulta = $conexion->query($sql3);


if (isset($_GET['orderId'])) {
    $total = 0;
    $orderId = $_GET['orderId'];
    $status = true;


    $qryInfo = "SELECT * FROM orden o inner join recetas p on o.id_receta = p.id_receta  where id_servicio ='$orderId'";
    $requestQryInfo = $conexion->query($qryInfo);
    $carrito = "SELECT * from orden where id_servicio ='$orderId'";
    $cantidadCarrito = $conexion->query($carrito)->num_rows;
} else {
    $orderId = "";
    $status = false;
}




?>
<title>Inicio</title>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de control</h1>
        <h1 class="h3 mb-0 text-gray-800"><?php echo "Inicio sesión como : " . $Rol_name ?></h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <?php if ($Rol_name === "Admin" || $Rol_name === "Supervisor") { ?>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center d-flex d-flex-row align-self-end">
                            <form action="ver_masIndex.php" method="POST" class=" row d-flex d-flex-row ">
                                <div class="col mr-3">

                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Fecha </div>

                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <input type="date" id="date" name="date">
                                    </div>
                                </div>
                                <div class="col-auto mb-4">
                                    <button type="submit" class="btn btn-outline-info my-2 " id="parrafo" name="sendDate">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </button>
                                </div>
                            </form>
                            <p>En este apartado se mostrara el historial del ordenes</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <!-- Earnings (Monthly) Card Example -->

        <?php if ($Rol_name == "Admin" || $Rol_name == "Supervisor") { ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Producto que tiene menor cantidad en existencia</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    if ($CountInStock) {
                                        print_r($CountInStock[0]);
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-outline-success my-2 " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </button>
                            </div>
                        </div>
                        <p>En este apartado se mostrara el producto que cuenta con la menor cantidad en inventario</p>
                    </div>
                </div>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Servicios Completados
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <?php
                                            if ($taskCompleated) {
                                                echo $taskCompleated;
                                            } else {
                                                echo "0";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $taskCompleated . "%" ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                            <p>En este apartado se mostraran cuantas ordenes se han completado</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">

                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Servicios Activos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php if ($total) {
                                        echo $total;
                                    } else {
                                        echo "0";
                                    } ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                            <p>En este apartado se mostraran las ordenes que aun no se entregan</p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php } ?>

<!-- aqui terminan las tarjetas -->
<div>
    <?php if ($Rol_name == "Cajero") { ?>
        <form action="assets/startOrder.php" method="POST" class="d-sm-flex align-items-center  mb-4">
            <label for="clienteNombre">Nombre del cliente</label>
            <input type="text" name="clienteNombre" id="clienteNombre" class="form-control w-20 mx-2">
            <label for="clienteNombre">Caja</label>
            <select name="mesa_id" id="mesa_id" class="form-select form-select-sm m-2 form-control" placeholder="Ingredientes" required>
                <?php while ($row = $MesasQuery->fetch_assoc()) { ?>
                    <option value="<?php echo $row['Id_Mesa']; ?>"><?php echo $row['MesaNombre']; ?></option>
                <?php } ?>
            </select>

            <input type="hidden" value="<?php echo $id_usuario; ?>" name="mesero_id"></input>
            <input type="hidden" name="sucursal" value="<?php echo $sucursal ?>"></input>
            <label for="clienteNombre">Numero de comensales</label>
            <input type="number" name="numComensales" id="clienteNombre" class="form-control w-20 mx-2" value="1">
            <?php if ($status) { ?>
                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" disabled>Iniciar orden</button>
            <?php } else { ?>
                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Iniciar orden</button>
            <?php } ?>
        </form>
    <?php } ?>
</div>
<!-- Ordenes -->
<!-- asignamos la vista dependiendo del rol de usuario -->
<?php
if ($Rol_name === "Admin" || $Rol_name === "Supervisor") {

    include 'componentes/adminPage.php';
} else if ($Rol_name === "Cajero") {
    include 'componentes/cajeroPage.php';
} else if ($Rol_name == 'Cocina') {
    include 'componentes/opcionesCocina2.php';
    echo '<script src="js/fn/app.js"></script>';
} else if ($Rol_name === "Mesero") {
    include 'componentes/MeseroPage.php';
}

?>


</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Productos con baja disponibilidad en inventario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">cantidad</th>
                            <th scope="col">Costo total de compra </th>
                        </tr>
                    </thead>
                    <tbody id="agotado">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<script src="./js/fn/agotado.js"></script>

<!-- Footer -->
<?php
include 'componentes/footer.php';
?>