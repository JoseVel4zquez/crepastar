<?php

    include 'php/conexion.php';
    include 'componentes/header.php';
    $sql = "SELECT * from mesas";
    $sql2 = "SELECT * from usuarios";
    $id = $_GET['id'];

    $sql3 = "SELECT * FROM  servicios WHERE id='$id'";
    $res = $conexion->query($sql);
    $resul = $conexion->query($sql2);
    $resulta = mysqli_query($conexion, $sql3);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
</head>

<body>

    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col md-3">
                    <h1>Editar Servicios</h1>
                    <form action="ordenFunciones/modificar.php" method="POST">
                        <?php while ($fila = mysqli_fetch_assoc($resulta)) { ?>
                            <div class="mb-4">
                                <label for="nombre" class="form-label">Fecha</label>
                                <input type="date" name="fecha" id="codigo" class="form-control" placeholder="Nombre del articulo" value="<?php echo $fila['fecha']; ?>">
                            </div>
                            <div class="mb-4">
                                <label for="cantidad" class="form-label">Hora</label>
                                <input type="time" name="hora" id="cantidad" class="form-control" placeholder="Cantidad" value="<?php echo $fila['hora']; ?>">
                            </div>
                            <div class="mb-4">
                                <label for="unidad" class="form-label">Comensales</label>
                                <input type="number" name="comensales" id="unidad" class="form-control" placeholder="Unidad" value="<?php echo $fila['comensales'] ?>">
                            </div>

                            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $fila['id'] ?>">

                        <?php } ?>
                        <div class="mb-4">
                            <label for="fecha" class="form-label">Mesa</label>
                            <select name="mesa">
                                <?php while($row = $res->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['Id_Mesa']; ?>"><?php echo $row['MesaNombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="clase" class="form-label">Mesero</label>
                            <select name="mesero">
                                <?php while($row = $resul->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['id_usuario']; ?>"><?php echo $row['usuarioNombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- opciones extra de inicio de sesion  -->
                        <!-- <div class="my-3">
                        <span>No tienes cuenta <a href="#">Registrate</a></span><br>
                        <span><a href="#">Recuperar clave</a></span>
                        </div> -->
                        <div class="d-grid mb-5">
                            <button type="submit" class="btn btn-primary">Editar servicio</button>
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