<?php
include '../php/conexion.php';
$comentario = $_POST['comentario'];
$id_usuario = $_POST['id_usuario'];

$query = "INSERT INTO comentarios (descripcion,id_usuario) VALUES('$comentario','$id_usuario')";
$sql = $conexion->query($query);
if (!$sql) {
    echo "algo salio mal";
}
header("location:../index.php");
