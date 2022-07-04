<?php
include '../php/conexion.php';
if (isset($_POST['guardar'])) {
    $nombre_user = $_POST['username'];
    $img_perfil = $_FILES['img_perfil']['name'];

    $clave = $_POST['userPwd'];
    $userId = $_POST['userId'];
    if (isset($img_perfil) && $img_perfil != "") {
        $temp = $_FILES['img_perfil']['tmp_name'];

        $tipo = $_FILES['img_perfil']['type'];

        if (!((strpos($tipo, 'gif') || strpos($tipo, 'jpeg') || strpos($tipo, 'webp') || strpos($tipo, 'mp4')))) {
            $error = "La extension de la imagen no es soportada solo soporta JPG";
            header("location:../userProfile.php?error=$error");
        } else {
            $query = "UPDATE usuarios SET usuarioNombre='$nombre_user', clave='$clave', img_profile='$img_perfil' where id_usuario ='$userId' ";
            $result = $conexion->query($query);
            if ($result) {
                $success = "Se actualizo correctamente";
                move_uploaded_file($temp, '../img/' . $img_perfil);
                header("location:../userProfile.php?success=$success");
            } else {
                $error = "Ocurrio un error al actualizar la informacion";
                header("location:../userProfile.php?error=$error");
            }
        }
    }
}
