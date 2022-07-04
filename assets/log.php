<?php


function Log_usuarios($id_usuario, $descripcion, $fecha_log, $hora_log)
{
    include '../php/conexion.php';
    $query = "INSERT INTO log_usuario (id_usuario,tiempo,descripcion,fecha_log)
     values('$id_usuario','$hora_log','$descripcion',$fecha_log) ";
    $res = $conexion->query($query);
    if ($res) {
        // echo "log añadido";
    } else {
        echo "ocurrio un error en el log";
    }
}
