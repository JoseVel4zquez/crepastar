<?php


include 'php/conexion.php';
include 'componentes/header.php';
include_once('assets/roles.php');
if (!isset($_SESSION['codigo'])) {
    echo '<script>alert("Inicia session")</script>';
    header("location:login.php");
    session_destroy();
    die();
}

$nombre = $_SESSION['codigo'];
$Rol_name = obtner_rol($nombre);
$obtener_id_usuario = "SELECT id_usuario from usuarios where codigo ='$nombre'";
$id_usuario = current($conexion->query($obtener_id_usuario)->fetch_array());

$sql = "SELECT * from mesas";
$sql2 = "SELECT * from usuarios";
$sql3 = "SELECT * from servicios where status_servicio = 0 AND id_sucursal='$sucursal'";
// $id = $_GET['id']; 
$res = $conexion->query($sql);
$resul = $conexion->query($sql2);
$resulta = $conexion->query($sql3);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comandas</title>
</head>

<body>

    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col md-3">
                    <h1>Registrar Comanda</h1>
                    <form action="ordenFunciones/guardarOrden.php" method="POST">
                        <!-- <div class="mb-4">
                            <label for="nombre" class="form-label">Fecha</label>
                            <input type="date" name="fecha" id="codigo" class="form-control" placeholder="Nombre del articulo">
                        </div> -->
                        <div class="mb-4">
                            <label for="cantidad" class="form-label">Nombre del cliente</label>
                            <input type="text" name="cliente_nombre" id="cantidad" class="form-control" placeholder="Nombre del cliente">
                        </div>
                        <div class="mb-4">
                            <label for="unidad" class="form-label">Comensales</label>
                            <input type="number" name="comensales" id="unidad" class="form-control" placeholder="Unidad" value="1">
                            <input type="hidden" value="<?php echo $sucursal ?>" name="sucursalID" id="sucursalID" class="form-control" placeholder="Unidad">
                        </div>
                        <div class="mb-4">
                            <label for="fecha" class="form-label">Mesa</label>
                            <select name="mesa">
                                <?php while ($row = $res->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['Id_Mesa']; ?>"><?php echo $row['MesaNombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-4">

                            <input type="hidden" name="mesero" id="mesero" value="<?php echo $id_usuario ?>">
                        </div>

                        <!-- opciones extra de inicio de sesion  -->
                        <!-- <div class="my-3">
                        <span>No tienes cuenta <a href="#">Registrate</a></span><br>
                        <span><a href="#">Recuperar clave</a></span>

                        </div> -->

                        <div class="d-grid mb-5">
                            <button type="submit" class="btn btn-primary">Crear Nueva comanda</button>
                        </div>
                    </form>
                    <!-- <div class="d-grid mb-5">
                        <?php
                        if (isset($_POST['truncateButton'])) {
                            mysqli_query($conexion, 'TRUNCATE TABLE `servicios`');
                            header("Location: orden.php");
                            exit();
                        }
                        ?>
                        <form>
                            <input name="truncateButton" type="submit" class="btn btn-danger" value="Eliminar Todo"></input>
                        </form>
                    </div> -->
                </div>
                <div class="col md-9 lg-9">
                    <h1>Comandas</h1>
                    <table class="table table-striped mt-5">
                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha y hora</th>
                                <!-- <th scope="col">Hora</th> -->
                                <th scope="col">Comensales</th>
                                <th scope="col">Mesa</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Status</th>
                                <?php if ($Rol_name == 'Admin' || $Rol_name == 'Supervisor' || $Rol_name == 'Mesero') { ?>
                                    <th scope="col">Eliminar</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Crear</th>
                                <?php } ?>
                                <th scope="col">Ver</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($filas = mysqli_fetch_assoc($resulta)) { ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $filas['created_at']; ?></td>
                                    <td><?php echo $filas['comensales']; ?></td>
                                    <td><?php echo $filas['Id_Mesa']; ?></td>
                                    <td><?php echo $filas['id_usuario']; ?></td>
                                    <?php if ($filas['status_servicio'] == 1) : ?>
                                        <td class="text-center"><span class="badge badge-success">Complet</span></td>
                                    <?php else : ?>
                                        <td class="text-center"><span class="badge badge-secondary">Pend</span></td>
                                    <?php endif ?>
                                    <?php if ($Rol_name == 'Admin' || $Rol_name == 'Supervisor' || $Rol_name == 'Mesero') { ?>
                                        <td><a class="btn btn-outline-danger" href="ordenFunciones/eliminar.php?id=<?php echo $filas['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                                        <td><a class="btn btn-outline-warning" href="editarServicio.php?id=<?php echo $filas['id']; ?>"><i class="fas fa-edit"></i></a></td>
                                        <td><a class="btn btn-outline-primary" href="crearOrden.php?id=<?php echo $filas['id']; ?>"><i class="fas fa-utensils"></i></a></td>
                                    <?php } ?>
                                    <td><a class="btn btn-outline-primary" href="view_order.php?id=<?php echo $filas['id'] ?>"><i class="fas fa-eye"></i></a></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="js/confirmacion.js"></script>

</html>
<?php
include 'componentes/footer.php';
?>