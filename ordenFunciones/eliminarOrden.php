<?php
include "../php/conexion.php";
include "../assets/log.php";
session_start();
if (!isset($_SESSION['codigo'])) {
    echo '<script>alert("Inicia session")</script>';
    header("location:login.php");
    session_destroy();
    die();
}

$id = $_GET['id'];

$que = "SELECT qty FROM orden WHERE id = '$id'";
$res = current($conexion->query($que)->fetch_array());

$queu = "SELECT id_producto FROM orden WHERE id = '$id'";
$resu = current($conexion->query($queu)->fetch_array());

if($resu == true){
    $ma = "UPDATE productos SET cantidad_stock = cantidad_stock + '$res' WHERE id_producto = '$resu'";
    $ans = $conexion->query($ma);

    $query = "DELETE FROM orden WHERE id = '$id'";

    $resultado = $conexion->query($query);

    // echo $id;

    if ($resultado) {
        // Log_usuarios($user_id, "Elimino una orden", $fecha, $hora);
        echo '
            <script>
            window.history.go(-1);
            </script>';
    } else {
        echo '<script>
                alert("Ocurrio un error al eliminar");
                window.history.go(-1);
            </script>';
    }
}
