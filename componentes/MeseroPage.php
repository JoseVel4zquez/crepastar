<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

    <div class="col md-9 lg-9">
        <h1 class="text-center">Comandas Activas</h1>
        <table class="table table-striped mt-5">
            <thead>

                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha y hora</th>
                    <!-- <th scope="col">Hora</th> -->
                    <th scope="col">Comensales</th>
                    <th scope="col">Mesa</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Status</th>
                    <?php if ($Rol_name == 'Admin' || $Rol_name == 'Supervisor' || $Rol_name == 'Mesero') { ?>
                        <th scope="col">Eliminar</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Crear</th>
                    <?php } ?>
                    <th scope="col">Ver</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($filas = mysqli_fetch_assoc($OrdenesPendientesRequest)) { ?>
                    <tr>
                        <th scope="row"><?php echo $i++; ?></th>
                        <td><?php echo $filas['created_at']; ?></td>
                        <td><?php echo $filas['comensales']; ?></td>
                        <td><?php echo $filas['Id_Mesa']; ?></td>
                        <td><?php echo $filas['id_usuario']; ?></td>
                        <?php if ($filas['status_servicio'] == 1) : ?>
                            <td class="text-center"><span class="badge badge-success">Complet</span></td>
                        <?php else : ?>
                            <td class="text-center"><span class="badge badge-secondary">Pend</span></td>
                        <?php endif ?>
                        <?php if ($Rol_name == 'Admin' || $Rol_name == 'Supervisor' || $Rol_name == 'Mesero') { ?>
                            <td><a class="btn btn-outline-danger" href="ordenFunciones/eliminar.php?id=<?php echo $filas['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                            <td><a class="btn btn-outline-warning" href="editarServicio.php?id=<?php echo $filas['id']; ?>"><i class="fas fa-edit"></i></a></td>
                            <td><a class="btn btn-outline-primary" href="crearOrden.php?id=<?php echo $filas['id']; ?>"><i class="fas fa-utensils"></i></a></td>
                        <?php } ?>
                        <td><a class="btn btn-outline-primary" href="view_order.php?id=<?php echo $filas['id'] ?>"><i class="fas fa-eye"></i></a></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

</body>

</html>