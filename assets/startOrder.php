<?php
include_once '../php/conexion.php';
$nombre_Cliente = $_POST['clienteNombre'];
$mesaID = $_POST['mesa_id'];
$mesero_id = $_POST['mesero_id'];
$numComensales = $_POST['numComensales'];
$sucu = $_POST['sucursal'];


//echo $nombre_Cliente . " " . $mesaID . " " . $mesero_id . "" . $numComensales;

$creacion = "INSERT INTO servicios(comensales,status_servicio,Id_Mesa,id_usuario,cliente_nombre,id_sucursal) values('$numComensales',0,'$mesaID','$mesero_id','$nombre_Cliente','$sucu')";
$queryC = $conexion->query($creacion);

if ($queryC) {
    $orderId = mysqli_insert_id($conexion);
    header("location:../index.php?orderId=$orderId");
}
