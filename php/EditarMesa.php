<?php

include "conexion.php";
$id = $_GET['id'];
$sql = "SELECT * FROM  mesas WHERE Id_Mesa='$id'";
$res = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>Editar Mesa</title>
</head>

<body>
    <form action="actualizarMesa.php" method="POST">
        <div class="mb-4">
            <?php while ($fila = mysqli_fetch_assoc($res)) { ?>
                <label for="nombre" class="form-label">Mesa</label>
                <input type="text" name="nombre" id="codigo" class="form-control" placeholder="Nombre de la mesa" value="<?php echo $fila['MesaNombre'] ?>">
                <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $fila['Id_Mesa'] ?>">
            <?php } ?>
        </div>

        <div class="d-grid mb-5">
            <button type="submit" class="btn btn-primary">Actualizar mesa</button>
        </div>
        <!-- opciones extra de inicio de sesion  -->
        <!-- <div class="my-3">
                        <span>No tienes cuenta <a href="#">Registrate</a></span><br>
                        <span><a href="#">Recuperar clave</a></span>
                    </div> -->
    </form>
</body>

</html>
<?php
include "../componentes/footer.php";
?>