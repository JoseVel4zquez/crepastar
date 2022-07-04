<?php
include '../php/conexion.php';
$nombres = "SELECT * from inventario limit 7";
$response_nombres = $conexion->query($nombres);
$etiquetas  = array();
$datos  = array();
while ($row = $response_nombres->fetch_assoc()) {

    $etiquetas[] = array(
        $row['nombre']
    );
    $datos[] =
        $row['cantidad'];
}
$datosVentas = [5000, 1500, 8000, 5102];
$respuesta = [
    "etiquetas" => $etiquetas,
    "datos" => $datos,
];
echo json_encode($respuesta);
// $jsonString = json_encode($json);
// echo $jsonString;

// $etiquetas = ["Enero", "Febrero", "Marzo", "Abril"];
// $datosVentas = [5000, 1500, 8000, 5102];
// // Ahora las imprimimos como JSON para pasarlas a AJAX, pero las agrupamos
// $respuesta = [
//     "etiquetas" => $etiquetas,
//     "datos" => $datosVentas,
// ];
// echo json_encode($respuesta);
