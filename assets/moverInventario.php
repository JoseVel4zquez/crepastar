<?php
include '../php/conexion.php';
$origen = $_POST['origen'];
$destino = $_POST['sucursal_id'];

if ($origen === $destino) {
    echo '<script> 
    alert("No se puede transladar el inventario a la misma ubicacion");
    window.history.go(-1);
    </script>';
} else {
    $sql = "UPDATE inventario set id_sucursal = '$destino',salida= current_timestamp where id_sucursal ='$origen'";
    $response = $conexion->query($sql);
    if (!$response) {
        echo "ocurrio un error";
    } else {
        echo '<script> 
    alert("Se movio correctamente el inventario");
    window.history.go(-1);
    </script>';
    }
}
