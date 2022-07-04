<?php
include "conexion.php";
$id = $_GET['id'];
$eliminar = "DELETE FROM mesas WHERE Id_Mesa = '$id'";
$resultadoEliminar = mysqli_query($conexion, $eliminar);
if (!$resultadoEliminar) {
    echo '<script>
	alert("Ocurrio un error al eliminar");
	window.history.go(-1);
	</script>';
}
echo '<script>
	alert("La mesa fue eliminada exitosamente");
	window.history.go(-1);
	</script>';
