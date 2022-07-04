<?php
include '../php/conexion.php';
$queryQuery = "SELECT * FROM comentarios";
$comentario = $conexion->query($query);

?>


<body>
    <div class="row">

        <div class="col-lg-6 mb-4">
            <div class="row">

                <div class="col-lg-10 mb-4  col-md-6">
                    <h1>Comentarios</h1>
                    <?php while ($filas = mysqli_fetch_assoc($comentario)) { ?>
                        <div class="card bg-primary text-white shadow">
                            <div class="card-body">

                                <div class="text-white-50 small"><?php echo "Numero de comentario: " . $filas['id_comentario']; ?></div>
                                <div class="text-white-50 small"><?php echo "Comentario: " . $filas['descripcion']; ?></div>

                                <div class="text-white-50 small"><?php echo "Cantidad pedida: " . $filas['id_usuario']; ?></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>


            </div>
        </div>
</body>

</html>