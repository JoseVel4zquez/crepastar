<?php
include '../php/conexion.php';
session_start();
$sucursal = $_SESSION['sucursal'];
$queryQuery = "SELECT * from servicios WHERE status_servicio = 0 AND id_sucursal = '$sucursal'";
$response = $conexion->query($queryQuery);

if (!$response) {
    die('Ocurrio un error');
}
$json = array();
while ($row = $response->fetch_array()) {

    $json[] = array(
        'created_at' => $row['created_at'],
        'comensales' => $row['comensales'],
        'Id_Mesa' => $row['Id_Mesa'],
        'id_usuario' => $row['id_usuario'],
        'id' => $row['id']
    );
}
$jsonString = json_encode($json);
echo $jsonString;
