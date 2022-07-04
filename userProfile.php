<?php
include 'componentes/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>Mi perfil</title>
</head>

<body>
    <div class="container-fluid">
        <h1 class="text-center mt-5">Actualizar informacion</h1>
        <!-- imagen de perfil -->
        <div class="row mt-5 p-5">
            <?php while ($row = $responseUser->fetch_assoc()) { ?>
                <div class="col-lg-6">
                    <?php if ($row['img_profile'] != null) { ?>
                        <img class="img-fluid rounded shadow-lg" src=" <?php echo 'img/' . $imgRequest ?>">
                    <?php } else { ?>

                        <img class="img-fluid rounded shadow-lg" src=" img/profile.png">
                    <?php } ?>
                </div>
                <div class="col-lg-6">
                    <form action="assets/actualizarUsuario.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="formFileSm" class="form-label">Foto de perfil</label>
                            <?php if (isset($_GET['success'])) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $_GET['success']; ?>
                                </div>
                            <?php } ?>
                            <?php if (isset($_GET['error'])) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $_GET['error']; ?>
                                </div>
                            <?php } ?>
                            <input class="form-control form-control-lg" id="formFileSm" value="<?php echo $row['img_profile']; ?>" name="img_perfil" type="file" </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Nombre</label>
                                <input class="form-control" type="text" value="<?php echo $row['usuarioNombre']; ?>" name="username" id="formFile">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Contraseña</label>
                                <input class="form-control" name="userPwd" value="<?php echo $row['clave']; ?>" type="password" id="showPass" id="formFile">
                                <div class="input-group-append">
                                    <a id="password" class="btn btn-primary" onclick="mostrarPassword()"><i class="icon fa-solid fa-eye"></i></a>
                                </div>
                                <input class="form-control" name="userId" value="<?php echo $row['id_usuario']; ?>" type="hidden" id="formFile">
                            </div>

                            <div class="mb-3">
                                <button name="guardar" class="btn btn-info">Actualizar</button>
                            </div>
                    </form>
                </div>
        </div>
    </div>
<?php } ?>

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
<?php
include "componentes/footer.php"
?>