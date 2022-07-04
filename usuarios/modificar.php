<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Soporte Micro Ecológico - Login</title>
    <link rel="apple-touch-icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Logotipo_de_la_CONACYT.png/1200px-Logotipo_de_la_CONACYT.png">
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Logotipo_de_la_CONACYT.png/1200px-Logotipo_de_la_CONACYT.png">


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-primary">


    <?php
    include "../php/conexion.php";

    $id = $_REQUEST['id'];

    $query = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
    $resultado = $conexion->query($query);
    $sql = "SELECT * FROM roles";
    $res = $conexion->query($sql);

    $query2 = "SELECT * FROM sucursales ";
    $resQuery = $conexion->query($query2);

    ?>

    <div class="container">

        <div class="card o-hidden border-0 bg-gray-900 my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-white mb-4">Modificar Usuarios!</h1>

                            </div>
                            <?php while ($rows = $resultado->fetch_assoc()) { ?>
                                <form action="proceso_modificar.php?id=<?php echo $rows['id_usuario']; ?>" method="POST" enctype="multipart/form-data" class="user">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" name="usuarioNombre" class="form-control form-control-user" id="exampleFirstName" placeholder="Nombre" value="<?php echo $rows['usuarioNombre']; ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <select name="rol" class="form-select form-select-sm m-2 form-control">
                                                <?php while ($row = $res->fetch_assoc()) { ?>

                                                    <option value="<?php echo $row['Id_Rol']; ?>"><?php echo $row['RolNombre']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" name="codigo" class="form-control form-control-user" id="exampleInputPassword" placeholder="Codigo" value="<?php echo $rows['codigo']; ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <input type="password" name="clave" class="form-control" id="showPass" placeholder="Clave" value="<?php echo $rows['clave']; ?>">
                                                <div class="input-group-append">
                                                    <a id="password" class="btn btn-primary" onclick="mostrarPassword()"><i class="icon fa-solid fa-eye"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <select name="sucursal_id" id="sucursal_id" class="form-select form-select-sm m-2 form-control" required>
                                            <?php while ($row = $resQuery->fetch_assoc()) { ?>

                                                <option value="<?php echo $row['id_sucursal']; ?>"><?php echo $row['nombre_sucursal']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                        </div>
                        <button type="submit" class="btn btn-dark btn-user btn-block my-3 mx-3">
                            Modificar
                        </button>
                        </form>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>
<script>
    function mostrarPassword() {
        var cambio = document.getElementById("showPass");
        console.log(cambio);
        if (cambio.type == "password") {
            cambio.type = "text";
            $('.icon').removeClass('fa fa-regular ').addClass('fa fa-eye-slash');
        } else {
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye-slash ').addClass('fa fa-eye');
        }
    }
</script>

</html>