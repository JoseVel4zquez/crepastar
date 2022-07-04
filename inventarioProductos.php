<?php
    include "componentes/header.php";

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

</head>

<body>

    <div id="wrapper">

        <div class="container-fluid">

            <h1 class="h3 mb-2 text-gray-800">Productos</h1>
            <p class="mb-4">Comandas 2021</p>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Datos de producto</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th></th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Eliminar</th>
                                <th>Editar</th>
                                <th>Ver</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th></th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Eliminar</th>
                                <th>Editar</th>
                                <th>Ver</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                                include "php/conexion.php";
                                $i = 1;
                                // $qry = $conexion->query("SELECT * FROM orden o inner join inventario p on o.id_prodcuto = p.id_producto  where id_servicio =".$_GET['id']);
                                $qry = $conexion->query("SELECT * FROM inventario o inner join recetas p on o.id_producto = p.id_producto;");
                                while($row = $qry->fetch_assoc()){

                            ?>

                            <tr>
                                <td><?php echo $i++; ?><td>
                                <td><?php echo $row['nombre_receta']; ?></td>  
                                <td><?php echo $row['descripcion']; ?></td>
                                <td><a class="btn btn-outline-danger" href=""><i class="fas fa-trash-alt"></i></a></td>
                                <td><a class="btn btn-outline-warning" href=""><i class="fas fa-edit"></i></a></td>
                                <td><a class="btn btn-outline-primary" href="verProducto.php?id=<?php echo $row['id_receta'] ?>"><i class="fas fa-eye"></i></a></td>
                            </tr>

                            <?php
                                };
                            ?>
                        </tbody>
                    </table>
                    <?php
                        include 'componentes/footer.php';
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- plugins -->
    <script src="./vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="./vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- scripts -->
    <script src="./js/demo/datatables-demo.js"></script>
</body>

</html>


