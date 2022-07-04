<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventarios</title>
</head>

<body>

    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-10 m-5">
                    <h1>Comanda en proceso</h1>
                    <table class="table table-striped mt-5">
                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha y Hora</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Mesa</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Status</th>
                                <?php if ($Rol_name == 'Admin' || $Rol_name == 'Supervisor' || $Rol_name == 'Mesero') { ?>
                                    <th scope="col">Delete</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Crear</th>
                                <?php } ?>
                                <th scope="col">Ver</th>

                            </tr>
                        </thead>
                        <tbody id="result">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="js/confirmacion.js"></script>

</html>