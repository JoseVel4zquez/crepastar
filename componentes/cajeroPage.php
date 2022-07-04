<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cajero</title>
</head>

<body>

    <h2 class="text-center mx-5">Se debe iniciar Comanda antes de agregar los articulos</h2>
    <?php if ($status) { ?>
        <div class="alert alert-info" role="alert">
            Comanda activa
        </div>
    <?php } ?>
    <div class="d-flex flex-row-reverse m-5 fixed-bottom">
        <?php if ($status) { ?>
            <a href="view_order.php?id=<?php echo $orderId; ?>" class="btn btn-primary btn-circle btn-lg shadow-sm">
                <i class="far fa-eye"></i>
            </a>
            <span class="badge badge-danger h-50" id="badgeProduct"><?php echo $cantidadCarrito ?></span>
        <?php } ?>
    </div>
    <div class="row m-5 align-items-center">

        <?php while ($filas = mysqli_fetch_assoc($productResponse)) { ?>
            <div class="col-sm-6 my-2">
                <form action="ordenFunciones/funcionOrden.php" method="POST">
                    <div class="card" id="container">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $filas['codigo'] ?></h5>
                            <p class="card-text"><?php echo "Precio: $" . $filas['precio'] ?></p>
                            <input type="number" name="cantidad" id="cantidad" placeholder="0" required>
                            <input type="text" name="comentario" id="comentario" placeholder="comentario">
                            <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $filas['id_producto'] ?>">
                            <input type="hidden" name="servicio" value="<?php echo $orderId ?>">
                            <input type="hidden" name="sucursalID" value="<?php echo $sucursal ?>">
                            <?php if ($status) { ?>
                                <button type="submit" class="btn btn-primary" id="colorized" onclick="btnChanger()">Añadir</button>
                            <?php } else { ?>
                                <button type="submit" class="btn btn-primary" disabled>Añadir</button>
                            <?php } ?>
                        </div>
                    </div>
                </form>

            </div>
        <?php } ?>

    </div>

    <!-- <script>
        $(document).ready(function (){
            $("#colorized").click(function (e) {
                e.preventDefault
            })
        })
    </script> -->
</body>

</html>