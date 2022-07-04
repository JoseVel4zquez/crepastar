<?php
include 'conexion.php';
session_start();
$nombre = $_SESSION['codigo'];
date_default_timezone_set('America/Mexico_City');

$hora = date('H:i:s');
$request = "UPDATE usuarios set fin_turno='$hora' where codigo ='$nombre'";
$res = $conexion->query($request);
//id de usuairo

$userId = "SELECT id_usuario from usuarios where codigo ='$nombre'";
$res2 = current($conexion->query($userId)->fetch_array());
//iniciamos el log
$descripcion = "El usuario: " . $nombre . " Termino su turno a las " . $hora;
$log = "INSERT INTO log_usuario (id_usuario,tiempo,descripcion)
     values('$res2','$hora','$descripcion') ";
$response = $conexion->query($log);


if (!$res) {
    echo "ocurrio un error";
} else if (!$response) {
    echo "ocurrio un error";
}
session_destroy();

header("location: ../login.php");
