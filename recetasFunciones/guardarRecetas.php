<?php

include "../php/conexion.php";

$nombre = $_POST['nombre'];
$sucursal_id = $_POST['sucursal_id'];
$precio = $_POST['precio'];
$ingrediente = $_POST['ingrediente'];
$cantidad = $_POST['cantidad'];
$descripcionReceta = $_POST['descripcion'];
$recetaClase = $_POST['recetaClase'];
$precios = doubleval($precio);

foreach ($ingrediente as $ing) {
    $id_ingrediente = mysqli_escape_string($conexion, $ing);
    $consultaNombre = "SELECT nombre from inventario where  id_producto ='$ing'";
    $res[] = $conexion->query($consultaNombre)->fetch_row();
}

if ($res) {
    $lenght = count($res);
    $conteoCantidad = count($cantidad);

    for ($i = 0; $i < $lenght; $i++) {
        $descripcion[$i] = implode(" ", $res[$i]);
        for ($j = 0; $j < $conteoCantidad; $j++) {
            $qty[$j] =  $cantidad[$j];
        }
    }



    $recetaItem = implode(" , ",  $descripcion);
    $recetaQty = implode(" , ",  $qty);

    $creacion = "INSERT INTO recetas(nombre,precio,descripcion,ingredientes,cantidadIngredientes,RecetaTipo,id_sucursal) values('$nombre','$precios','$descripcionReceta','$recetaItem','$recetaQty','$recetaClase','$sucursal_id') ";
    $consulta = $conexion->query($creacion);
    if (!$consulta) {
        echo "ocurrio un error";
    } else {
        echo "<script>
        alert('Receta creada con exito');
        window.location='../recetas.php'
        </script>";
    }
}
