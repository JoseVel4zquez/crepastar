<?php
function obtner_rol($nombre)
{
    include 'php/conexion.php';
    //obtenemos el id rol del usuairio
    $rol = "SELECT id_rol FROM usuarios WHERE codigo='$nombre'";
    $query = current($conexion->query($rol)->fetch_array());
    //echo $query;
    //obtenemos el nombre del rol del usuario

    $rol_name = "SELECT RolNombre FROM roles where Id_Rol='$query'";
    $sql_rol_name = current($conexion->query($rol_name)->fetch_array());
    return $sql_rol_name;
}
