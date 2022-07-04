<?php
include 'php/conexion.php';
include 'componentes/header.php';
// $sql4 = "SELECT * from recetas";
$sql4 = "SELECT * FROM productos";
$resultado = $conexion->query($sql4);

$id = $_GET['id'];


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
    <div>
        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($resultado)) {
            ?>
                <div class="">
                    <form action="ordenFunciones/funcionOrden.php" method="POST">
                        <div class="row">
                            <div class="col-lg-10 m-5">
                                <div class="card menu-item ">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['codigo']; ?></h5>
                                        <p class="card-text truncate"><?php echo "Precio: $" . $row['precio']; ?></p>
                                        <p class="card-text truncate"><?php echo "En existencia: " . $row['cantidad_stock']; ?></p>
                                    </div>
                                    <input type="number" name="cantidad" placeholder="0" />
                                    <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>" />
                                    <input type="hidden" name="servicio" value="<?php echo $id; ?>" />
                                    <input type="hidden" name="sucursalID" value="<?php echo $sucursal; ?>" />
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-sm btn-outline-primary btn-block"><i class="fa fa-plus"></i>Añadir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>