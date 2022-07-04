<?php
include '../php/conexion.php';
$nombres = "SELECT c.*,count(c.id_usuarios) as 'Ventas' from costos c left join usuarios u on c.id_usuarios = u.id_usuario group by u.usuarioNombre desc";
$response_nombres = $conexion->query($nombres);
$etiquetas  = array();
$datos  = array();
while ($row = $response_nombres->fetch_assoc()) {

    $etiquetas[] = array(
        $row['id_usuarios']
    );
    $datos[] =
        $row['Ventas'];
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
