<?php
include '../php/conexion.php';
$cantidadProductos = $_POST['cantidad'];
$id_receta = $_POST['id_receta'];
$id_sucursal = $_POST['id_sucursal'];
$recetaTipo = $_POST['recetaTipo'];
$precio = $_POST['precio'];


$consulta = "SELECT nombre FROM recetas where id_receta='$id_receta'";
$query = current($conexion->query($consulta)->fetch_array());

$getItems = "SELECT ingredientes from recetas where id_receta='$id_receta'";
$response = $conexion->query($getItems)->fetch_row();







if ($query) {
    $nombre = $query;
    cantidades($id_receta, $cantidadProductos, $response, $id_sucursal);
    createProduct($id_receta, $cantidadProductos, $nombre, $recetaTipo,$precio,$id_sucursal);
} else {
    echo "ocurrio un error";
}
function createProduct($id_receta, $cantidadProductos, $nombre, $recetaTipo,$precio,$id_sucursal)
{
    include '../php/conexion.php';
    $peti = "SELECT id_producto from productos where id_receta='$id_receta' ";
    $resquery = $conexion->query($peti);
    if ($resquery->num_rows != 0) {
        $sql1 = "UPDATE productos SET cantidad_stock = cantidad_stock + '$cantidadProductos' where id_receta='$id_receta'";
        $query1 = $conexion->query($sql1);
        if (!$query1) {
            echo "fallo";
        }
    } else {
        $codigo = $nombre;
        
        $clase = "alimentos";
        $sql2 = "INSERT INTO productos (codigo,id_receta,precio,clase,cantidad_stock,id_sucursal)
         values ('$codigo','$id_receta','$precio','$recetaTipo','$cantidadProductos','$id_sucursal')";
        $query2 = $conexion->query($sql2);
    }
}
function getQTYres($response, $cantidades, $id_sucursal)
{
    include '../php/conexion.php';
    foreach ($response as $res) {

        $valor = explode(" , ", $res);
        $conteo = count($valor);

        for ($i = 0; $i < $conteo; $i++) {
            $agotado = "SELECT cantidad from inventario  where nombre ='$valor[$i]' and id_sucursal='$id_sucursal' ";
            $resultado[$i] = current($conexion->query($agotado)->fetch_array());
            if ($resultado[$i] >= $cantidades[$i]) {
                $peticion = "UPDATE inventario SET cantidad = cantidad - '$cantidades[$i]' where nombre ='$valor[$i]' and id_sucursal='$id_sucursal' ";
                $result[$i] = $conexion->query($peticion);
            } else {

                $message = "no hay suficientes ingredientes para hacer la receta";
                header("location:../recetasIndex.php?error=$message");
            }
            //$peticion = "SELECT cantidad from inventario where nombre='$valor[$i]'";
        }
    }

    if ($result) {

        $success = "Receta creada con exito";
        header("location:../recetasIndex.php?success=$success");
    } else {
        echo "";
    }
}

function cantidades($id_receta, $cantidadProductos, $response, $id_sucursal)
{
    include '../php/conexion.php';
    $sql = "SELECT cantidadIngredientes from recetas where id_receta='$id_receta'";
    $res = current($conexion->query($sql)->fetch_array());

    $cadena = explode(" , ", $res);
    $lenght = count($cadena);
    for ($i = 0; $i < $lenght; $i++) {
        $cantidades[$i] = $cadena[$i] * $cantidadProductos;
    }
    getQTYres($response, $cantidades, $id_sucursal);
}
