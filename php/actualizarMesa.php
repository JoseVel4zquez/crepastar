<?php
include "conexion.php";
$id = $_POST['id'];
$nombre = $_POST['nombre'];

$sql = "UPDATE   mesas SET MesaNombre='$nombre' WHERE Id_Mesa='$id'";
$res = mysqli_query($conexion, $sql);
if ($res) {
    echo "<script>alert('Mesa Actualizada')</script>";
    header("location:../mesas.php");
} else {
    echo "error";
}
