<?php

include "../php/conexion.php";

$id = $_REQUEST['id'];

$nombre = $_POST['usuarioNombre'];
$tipo = "N/A";
$codigo = $_POST['codigo'];
$Id_rol = $_POST['rol'];
$clave = $_POST['clave'];
$sucursal_id = $_POST['sucursal_id'];

$query = "UPDATE usuarios SET usuarioNombre='$nombre', tipo='$tipo', codigo='$codigo', Id_rol='$Id_rol', clave='$clave', id_sucursal= '$sucursal_id' WHERE id_usuario = '$id' ";

$resultado = $conexion->query($query);

if ($resultado) {
    $success = "Se actualizo correctamente";
    header("Location: usuarios.php?success=$success");
} else {
    $error = "Ocurrio un error";
    header("Location: usuarios.php?success=$error");
}
