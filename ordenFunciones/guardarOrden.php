<?php
include '../php/conexion.php';
include "../assets/log.php";
session_start();
if (!isset($_SESSION['codigo'])) {
    echo '<script>alert("Inicia session")</script>';
    header("location:login.php");
    session_destroy();
    die();
}

$nombre = $_SESSION['codigo'];

$obtener_id_usuario = "SELECT id_usuario from usuarios where codigo ='$nombre'";
$user_id = current($conexion->query($obtener_id_usuario)->fetch_array());

date_default_timezone_set('America/Mexico_City');
$fecha = date('d-m-Y');
$hora = date('H:i:s');

if (
    empty($_POST['fecha']) ||
    empty($_POST['hora']) ||
    empty($_POST['comensales']) ||
    empty($_POST['mesa']) ||
    empty($_POST['mesero'])
) {
    header('location: ../orden.php');
}

date_default_timezone_set('America/Mexico_City');
$fecha = date('m-d-Y');
$hora = date('H:i:s');
$comensales = $_POST['comensales'];
$Id_mesa = $_POST['mesa'];
$id_usuario = $_POST['mesero'];
$id_sucursal = $_POST['sucursalID'];
$cliente_nombre = $_POST['cliente_nombre'];

// echo $fecha . " " . $hora . $comensales . $Id_mesa . " " . $id_usuario . " ";

$sql = "INSERT INTO servicios(fecha,hora,comensales,Id_mesa,id_usuario,id_sucursal,cliente_nombre)
    VALUES('$fecha','$hora','$comensales','$Id_mesa','$id_usuario','$id_sucursal','$cliente_nombre')";
$res = $conexion->query($sql);

if (!$res) {
    echo ' Error al registrar articulo ';
} else {
    Log_usuarios($user_id, "Creo una orden", $fecha, $hora);
    echo '<script>
        alert("El articulo fue registrado exitosamente");
        
        </script>';
    header("location:../orden.php");
}

mysqli_close($conexion);
