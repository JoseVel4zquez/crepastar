<?php
session_start();
include 'php/conexion.php';

$codigo = $_POST['codigo'];
$clave = $_POST['clave'];
$sucursalId = $_POST['sucursalId'];

$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE codigo ='$codigo'
    AND clave = '$clave' ");



if (mysqli_num_rows($validar_login) > 0) {
    $_SESSION['codigo'] = $codigo;
    $updateUser = "UPDATE usuarios set id_sucursal='$sucursalId' where codigo ='$codigo'";
    $updateUserResquest = $conexion->query($updateUser);
    $query = "SELECT id_sucursal from usuarios where codigo ='$codigo'";
    $res = current($conexion->query($query)->fetch_array());
    $_SESSION['sucursal'] = $res;
    date_default_timezone_set('America/Mexico_City');

    $hora = date('H:i:s');
    inicioTrabajo($codigo, $hora);
    header('location: index.php');
    exit;
} else {
    echo '
        <script>
            alert("El usuairo no existe")
            window.location="login.php"
        </script>';
    exit;
}

function inicioTrabajo($codigo, $hora)
{
    include 'php/conexion.php';
    $sql = "UPDATE usuarios set inicio_turno='$hora' where  codigo ='$codigo'";
    $res = $conexion->query($sql);
    date_default_timezone_set('America/Mexico_City');

    $fecha = date('d:m:y');

    $userId = "SELECT id_usuario from usuarios where codigo ='$codigo'";
    $res2 = current($conexion->query($userId)->fetch_array());
    //iniciamos el log
    $descripcion = "El usuario: " . $codigo . " inicio su turno a las " . $hora;
    $log = "INSERT INTO log_usuario (id_usuario,tiempo,descripcion)
     values('$res2','$hora','$descripcion') ";
    $response = $conexion->query($log);

    if (!$res) {
        echo "ocurrio un error";
        header("location:login.php");
    } else if (!$response) {
        echo "ocurrio un error";
        header("location:login.php");
    }


    // Log_usuarios($res2, $descripcion, $fecha, $hora);
}
