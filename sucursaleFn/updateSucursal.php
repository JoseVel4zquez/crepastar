<?php
include '../php/conexion.php';
$id_sucursal = $_POST['id_sucursal'];
$nombre = $_POST['nombre'];

$query = "UPDATE sucursales SET nombre_sucursal ='$nombre' where id_sucursal = '$id_sucursal'";
$res = $conexion->query($query);

if ($res) {

    header("location:../sucursales.php");
} else {
    echo "ocurrio un error";
}
