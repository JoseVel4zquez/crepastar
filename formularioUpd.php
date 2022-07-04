<?php
include 'php/conexion.php';
include 'componentes/header.php';

$id = $_GET['id'];
$sql = "SELECT * FROM  sucursales WHERE id_sucursal='$id'";
$res = mysqli_query($conexion, $sql);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sucursales</title>
</head>

<body>

    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col md-3">
                    <h1>Actualizar Sucursales</h1>
                    <form action="sucursaleFn/updateSucursal.php" method="POST">
                        <div class="mb-4">
                            <?php while ($fila = mysqli_fetch_assoc($res)) { ?>
                                <label for="nombre" class="form-label">Nombre de la sucursal</label>
                                <input type="text" name="nombre" id="codigo" value="<?php echo $fila['nombre_sucursal'] ?>" class="form-control" placeholder="Nombre de la sucursal">
                                <input type="hidden" name="id_sucursal" value="<?php echo $fila['id_sucursal'] ?>">
                            <?php } ?>
                        </div>

                        <div class="d-grid col">
                            <button type="submit" class="btn btn-primary">Actualizar Sucursal</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
        <script src="js/confirmacion.js"></script>


</html>
<?php
include 'componentes/footer.php';
?>