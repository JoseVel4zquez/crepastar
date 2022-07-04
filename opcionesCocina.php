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
    <title>Inventarios</title>
</head>

<body>

    <body>
        <div class="container mt-5">
        <h1>Cocina</h1>
            <div class="row">
                <div class="col-lg-10 m-5">
                    <h1>Comanda en proceso</h1>
                    <table class="table table-striped mt-5">
                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha y Hora</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Mesa</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Status</th>
                                <?php if($Rol_name == 'Admin' || $Rol_name == 'Supervisor' || $Rol_name == 'Mesero'){ ?>
                                    <th scope="col">Delete</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Crear</th>
                                <?php } ?>
                                <th scope="col">Ver</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $i=1;
                             while ($filas = mysqli_fetch_assoc($resulta)) { ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $filas['created_at']; ?></td>
                                    <td><?php echo $filas['comensales']; ?></td>
                                    <td><?php echo $filas['Id_Mesa']; ?></td>
                                    <td><?php echo $filas['id_usuario']; ?></td>
                                    <?php if($filas['status_servicio'] == 1): ?>
                                        <td class="text-center"><span class="badge badge-success">Paga</span></td>
                                    <?php else: ?>
                                        <td class="text-center"><span class="badge badge-secondary">Pend</span></td>
                                    <?php endif ?>
                                    <?php if($Rol_name == 'Admin' || $Rol_name == 'Supervisor'){ ?>
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