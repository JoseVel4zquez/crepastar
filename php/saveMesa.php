<?php
include "conexion.php";
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
$id_usuario = current($conexion->query($obtener_id_usuario)->fetch_array());

date_default_timezone_set('America/Mexico_City');
$fecha = date('m-d-Y');
$hora = date('H:i:s');


if (empty($_POST['nombre'])) {
    header("location:../mesas.php");
    exit();
}

$nombre = $_POST['nombre'];
$insert = "INSERT INTO mesas (MesaNombre)VALUES('$nombre')";
$resultado = $conexion->query($insert);
if (!$resultado) {
    echo ' Error al registrar la mesa ';    
} else {
    Log_usuarios($id_usuario,  "El usuario creo una mesa", $fecha, $hora);
    echo '<script>
    alert("El usuario fue registrado exitosamente");

    </script>';
    header("location:../mesas.php");
}
mysqli_close($conexion);
