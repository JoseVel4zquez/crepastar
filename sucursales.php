<?php
include 'php/conexion.php';
include 'componentes/header.php';


$sql = "SELECT * from sucursales";
$res = $conexion->query($sql);

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
                    <h1>Registrar Sucursales</h1>
                    <form action="sucursaleFn/indexSucursal.php" method="POST">
                        <div class="mb-4">
                            <label for="nombre" class="form-label">Nombre de la sucursal</label>
                            <input type="text" name="nombre" id="codigo" class="form-control" placeholder="Nombre de la sucursal">
                        </div>

                        <div class="d-grid col">
                            <button type="submit" class="btn btn-primary">Crear nueva Sucursal</button>
                        </div>

                    </form>
                </div>
                <div class="col md-9 lg-9">
                    <h1>Sucursales</h1>
                    <table class="table table-striped mt-5">
                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre de la sucursal</th>


                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($filas = mysqli_fetch_assoc($res)) { ?>
                                <tr>
                                    <th scope="row"><?php echo $filas['id_sucursal']; ?></th>
                                    <td><?php echo $filas['nombre_sucursal']; ?></td>


                                    <td><a class="btn btn-outline-danger" href="sucursaleFn/deletesucursal.php?id=<?php echo $filas['id_sucursal']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                                    <td><a class="btn btn-outline-warning" href="formularioUpd.php?id=<?php echo $filas['id_sucursal']; ?>"><i class="fas fa-edit"></i></a></td>
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