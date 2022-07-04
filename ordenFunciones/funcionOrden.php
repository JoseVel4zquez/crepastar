<?php


// $id_producto = $_POST['id_producto'];
// $servicio = $_POST['servicio'];
// $cantidad = $_POST['cantidad'];

// echo $id_producto. " ". $servicio. " ". $cantidad;

include "../php/conexion.php";

$id_producto = $_POST['id_producto'];
$servicio = $_POST['servicio'];
$cantidad = $_POST['cantidad'];
$sucursalID = $_POST['sucursalID'];
$comentario = $_POST['comentario'];

// id_servicio	id_prodcuto	qty     

// $sql = "SELECT cantidad_stock FROM productos WHERE id_producto = '$id_producto'";
// $res = current($conexion->query($sql)->fetch_array());

// $opera = $res-$cantidad;
// if($opera <= -1){
//     echo '
//     <script>
//         alert("No hay suficiente en stock")
//         window.location="../orden.php"
//     </script>';
//     header("location:../orden.php");
//     session_destroy();
//     die(); 
// }

$ja = "SELECT cantidad_stock FROM productos WHERE id_producto = '$id_producto'";
$ka = current($conexion->query($ja)->fetch_array());

if($cantidad > $ka){
    echo '<script>alert("No hay suficientes productos en existencia"); window.history.go(-1);</script>';
} else {
    $query = "INSERT INTO orden(id_servicio,qty,id_sucursal,comentario,id_producto) VALUES('$servicio', '$cantidad','$sucursalID','$comentario','$id_producto')";
    $resultado = $conexion->query($query);

    $qrty = "UPDATE productos SET cantidad_stock = cantidad_stock - '$cantidad' WHERE id_producto = '$id_producto'";
    $hs = $conexion->query($qrty);

    // $update_stock = "UPDATE productos SET cantidad_stock = '$opera' WHERE id_producto = '$id_producto'";
    // $resul = $conexion->query($update_stock);

    if ($resultado) {
        echo '
            <script>
            window.history.go(-1);
            </script>';
    } else {
        echo "No jalo dice";
    }
}


