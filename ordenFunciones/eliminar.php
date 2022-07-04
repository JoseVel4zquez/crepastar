<?php

    include "../php/conexion.php";
    include "../assets/log.php";
    session_start();
    if (!isset($_SESSION['codigo'])) {
        echo '<script>alert("Inicia session")</script>';
        header("location:login.php");
        session_destroy();
        die();
    }

    $nombre = $_SESSION['codigo'];

    $obtener_id_usuario = "SELECT id_usuario from usuarios where codigo ='$nombre'";
    $user_id = current($conexion->query($obtener_id_usuario)->fetch_array());

    date_default_timezone_set('America/Mexico_City');
    $fecha = date('d-m-Y');
    $hora = date('H:i:s');

    $id = $_GET['id'];

    $query = "DELETE FROM servicios WHERE id = '$id'";

    $resultado = $conexion->query($query);

    // echo $id;

    if($resultado){
        Log_usuarios($user_id, "Elimino una orden", $fecha, $hora);
        header("Location: ../orden.php");    
    } else {
        echo '<script>
	        alert("Ocurrio un error al eliminar");
	        window.history.go(-1);
	    </script>';
    }

?>