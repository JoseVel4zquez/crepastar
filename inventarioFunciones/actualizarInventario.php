<?php
include "../php/conexion.php";
$id = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$unidad = $_POST['unidad'];
$clase = $_POST['clase'];
$precio = $_POST['precio'];
$sucursal = $_POST['id_sucursal'];

$sql = "UPDATE   inventario SET nombre='$nombre', cantidad ='$cantidad',unidad='$unidad',precio='$precio',id_sucursal='$sucursal',id_cat='$clase' WHERE id_producto='$id'";
$res = mysqli_query($conexion, $sql);
if ($res) {
    echo "<script>alert('producto Actualizado')</script>";
    header("location:../inventarios.php");
} else {
    echo "error";
}
