<?php
include 'php/conexion.php';
include 'componentes/header.php';
// $sql4 = "SELECT * from productos";
date_default_timezone_set('America/Mexico_City');
$fechaActual = date('Y-m-d');



if (isset($_POST['date'])) {
    $fecha = $_POST['date'];
    $sql4 = "SELECT * from orden WHERE  id_sucursal = '$sucursal' and Created_at like '%$fecha%'";
    $resultado = $conexion->query($sql4);
} else {
    $sql4 = "SELECT * FROM orden WHERE  id_sucursal = '$sucursal' and Created_at like '%$fechaActual%'";
    $resultado = $conexion->query($sql4);
}

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
        <a style="right: 50px;" href="index.php" class="btn btn-danger"><i class="fas fa-times  "></i></a>
    </div>
    <div>
        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($resultado)) {
            ?>
                <div class="">
                    <div class="row">
                        <div class="col-lg-10 m-5">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    <?php echo "Numero de orden: " . $row['id']; ?>
                                    <div class="text-white-50 small">
                                        <?php echo "Numero de servicio: " . $row['id_servicio']; ?></div>
                                    <div class="text-white-50 small"><?php echo "Numero de producto: " . $row['id_producto']; ?>
                                        <div class="text-white-50 small"><?php echo "Cantidad pedida: " . $row['qty']; ?></div>
                                        <div class="text-white-50 small"><?php echo "Fecha creada: " . $row['Created_at']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>