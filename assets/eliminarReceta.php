<?php
include '../php/conexion.php';
$id_receta = $_GET['id'];

$eliminar = "DELETE FROM recetas WHERE id_receta = '$id_receta'";
$res = $conexion->query($eliminar);
if (!$res) {
    $error = "ocurrio un error";
    header("location:../recetasIndex.php?error=$error");
} else {
    $success = "Se elimino la receta correctamente";
    header("location:../recetasIndex.php?success=$success");
}
