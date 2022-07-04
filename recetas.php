<?php
include 'php/conexion.php';
include 'componentes/header.php';

$sql = "SELECT * from inventario WHERE id_sucursal='$sucursal' and  id_cat = 3 ";
$sql2 = "SELECT * from productos";
$res = $conexion->query($sql);
$resul = $conexion->query($sql2);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas</title>
</head>

<body>

    <body>
        <div class="container mt-5">
            <h1 style="text-align: center;">Registrar Recetas</h1>
            <div class="row">
                <div class="col md-3">
                    <!-- <h1>Registrar Recetas</h1> -->
                    <div class="row">


                    </div>

                    <form action="recetasFunciones/guardarRecetas.php" method="POST">
                        <div class="mb-4">
                            <label for="nombre" class="form-label">Nombre del Platillo</label>
                            <input type="text" name="nombre" id="codigo" class="form-control" placeholder="Nombre del platillo" required>
                        </div>

                        <div class="mb-4">
                            <label for="precio" class="form-label">Precio estimado para la receta</label>
                            <input type="text" name="precio" id="precio" class="form-control" placeholder="$0" required>
                        </div>

                        <div class="mb-4 clonar">
                            <div class="row">
                                <label for="descripcion" class="form-label m-2">Ingredientes</label>

                                <i class="text-danger fas fa-info-circle" style="cursor: pointer;" data-bs-toggle="popover" title="Ingredientes Info" data-bs-content="Para crear una receta los ingredientes deben ser dados de alta previamente en el almacen"></i>
                                <div class="d-flex">

                                </div>
                                <select name="ingrediente[]" id="ingrediente" class="form-select form-select-sm m-2 form-control" placeholder="Ingredientes" required>
                                    <?php while ($row = $res->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['id_producto']; ?>"><?php echo $row['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                                <label for="descripcion" class="form-label m-2">Cantidad de ingrediente</label>
                                <div class="d-flex flex-row w-100">

                                    <input type="number" name="cantidad[]" id="cantidad" value="0" class="mx-2 my-2 form-control w-50" required>
                                    <select name="unidad[]" class="form-control w-50 my-2">
                                        <option value="ml">Ml</option>
                                        <option value="mg">Mg</option>
                                        <option value="mg">kg</option>
                                        <option value="mg">L</option>
                                    </select>
                                    <button class="btn btn-primary m-2" id="agregar"><i class="fas fa-plus"></i></button>
                                </div>

                            </div>

                        </div>
                        <div id="contenedor"></div>
                        <div class="mb-4">
                            <label for="nombre" class="form-label">Elaboracion</label>
                            <textarea name="descripcion" id="codigo" class="form-control" placeholder="Escriba la elaboracion" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="nombre" class="form-label">Tipo</label>
                            <select name="recetaClase" id="recetaClase" class="form-select form-select-sm m-2 form-control">
                                <option value="alimentos">Alimentos</option>
                                <option value="bebidas">Bebidas</option>
                            </select>
                        </div>
                        <input type="hidden" name="sucursal_id" id="sucursal_id" value="<?php echo $sucursal; ?>">

                </div>



                <div class="d-grid mb-5">
                    <button type="submit" class="btn btn-primary">Crear nuevo articulo</button>
                </div>
                </form>
            </div>
        </div>
        <script src="js/confirmacion.js"></script>
        <script src="js/clon.js"></script>



</html>
<?php
include 'componentes/footer.php';
?>