<?php
include '../php/conexion.php';
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
$id_usuario = current($conexion->query($obtener_id_usuario)->fetch_array());

date_default_timezone_set('America/Mexico_City');
$fechaHoy = date('d-m-Y');
$hora = date('H:i:s');

if (
    empty($_POST['nombre']) ||
    empty($_POST['cantidad']) ||
    empty($_POST['unidad']) ||
    empty($_POST['clase']) ||
    empty($_POST['precio']) ||
    empty($_POST['venta']) ||
    empty($_POST['tipo'])
) {
    header('location:../inventarios.php');
}

$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$unidad = $_POST['unidad'];
$clase = $_POST['clase'];
$precio = $_POST['precio'];
// $fechaSalida = $_POST['fechaSalida'];
$venta = $_POST['venta'];
$tipo = $_POST['tipo'];
$impuesto = $_POST['impuesto'];
$id_sucursal = $_POST['sucursalID'];

$impu = doubleval($impuesto / 100);
$ventas = doubleval($venta);

$tot = (intval($cantidad) * doubleval($precio));

$totel = (doubleval($venta) * doubleval($impu));

$total_venta = doubleval($venta) + doubleval($totel);


// echo $nombre . " " . $cantidad . $unidad . $clase . $precio . $venta . $tipo;

// $sql = "INSERT INTO inventario(nombre,cantidad,unidad,ingreso,salida,clase,precio,id_sucursal)
//     VALUES('$nombre','$cantidad','$unidad','$fechaHoy','$fechaSalida','$clase','$tot','$id_sucursal')";
// $res = $conexion->query($sql);

// if (!$res) {
//     echo ' Error al registrar articulo ';
// } else {
//     Log_usuarios($id_usuario,  "El usuario creo un articulo", $fechaHoy, $hora);
//     echo '<script>
//         alert("El articulo fue registrado exitosamente");

//         </script>';
//     header("location:../inventarios.php");
// }

if ($clase == 1 || $clase == 2) {
    $ssql = "INSERT INTO productos(codigo,precio,clase,cantidad_stock,id_sucursal)
    VALUES('$nombre','$total_venta','$clase','$cantidad','$id_sucursal')";
    $resul = $conexion->query($ssql);

    $saql = "INSERT INTO inventario(nombre,cantidad,unidad,ingreso,salida,precio,id_sucursal,id_cat,precio_venta)
    VALUES('$nombre','$cantidad','$unidad','$fechaHoy','$fechaSalida','$tot','$id_sucursal','$clase','$ventas')";
    $resul = $conexion->query($saql);

    if (!$resul && !$res) {
        echo 'ocurrio un error';
    } else {
        Log_usuarios($id_usuario,  "El usuario creo un articulo", $fechaHoy, $hora);
        echo '<script>
            alert("El articulo fue registrado exitosamente");
            window.history.go(-1);
            </script>';
    }
} else {
    $saql = "INSERT INTO inventario(nombre,cantidad,unidad,ingreso,precio,id_sucursal,id_cat,precio_venta)
    VALUES('$nombre','$cantidad','$unidad','$fechaHoy','$tot','$id_sucursal','$clase','$ventas')";
    $resul = $conexion->query($saql);

    if ($resul) {
        Log_usuarios($id_usuario,  "El usuario creo un articulo", $fechaHoy, $hora);
        echo '<script>
            alert("El articulo fue registrado exitosamente");
            window.history.go(-1);
            </script>';
    } else {
        echo "ocurrio un error";
    }
}

mysqli_close($conexion);
