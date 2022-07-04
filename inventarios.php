<?php
include 'php/conexion.php';

include "componentes/header.php";

$qry = "SELECT * FROM categoria_inventario";
$resul = $conexion->query($qry);

$query = "SELECT * FROM sucursales ";
$resQuery = $conexion->query($query);
$nombres = "SELECT * from inventario p inner join categoria_inventario o on p.id_cat = o.id_cat where id_sucursal='$sucursal' limit 6";
$response_nombres = $conexion->query($nombres);


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Comandas 2021</title>
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">

    <link href="./vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Nombre", "Cantidad", {
                    role: "style"
                }],
                <?php
                while ($graficas = $response_nombres->fetch_assoc()) {

                    echo "['" . $graficas['nombre'] . "'," . $graficas['cantidad'] . ",'#F07A04'],";
                }
                ?>
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                title: "Cantidad de productos en inventario",
                width: 600,
                height: 400,
                bar: {
                    groupWidth: "95%"
                },
                legend: {
                    position: "none"
                },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("grafico"));
            chart.draw(view, options);
            document.getElementById("variable").value = chart.getImageURI();
        }
    </script>

</head>

<body id="page-top">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Registrar Productos</h1>

                <form action="inventarioFunciones/guardarArticulos.php" method="POST">
                    <div class="mb-4">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="codigo" class="form-control" style="width: 60%;" placeholder="Nombre del articulo">
                    </div>
                    <div class="row">

                        <div class="mb-4">
                            <label for="cantidad" class="form-label">Cantidad de productos</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" value="1">
                        </div>
                        <div class="mb-4">
                            <label for="unidad" class="form-label">Unidades</label>
                            <select name="unidad" id="unidad" class="form-select form-select-sm  mx-2 form-control">
                                <option value="Kg">Kilogramos</option>
                                <option value="L">Litros</option>
                                <option value="Ml">Mililitros</option>
                                <option value="Pza">Pieza</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-4">
                            <label for="clase" class="form-label">Clase</label>
                            <select name="clase" id="id_categoria" onchange="carg(this);" class="form-select form-select-sm  form-control">
                                <?php while ($fili = mysqli_fetch_assoc($resul)) { ?>
                                    <option value="<?php echo $fili['id_cat']; ?>"><?php echo $fili['producto'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="precio" class="form-label">Costo total de la compra por producto</label>
                            <input type="text" name="precio" id="precio" class="form-control w-50 mx-2" placeholder="$0">
                        </div>
                    </div>


                    <div class="row">
                        <div class="mb-4">
                            <label for="venta" class="form-label mx-2">Costo de venta al publico</label>
                            <input type="number" name="venta" id="id_input" class="form-control w-50" placeholder="$0">
                        </div>

                        <div class="mb-4">
                            <label for="venta" class="form-label">Impuesto aplicado</label>
                            <input type="number" name="impuesto" id="impuesto" class="form-control mx-2 w-50" placeholder="0%">
                        </div>
                    </div>
                    <div class="mb-4">
                        <input type="hidden" name="sucursalID" id="sucursalID" value="<?php echo $sucursal ?>">
                    </div>

                    <div class="d-grid col">
                        <button type="submit" class="btn btn-primary">Crear nuevo articulo</button>
                    </div>

                </form>
            </div>
            <div class="col-md-6">
                <h2>Productos en existencia</h2>
                <div id="grafico" class="my-5">
                </div>
                <?php if ($Rol_name === "Admin") { ?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 mx-5">
                        <form action="./pdfs/grafo.php" method="POST">
                            <input type="hidden" name="variable" id="variable">
                            <!-- <div id="grafico" style="width: 500px; height: 500px;"></div> -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4 mx-5">
                                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div id="wrapper">

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <div class="container-fluid" style="margin-top: 40px;">

                    <h1 class="h3 mb-2 text-gray-800">Inventario</h1>
                    <p class="mb-4" id="currentDate"></p>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Inventario</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Cantidad en Stock</th>
                                            <th>Unidad</th>
                                            <th>Fecha de Ingreso</th>
                                            <th>Clase</th>
                                            <th>Costo total de compra</th>
                                            <th>Sucursal</th>
                                            <th>Fecha salida</th>
                                            <th>Modificar</th>
                                            <th>Eliminar</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Cantidad en Stock</th>
                                            <th scope="col">Unidad</th>
                                            <th scope="col">Fecha de Ingreso</th>
                                            <th scope="col">Clase</th>
                                            <th scope="col">Costo total</th>
                                            <th scope="col">Sucursal</th>
                                            <th scope="col">Fecha salida</th>
                                            <th scope="col">Modificar</th>
                                            <th scope="col">Eliminar</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * from inventario p inner join categoria_inventario o on p.id_cat = o.id_cat where id_sucursal='$sucursal'";
                                        $res = $conexion->query($sql);

                                        $i = 1;
                                        while ($filas = mysqli_fetch_assoc($res)) {

                                        ?>

                                            <tr>
                                                <th scope="row"><?php echo $i++; ?></th>
                                                <td><?php echo $filas['nombre']; ?></td>
                                                <td><?php echo $filas['cantidad']; ?></td>
                                                <td><?php echo $filas['unidad']; ?></td>
                                                <td><?php echo $filas['ingreso']; ?></td>
                                                <td><?php echo $filas['producto']; ?></td>
                                                <td><?php echo "$" . $filas['precio']; ?></td>
                                                <td><?php echo $sucursalNombre ?></td>
                                                <td><?php echo $filas['salida']; ?></td>
                                                <!-- <td><img class="img-fluid img-thumbnail" style="height: 50px;" src="data:image/jpg;base64, <?php echo base64_encode($row['imagen']); ?>"></td> -->
                                                <!-- <th><a href="modificar.php?id=<?php echo $row['id_usuario']; ?>">Modificar</a</th> -->
                                                <td><a class="btn btn-outline-warning" href="modificar.php?id=<?php echo $row['id_usuario']; ?>"><i class="fas fa-edit"></i></a></td>
                                                <td><a class="btn btn-outline-danger" href="eliminar.php?id=<?php echo $row['id_usuario']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                                                <!-- <th><a href="eliminar.php?id=<?php echo $row['id_usuario']; ?>">Eliminar</a</th> -->
                                            </tr>

                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="mb-4 ">
                                    <div class="row ">
                                        <form action="assets/moverInventario.php" method="POST" class="d-flex flex-row w-100">
                                            <label for="Sucursal" class="form-label m-2">Cambiar a sucursal</label>
                                            <input type="hidden" name="origen" value="<?php echo $sucursal ?>">

                                            <select name="sucursal_id" id="sucursal_id" class="form-select form-select-sm m-2 form-control" placeholder="Ingredientes" required>
                                                <?php while ($row = $resQuery->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['id_sucursal']; ?>"><?php echo $row['nombre_sucursal']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <button type="submit" class="d-inline btn btn-outline-success mover">Mover</button>
                                        </form>
                                    </div>
                                </div>
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

    <script src="js/confirmacion.js"></script>
    <script src="js/moverInventario.js"></script>
    <script src="js/graficaInventario.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

    <script>
        $(function() {
            $("#id_categoria").change(function() {
                if ($(this).val() === "3") {
                    $("#id_input").prop("disabled", true);
                }
                // else if ($(this).val() === "3") {
                //     $("#id_input").prop("disabled", true);
                // } 
                else {
                    $("#id_input").prop("disabled", false);
                }
            });
        });
    </script>

</body>

</html>
<?php
//include "./componentes/footer.php";
?>