<?php
include '../php/conexion.php';

$nombre_sucursal = $_POST['nombre'];

$consul = "INSERT into sucursales (nombre_sucursal) values ('$nombre_sucursal')";
$sql = $conexion->query($consul);
if ($sql) {
    header("location:../sucursales.php");
}
