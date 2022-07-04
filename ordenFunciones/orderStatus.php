<?php

    include "../php/conexion.php";

    $id = $_GET['id'];

    $query = mysqli_query($conexion, "SELECT status_servicio FROM servicios WHERE id = '$id'") or die(mysqli_error());
    $row = mysqli_fetch_array($query);

    if($row['status_servicio'] == 0){    
        mysqli_query($conexion, "UPDATE servicios SET status_servicio=1 WHERE id='$id'") or die(mysqli_error());
        header("Location: ../index.php");
    }
    else{
        mysqli_query($conexion, "UPDATE servicios SET status_servicio=0 WHERE id='$id'") or die(mysqli_error());
        // header("Location: ../orden.php");
        echo "<script>window.history.go(-1)</script>";

    }

?>