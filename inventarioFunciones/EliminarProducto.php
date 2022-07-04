<?php
include "../php/conexion.php";

$id = $_GET['id'];
echo $id;
$eliminar = "DELETE FROM inventario WHERE id_producto = '$id'";
$resultadoEliminar = mysqli_query($conexion, $eliminar);
if (!$resultadoEliminar) {
    echo '<script>
	alert("Ocurrio un error al eliminar");
	window.history.go(-1);
	</script>';
}

header("location:../inventarios.php");
