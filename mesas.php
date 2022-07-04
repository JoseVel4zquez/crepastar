<?php
include 'php/conexion.php';
include 'componentes/header.php';
$sql = "SELECT * from mesas";
$res = $conexion->query($sql);

?>
<!-- inicia el html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <title>Mesas</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col md-3">
                <h1>Registrar Stand</h1>
                <form action="php/saveMesa.php" method="POST">
                    <div class="mb-4">
                        <label for="nombre" class="form-label">Stand</label>
                        <input type="text" name="nombre" id="codigo" class="form-control" placeholder="Nombre del Stand">
                    </div>

                    <div class="d-grid mb-5">
                        <button type="submit" class="btn btn-primary">Crear nuevo Stand</button>
                    </div>
                    <!-- opciones extra de inicio de sesion  -->
                    <!-- <div class="my-3">
                        <span>No tienes cuenta <a href="#">Registrate</a></span><br>
                        <span><a href="#">Recuperar clave</a></span>
                    </div> -->
                </form>
            </div>
            <div class="col md-8">
                <h1>Stand</h1>
                <table class="table table-striped mt-5">
                    <thead>

                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Eliminar</th>
                            <th scope="col">Editar</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($filas = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <th scope="row"><?php echo $filas['Id_Mesa']; ?></th>
                                <td><?php echo $filas['MesaNombre']; ?></td>
                                <td><a class="btn btn-outline-danger" href="php/EliminarMesa.php?id=<?php echo $filas['Id_Mesa']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                                <td><a class="btn btn-outline-warning" href="php/EditarMesa.php?id=<?php echo $filas['Id_Mesa']; ?>"><i class="fas fa-edit"></i></a></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/confirmacion.js"></script>
</body>

</html>
<?php
include 'componentes/footer.php';
?>