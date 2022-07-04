<?php

    include "../php/conexion.php";

    // $id = $_POST['id'];

    // $fecha = $_POST['fecha'];
    // $hora = $_POST['hora'];
    // $comensales = $_POST['comensales'];
    // $Id_mesa = $_POST['mesa'];
    // $id_usuario = $_POST['mesero'];

    // $query = "UPDATE servicios SET fecha='$fecha', hora='$hora', comensales='$comensales', Id_mesa='$Id_mesa', id_usuario='$id_usuario' WHERE id = '$id' ";

    // $resultado = $conexion->query($query);

    // if($resultado){
    //     header("Location: ../orden.php");    
    // } else {
    //     echo "No jalo dice";
    // }

    $id = $_POST['id'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $comensales = $_POST['comensales'];
    $Id_mesa = $_POST['mesa'];
    $id_usuario = $_POST['mesero'];
    
    $sql = "UPDATE servicios SET fecha='$fecha', hora ='$hora',comensales='$comensales',Id_mesa='$Id_mesa',id_usuario='$id_usuario' WHERE id='$id'";
    $res = mysqli_query($conexion, $sql);
    if ($res) {
        echo "<script>alert('producto Actualizado')</script>";
        header("location:../orden.php");
    } else {
        echo "error";
    }



?>