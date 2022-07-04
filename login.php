<?php
include 'php/conexion.php';
session_start();
if (isset($_SESSION['codigo'])) {
    header("location:index.php");
}
$sucursales = "SELECT * FROM sucursales";
$sucurssalesRequest = $conexion->query($sucursales);

?>

<!-- aqui empieza el html para el login -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>

<body>
    <div class="container w-75 bg-white mt-5 rounded shadow">
        <!-- contenedor del login -->
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">
                <!-- esta classe contiene la imagen -->
            </div>
            <div class="col p-5 rounded-end">
                <div class="text-end">
                    <!-- logo de control access -->
                    <img src="img/controlaccesslogo.png" width="48" alt="control-access">
                </div>

                <h2 class="fw-bold text-center py-5">Comandas 2022</h2>

                <!-- creacion del formulario del login -->
                <form action="login_user.php" method="POST">
                    <div class="mb-4">
                        <label for="codigo" class="form-label">Codigo</label>
                        <input type="text" name="codigo" id="codigo" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="clave" class="form-label">Clave</label>
                        <div class="input-group">
                            <input type="password" name="clave" class="form-control" id="showPass" placeholder="Clave">
                            <div class="input-group-append">
                                <a id="password" class="btn btn-primary" onclick="mostrarPassword()"><i class="icon fa-solid fa-eye"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 form-check">
                        <label for="">Seleccione la sucursal a donde se va a acceder</label>
                        <select name="sucursalId" id="sucursalId" class="form-select   form-control" placeholder="Sucursales" required>
                            <?php while ($row = mysqli_fetch_assoc($sucurssalesRequest)) { ?>
                                <option value="<?php echo $row['id_sucursal']; ?>"><?php echo $row['nombre_sucursal']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="d-grid mb-5">
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                    <!-- opciones extra de inicio de sesion  -->
                    <!-- <div class="my-3">
                        <span>No tienes cuenta <a href="#">Registrate</a></span><br>
                        <span><a href="#">Recuperar clave</a></span>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    function mostrarPassword() {
        var cambio = document.getElementById("showPass");
        console.log(cambio);
        if (cambio.type == "password") {
            cambio.type = "text";
            $('.icon').removeClass('fa-solid fa-eye').addClass('fa-regular fa-eye-slash');
        } else {
            cambio.type = "password";
            $('.icon').removeClass('fa-regular fa-eye-slash').addClass('fa fa-eye');
        }
    }
</script>

</html>