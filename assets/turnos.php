<?php

$id_us = $_GET['id'];
$turno = $_GET['turno'];
date_default_timezone_set('America/Mexico_City');

$fecha = date('m-d-Y');
$hora = date('H:i:s');

if ($turno === "inicio") {
    iniciarTurno($id_us, $hora, $fecha);
} elseif ($turno === "fin") {
    FinalizarTurno($id_us, $hora, $fecha);
}



function iniciarTurno($id, $hora, $fecha)
{
    include '../php/conexion.php';
    include 'log.php';
    $query = "UPDATE usuarios SET inicio_turno='$hora' where id_usuario='$id'";
    $sql =  $conexion->query($query);
    if ($sql) {
        $descripcion = "El usuario: " . $id . " Inicio su turno a las: " . $hora . " con fecha: " . $fecha;
        Log_usuarios($id, $descripcion, $fecha, $hora);

        header("location:../index.php");
    } else {

        echo "ocurrio un error";
    }
}

function FinalizarTurno($id, $hora, $fecha)
{
    include '../php/conexion.php';
    include 'log.php';
    $query = "UPDATE usuarios SET fin_turno='$hora' where id_usuario='$id'";
    $sql =  $conexion->query($query);
    if ($sql) {
        $descripcion = "El usuario: " . $id . " Termino su turno a las: " . $hora . " con fecha: " . $fecha;
        Log_usuarios($id, $descripcion, $fecha, $hora);
        header("location:../index.php");
    } else {

        echo "ocurrio un error";
    }
}
