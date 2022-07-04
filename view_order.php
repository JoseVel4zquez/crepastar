<?php
include 'php/conexion.php';
include "componentes/header.php";

$id = $_GET['id'];

$sql3 = "SELECT * from servicios";
$resulta = $conexion->query($sql3);

$sql12 = "SELECT id_servicio FROM orden  WHERE id_servicio < '$id' ORDER BY id_servicio DESC LIMIT 1";
$response = current($conexion->query($sql12)->fetch_array());



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php if ($response != $id) { ?>
                <div class="col-md-6">
                    <div class="alert alert-info" role="alert">
                        <a href="view_order.php?id=<?php echo $response ?>">Numero de comanda anterior: <?php echo $response ?></a>

                    </div>
                </div>
            <?php } ?>
            <?php if ($response != $id) { ?>
                <div class="col-md-6">
                    <div class="alert alert-light" role="alert">
                        Numero de orden Actual: <?php echo $id ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-6">
                    <div class="alert alert-info" role="alert">
                        Se esta visualizando la orden Anterior
                    </div>
                </div>
            <?php } ?>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Qty</th>
                    <th>Orden</th>
                    <th>Comentario</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <?php if ($Rol_name == "Mesero" || $Rol_name == "Admin" || $Rol_name == "Cajero") { ?>
                        <th>Eliminar</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;

                $qry = $conexion->query("SELECT * FROM orden o inner join productos p on o.id_producto = p.id_producto  where id_servicio =" . $_GET['id']);
                while ($row = $qry->fetch_assoc()) :
                    $total += $row['qty'] * $row['precio'];
                ?>
                    <tr>
                        <td><?php echo $row['qty'] ?></td>
                        <td><?php echo $row['codigo'] ?></td>
                        <td><?php echo $row['comentario'] ?></td>
                        <td><?php echo number_format($row['qty'] * $row['precio'], 2) ?></td>
                        <td style="width: 20%"><?php echo $row['Created_at'] ?> </td>
                        <?php if ($Rol_name == "Mesero" || $Rol_name == "Admin" || $Rol_name == "Cajero") { ?>
                            <td><a class="btn btn-outline-danger" href="ordenFunciones/eliminarOrden.php?id=<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></a></td>
                        <?php } ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <?php if ($Rol_name == "Mesero" || $Rol_name == "Admin" || $Rol_name == "Cajero") { ?>
                    <tr>
                        <th colspan="2" class="text-right">TOTAL</th>
                        <th id="dinero">$<?php echo number_format($total, 2) ?></th>

                    </tr>
                <?php } ?>
            </tfoot>
        </table>
        <div class="text-center">
            <?php if ($Rol_name == "Mesero" || $Rol_name == "Cajero" || $Rol_name == "Admin" || $Rol_name == "Supervisor") { ?>
                <a href="imprimir_ticket.php?id=<?php echo $id ?>&&dinero=<?php echo number_format($total, 2) ?>&&userId=<?php echo $id_usuario ?>" class="btn btn-primary"><i class="fas fa-dollar-sign"></i> Pagar</a>
                <button onclick="regresar()" class="btn btn-secondary">Cerrar</button>
            <?php } else { ?>
                <a class="btn btn-primary" href="ordenFunciones/orderStatus.php?id=<?php echo $id ?>">Completado</a>
                <a class="btn btn-secondary" href="index.php">Cerrar</a>
                <!-- <a href="opcionesCocina.php" class="btn btn-secondary">Cerrar</a> -->
            <?php } ?>
        </div>
    </div>
</body>
<script>
    function regresar() {
        window.history.go(-1);
    }
</script>

</html>