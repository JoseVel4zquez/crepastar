<?php
include 'php/conexion.php';
include 'componentes/header.php';
$servicios = "SELECT * FROM servicios WHERE status_servicio='0' and id_sucursal = '$sucursal'";
$consulta = $conexion->query($servicios);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenes</title>
</head>

<body>
    <div class="col-lg-10">
        <a href="index.php" class="btn btn-danger"><i class="fas fa-times"></i></a>
    </div>
    <div>
        <div class="row">
            <?php while ($filas = mysqli_fetch_assoc($consulta)) { ?>
                <div class="col-lg-4 mb-5" style="left: 30px; top: 10px;">
                    <div class="row">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-body">
                                <?php echo "Numero de servicio: " . $filas['id']; ?>
                                <div class="text-white-50 small">
                                    <?php echo "Numero de comensales: " . $filas['comensales']; ?></div>
                                <div class="text-white-50 small"><?php echo "Fecha: " . $filas['fecha']; ?></div>
                                <div class="text-white-50 small"><?php echo "hora: " . $filas['hora']; ?></div>
                                <div class="text-white-50 small"><?php echo "numero de mesa: " . $filas['Id_Mesa']; ?></div>
                                <div class="text-white-50 small">
                                    <?php echo "identificador de mesero: " . $filas['id_usuario']; ?>
                                </div>
                                <a class="btn btn-outline-success mt-2" href="ordenFunciones/orderStatus.php?id=<?php echo $filas['id']; ?>"> Marcar como
                                    completado <i class="far fa-check-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>