<?php

    include "../php/conexion.php";

    $id = $_REQUEST['id'];

    $query = "DELETE FROM usuarios WHERE id_usuario = '$id'";

    $resultado = $conexion->query($query);

    if($resultado){
        header("Location: usuarios.php");    
    } else {
        echo "No jalo dice";
    }

?>