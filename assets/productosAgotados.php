<?php
include '../php/conexion.php';
session_start();
$sucursal = $_SESSION['sucursal'];
$queryQuery = "SELECT *  from inventario where id_sucursal = '$sucursal'  ORDER BY  cantidad ASC LIMIT 3";
$response = $conexion->query($queryQuery);

if (!$response) {
    die('Ocurrio un error');
}
$json = array();
while ($row = $response->fetch_array()) {

    $json[] = array(
        'nombre' => $row['nombre'],
        'cantidad' => $row['cantidad'],
        'precio' => $row['precio'],
        'precioVenta' => $row['precio_venta'],
        'id_producto' => $row['id_producto']
    );
}
$jsonString = json_encode($json);
echo $jsonString;
