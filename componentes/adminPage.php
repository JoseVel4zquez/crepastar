<div class="container-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <?php if ($Rol_name == 'Mesero' || $Rol_name == 'Servicio') { ?>
            <h1 class="h3 mb-0 text-gray-800">Comentarios</h1>
            <a href="comentarios.php" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-pen-alt fa-sm text-white-50"></i></i> Crear comentario</a>
            <h1 class="h3 mb-0 text-gray-800">Iniciar turno</h1>
            <a href="assets/turnos.php?id=<?php echo $id_usuario; ?>&turno=<?php echo "inicio" ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-clock fa-sm text-white-50"></i> Empezar turno </a>
            <h1 class="h3 mb-0 text-gray-800">Finalizar turno</h1>
            <a href="assets/turnos.php?id=<?php echo $id_usuario; ?>&turno=<?php echo "fin" ?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-clock fa-sm text-white-50"></i> Finalizar turno </a>
        <?php } ?>
    </div>

</div>



<div class="row">

    <div class="col-lg-6 mb-4">
        <div class="col-lg-10 mb-4">
            <h1>Ordenes</h1>
            <?php while ($filas = mysqli_fetch_assoc($exe)) { ?>
                <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                        <?php echo "Numero de orden: " . $filas['id']; ?>
                        <div class="text-white-50 small">
                            <?php echo "Numero de servicio: " . $filas['id_servicio']; ?></div>
                        <div class="text-white-50 small"><?php echo "Numero de producto: " . $filas['id_producto']; ?>
                        </div>
                        <div class="text-white-50 small"><?php echo "Cantidad pedida: " . $filas['qty']; ?></div>
                        <div class="text-white-50 small"><?php echo "Fecha creada: " . $filas['Created_at']; ?></div>
                    </div>
                    <a href="ver_masIndex.php?fechaActual = <?php echo $fechaActual ?>" class="btn btn-secondary mt-2">Ver todo hoy  <i class="far fa-eye"></i></a>
                </div>
            <?php } ?>
        </div>
    </div>



    <div class="col-lg-6 mb-4">

        <!-- Servicios -->
        <div class="row">
            <div class="col-lg-10 mb-4">
                <h1>Servicios</h1>
                <?php while ($filas = mysqli_fetch_assoc($consulta)) { ?>
                    <div class="card bg-dark text-white shadow">
                        <div class="card-body">
                            <?php echo "Numero de servicio: " . $filas['id']; ?>
                            <div class="text-white-50 small">
                                <?php echo "Numero de comensales: " . $filas['comensales']; ?></div>
                            <div class="text-white-50 small"><?php echo "Fecha: " . $filas['fecha']; ?></div>
                            <div class="text-white-50 small"><?php echo "hora: " . $filas['hora']; ?></div>
                            <div class="text-white-50 small"><?php echo "numero de mesa: " . $filas['Id_Mesa']; ?></div>
                            <div class="text-white-50 small">
                                <?php echo "identificador de mesero: " . $filas['id_usuario']; ?>
                            </div>
                            <a class="btn btn-outline-success mt-2" href="ordenFunciones/orderStatus.php?id=<?php echo $filas['id']; ?>"> Marcar como
                                completado <i class="far fa-check-circle"></i></a>
                            <a href="vermas_services.php" class="btn btn-primary mt-2">Ver mas <i class="far fa-eye"></i></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php if ($Rol_name === "Admin" || $Rol_name === "Supervisor") { ?>
            <div class="row">

                <div class="col-lg-6 mb-4">
                    <div class="row">

                        <div class="col-lg-10 mb-4  col-md-6">
                            <h1>Comentarios</h1>
                            <?php while ($filas = mysqli_fetch_assoc($comentario)) { ?>
                                <div class="card bg-primary text-white shadow">
                                    <div class="card-body">

                                        <div class="text-white-50 small">
                                            <?php echo "Numero de comentario: " . $filas['id_comentario']; ?></div>
                                        <div class="text-white-50 small">
                                            <?php echo "Comentario: " . $filas['descripcion']; ?></div>

                                        <div class="text-white-50 small">
                                            <?php
                                            $persoan = "SELECT usuarioNombre FROM usuarios where id_usuario='$filas[id_usuario]'";
                                            $consulta = current($conexion->query($persoan)->fetch_array());
                                            echo "Persona que comento: " . $consulta; ?>
                                        </div>
                                    </div>
                                    <a href="vermas_comentarios.php" class="btn btn-secondary mt-2">Ver todo <i class="far fa-eye"></i></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
    </div>

</div>