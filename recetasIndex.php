<?php
include 'php/conexion.php';
include 'componentes/header.php';
$sql4 = "SELECT * from recetas where id_sucursal = '$sucursal'";
$resultado = $conexion->query($sql4);



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
        <div class="col-lg-10">
            <a href="recetas.php" class="btn btn-primary mx-5">Crear una nueva receta <i class="fas fa-book-open"></i></a>
        </div>
        <?php
        if (isset($_GET['error'])) {
        ?>
            <div class="alert alert-danger mx-5 my-2" role="alert">
                <?php echo $_GET['error']; ?> <i class="fas fa-exclamation-circle"></i>
            </div>
        <?php } ?>
        <?php
        if (isset($_GET['success'])) {
        ?>
            <div class="alert alert-success mx-5 my-2" role="alert">
                <?php echo $_GET['success']; ?><i class="fas fa-check-circle"></i>
            </div>
        <?php } ?>
        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($resultado)) {
            ?>
                <div class="col-lg-6">
                    <form action="recetasFunciones/crearProductos.php" method="POST">
                        <div class="row">

                            <div class="col-lg-6 m-5">
                                <div class="card menu-item ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-end">

                                            <a class="btn btn-outline-danger" href="assets/eliminarReceta.php?id=<?php echo $row['id_receta'] ?>">X</a>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <h5 class="card-title"><?php echo $row['nombre']; ?></h5>

                                        </div>


                                        <p class="card-text truncate"><?php echo $row['ingredientes']; ?></p>
                                        <p class="card-text truncate"><?php echo $row['descripcion']; ?></p>
                                    </div>
                                    <input type="number" name="cantidad" placeholder="0" />
                                    <input type="hidden" name="id_receta" value="<?php echo $row['id_receta']; ?>" />
                                    <input type="hidden" name="recetaTipo" value="<?php echo $row['RecetaTipo']; ?>" />
                                    <input type="hidden" name="precio" value="<?php echo $row['precio']; ?>" />
                                    <input type="hidden" name="id_sucursal" value="<?php echo $sucursal; ?>" />

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
    <script src="js/confirmacion.js"></script>
</body>

</html>