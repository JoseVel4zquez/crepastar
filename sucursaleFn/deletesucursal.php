<?php
include '../php/conexion.php';
$id_sucursal = $_GET['id'];



$query = "DELETE from sucursales where id_sucursal = '$id_sucursal'";
$res = $conexion->query($query);

if ($res)
    header("location:../sucursales.php");
