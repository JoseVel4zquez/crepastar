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

$name = $_SESSION['codigo'];

$obtener_id_usuario = "SELECT id_usuario from usuarios where codigo ='$name'";
$id_usuario = current($conexion->query($obtener_id_usuario)->fetch_array());

date_default_timezone_set('America/Mexico_City');
$fecha = date('d-m-Y');
$hora = date('H:i:s');

$nombre = $_POST['usuarioNombre'];
$tipo = "N/A";
$codigo = $_POST['codigo'];
$Id_rol = $_POST['rol'];
$clave = $_POST['clave'];
$sucursal_id = $_POST['sucursal_id'];

$query = "INSERT INTO usuarios(usuarioNombre, codigo, Id_rol, clave, tipo,id_sucursal) VALUES('$nombre', '$codigo', '$Id_rol', '$clave', '$tipo',$sucursal_id)";

$resultado = $conexion->query($query);

if ($resultado) {
    Log_usuarios($id_usuario,  "Registro usuario", $fecha, $hora);
    echo '
        <script>
            alert("El usuairo se registro correctamente")
            window.location="../index.php"
        </script>';
} else {
    echo "No jalo dice";
}
