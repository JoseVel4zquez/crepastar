<?php
include '../php/conexion.php';
$id_sucursal = $_POST['sucursalId'];
$sucursalActual = $_POST["sucursalActual"];
$user_id = $_POST["id_user"];

if ($id_sucursal == $sucursalActual) {
    echo "<script>
     alert('usted ya se encuentra en esa sucursal')
     window.history.go(-1)
    </script>";
} else {
    $updateUser = "UPDATE usuarios set id_sucursal = '$id_sucursal' where id_usuario = '$user_id'";
    $request = $conexion->query($updateUser);

    if ($request) {
        echo "<script>
     alert('Se actualizo la sucursal correctamente')
     window.history.go(-1)
    </script>";
        header("location:../index.php");
    } else {
        echo "<script>
     alert('Ocurrio un error ')
     window.history.go(-1)
    </script>";
    }
}
