<?php
include "componentes/header.php";
include "php/conexion.php";
$id = $_GET['id'];
$sql = "SELECT * from inventario p inner join categoria_inventario o on p.id_cat = o.id_cat WHERE id_producto='$id'";
$res = mysqli_query($conexion, $sql);

$ssql = "SELECT * FROM categoria_inventario";
$resul = mysqli_query($conexion, $ssql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>
    <form action="inventarioFunciones/actualizarInventario.php" method="POST" class="m-5">
        <?php while ($fila = mysqli_fetch_assoc($res)) { ?>
            <div class="mb-4">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="codigo" class="form-control" placeholder="Nombre del articulo" value="<?php echo $fila['nombre'] ?>">
            </div>
            <div class=" mb-4">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" value="<?php echo $fila['cantidad'] ?>">
            </div>
            <div class=" mb-4">
                <label for="unidad" class="form-label">Unidad</label>
                <input type="text" name="unidad" id="unidad" class="form-control" placeholder="Unidad" value="<?php echo $fila['unidad'] ?>">
            </div>
            <div class=" mb-4">
                <label for="clase" class="form-label">Clase</label>
                <select name="clase" class="form-select form-select-sm m-2 form-control">
                    <option value="<?php echo $fila['id_cat']; ?>"><?php echo $fila['producto'] ?></option>
                    <?php while ($fili = mysqli_fetch_assoc($resul)) { ?>
                        <option value="<?php echo $fili['id_cat']; ?>"><?php echo $fili['producto'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class=" mb-4">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" name="precio" id="precio" class="form-control" placeholder="Precio" value="<?php echo $fila['precio'] ?>">
            </div>


            <input type="hidden" name="id_producto" id="id_producto" class="form-control" value="<?php echo $fila['id_producto'] ?>">
            <input type="hidden" name="id_sucursal" id="id_sucursal" class="form-control" value="<?php echo $sucursal ?>">

        <?php } ?>

        <div class=" d-grid mb-5">
            <button type="submit" class="btn btn-primary">Actualizar articulo</button>
        </div>
        <!-- opciones extra de inicio de sesion  -->
        <!-- <div class="my-3">
                        <span>No tienes cuenta <a href="#">Registrate</a></span><br>
                        <span><a href="#">Recuperar clave</a></span>
                    </div> -->
    </form>
</body>

</html>