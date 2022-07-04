<?php

include "componentes/header.php";
include "php/conexion.php";
//fecha
date_default_timezone_set('America/Mexico_City');
$fechaActual = date('Y-m-d');
//sacamos el total de vetas por usuario
$totales = "SELECT sum(VentaUsuario) from costos where  id_usuarios='$id_usuario' and created_at like '%$fechaActual%' ";
$totalR = current($conexion->query($totales)->fetch_array());


$nombres = "SELECT c.*,count(c.id_usuarios) as 'Ventas' from costos c left join usuarios u on c.id_usuarios = u.id_usuario group by u.usuarioNombre desc";
$response_nombres = $conexion->query($nombres);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["id_usuarios", "Ventas"],
                <?php

                while ($row = $response_nombres->fetch_assoc()) {
                    echo "['" . $row['id_usuarios'] . "', '" . $row['Ventas'] . "'],";
                }
                ?>
            ]);

            var options = {
                title: "Reporte de ventas",
                is3D: true,
            };

            var chart = new google.visualization.PieChart(
                document.getElementById("grafico")
            );

            chart.draw(data, options);
            document.getElementById("variable").value = chart.getImageURI();
        }
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Ventas</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row m-5 pb-3">
            <div class="col-md-6">
                <h1>Mis ventas de hoy</h1>
            </div>
            <div class="col-md-3 d-flex flex-row-reverse">
                <?php if ($totalR) { ?>
                    <h1>$<?php echo $totalR ?>MXN</h1>
                <?php } else { ?>
                    <h1>Aun no hay registro de ventas</h1>
                <?php } ?>
            </div>
            <?php if ($Rol_name === "Admin") { ?>
                <form action="./pdfs/inventarioPDF.php" method="POST">
                    <input type="hidden" name="variable" id="variable">
                    <div id="grafico" style="width: 500px; height: 500px;"></div>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 mx-5">
                        <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</button>
                    </div>
                </form>
            <?php } ?>
        </div>
        <div id="wrapper">

            <div id="content-wrapper" class="d-flex flex-column">

                <div id="content">
                    <a href="ventasAll.php" class="btn btn-light mx-3">Ver todas las ventas</a>

                    <div class="container-fluid" style="margin-top: 40px;">


                        <p class="mb-4" id="currentDate"></p>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Mi historial de Ventas</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Total de venta</th>
                                                <th scope="col">Fecha</th>
                                                <!-- <th scope="col"></th> -->

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Total de venta</th>
                                                <th scope="col">Fecha</th>
                                                <!-- <th scope="col"></th> -->

                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * from costos where id_usuarios = '$id_usuario'";
                                            $res = $conexion->query($sql);

                                            $i = 1;
                                            while ($filas = mysqli_fetch_assoc($res)) {

                                            ?>

                                                <tr>
                                                    <th scope="row"><?php echo $i++; ?></th>
                                                    <td>$<?php echo $filas['ventaUsuario']; ?></td>
                                                    <td><?php echo $filas['created_at']; ?></td>


                                                    <!-- <td><a class="btn btn-outline-warning" href="modificar.php?id=<?php echo $row['id_usuario']; ?>"><i class="fas fa-edit"></i></a></td> -->


                                                </tr>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- plugins -->
        <script src="./vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="./vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- scripts -->
        <script src="./js/demo/datatables-demo.js"></script>
    </div>
</body>

</html>
<?php

include "componentes/footer.php";
?>