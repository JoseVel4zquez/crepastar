<?php
include './componentes/header.php';
include './php/conexion.php';
$sql = "SELECT * from costos inner join usuarios on costos.id_usuarios = usuarios.id_usuario";
$res = $conexion->query($sql);
$totales = "SELECT sum(VentaUsuario) from costos  ";
$totalR = current($conexion->query($totales)->fetch_array());
date_default_timezone_set('America/Mexico_City');
$fechaActual = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
</head>

<body>
    <h2 class="text-center">Los resultado se muestran por identificador de usuario</h2><br>
    <!-- <h3 class="text-end my-3 mx-3">Fecha: <?php echo $fechaActual ?></h3> -->
    <div class="row m-5 pb-3">
        <!-- <canvas id="grafica" class="my-3"></canvas> -->
        <div class="col-md-6">
            <h1>Total de ventas</h1>
        </div>
        <div class="col-md-3 d-flex flex-row-reverse">
            <?php if ($totalR) { ?>
                <h1>$<?php echo $totalR ?>MXN</h1>
            <?php } else { ?>
                <h1>Aun no hay registro de ventas</h1>
            <?php } ?>
        </div>

    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4 mx-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Identificador de usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Fecha en la que se realizo la venta</th>
                    <th scope="col">Total de la venta</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                while ($filas = $res->fetch_assoc()) { ?>
                    <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td><?php echo $filas['id_usuarios'] ?></td>
                        <td><?php echo $filas['usuarioNombre'] ?></td>
                        <td><?php echo $filas['codigo'] ?> </td>
                        <td><?php echo $filas['created_at'] ?> </td>
                        <td>$<?php echo $filas['ventaUsuario'] ?>Mxn </td>
                    </tr>
                <?php } ?>
                <tr>
                    <th colspan="5" class="text-right">TOTAL</th>
                    <th id="dinero"><?php if ($totalR) { ?>
                            <?php echo "$" . $totalR . "Mxn" ?>
                        <?php } else { ?>
                            Aun no hay registro de ventas
                        <?php } ?>

                </tr>

            </tbody>
        </table>
    </div>

</body>

</html>
<?php
include './componentes/footer.php'
?>