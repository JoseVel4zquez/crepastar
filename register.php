<?php
include "php/conexion.php";


$sql = "SELECT * FROM roles";
$res = $conexion->query($sql);

$query = "SELECT * FROM sucursales ";
$resQuery = $conexion->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom styles for this template-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Registro</title>
</head>

<body>
    <form action="./php/proceso_guardar.php" method="POST">
        <div class="container">
            <div class="form">
                <div class="heading">
                    <img src="./img/logo2.png" class="logo">
                    <h1>Formulario de registro</h1>
                </div>
                <div class="wrap">
                    <div class="f1">
                        <label>Nombre</label>
                        <input type="text" name="usuarioNombre" required />
                        <span class="focus-input"></span>
                    </div>
                    <div class="f2">
                        <label>Codigo</label>
                        <input type="text" name="codigo" required />
                        <span class="focus-input"></span>
                    </div>
                </div>
                <div class="wrap2">
                    <label>Rol</label>
                    <select name="rol" class="form-select form-select-sm m-2 form-control">
                        <?php while ($row = $res->fetch_assoc()) { ?>
                            <option value="<?php echo $row['Id_Rol']; ?>"><?php echo $row['RolNombre']; ?></option>
                        <?php } ?>
                    </select>
                    <!-- <span class="focus-input2"> -->
                </div>
                <div class="wrap2">
                    <div class="input-group">
                        <input type="password" name="clave" class="form-control" id="showPass" placeholder="Clave">
                        <div class="input-group-append">
                            <a id="password" class="btn btn-primary" onclick="mostrarPassword()"><i class="icon fa-solid fa-eye"></i></a>
                        </div>
                    </div>
                </div>

                <div class="wrap2">
                    <label>Sucursal</label>
                    <select name="sucursal_id" id="sucursal_id" class="form-select form-select-sm m-2 form-control" placeholder="Ingredientes" required>
                        <?php while ($row = $resQuery->fetch_assoc()) { ?>
                            <option value="<?php echo $row['id_sucursal']; ?>"><?php echo $row['nombre_sucursal']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <button type="submit" name="create" class="btn btn-primary">Registrar</button>
            </div>
            <div class="image">
                <img src="./img/lecrepe.jpg" class="img" alt="lecrepe">
            </div>
        </div>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
    function mostrarPassword() {
        var cambio = document.getElementById("showPass");
        console.log(cambio);
        if (cambio.type == "password") {
            cambio.type = "text";
            $('.icon').removeClass('fa fa-regular').addClass('fa fa-eye-slash');
        } else {
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }
    }
</script>

</html>