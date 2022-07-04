<?php

ob_start();
include '../php/conexion.php';
$sql = "SELECT * from inventario";
$res = $conexion->query($sql);
$totales = "SELECT sum(precio) from inventario  ";
$totalR = current($conexion->query($totales)->fetch_array());
$fechaActual = date('d-m-Y H:i:s');
$queryQuery = "SELECT *  from inventario   ORDER BY  cantidad ASC limit 3 ";
$response = $conexion->query($queryQuery);

$poductosMenosC = "SELECT sum(precio) from inventario  ORDER BY  cantidad ASC";
$totalRes = current($conexion->query($poductosMenosC)->fetch_array());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Reporte de ventas</title>
</head>

<body>

    <div class="container-lg">
        <h1 class="text-center" style="text-align: center;">Reporte de inventario</h1>
        <!-- <h2 class="text-center">Los resultado se muestran por identificador de usuario</h2> -->
        <h3 class="text-end my-3">Fecha y hora: <?php echo $fechaActual ?></h3>

    </div>
    <div class="row m-5 pb-3" style="display: flex; flex-direction: row-reverse;">
        <div class="col-md-6">
            <h1>Total de inversion en inventario:</h1>
        </div>
        <div class="col-md-3 d-flex flex-row-reverse" style="display: flex; flex-direction: row-reverse;">
            <?php if ($totalR) { ?>
                <h1>$<?php echo $totalR ?>MXN</h1>
            <?php } else { ?>
                <h1>Aun no hay registro de ventas</h1>
            <?php } ?>
        </div>

    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4 mx-5">
        <table class="table" style="width: 100%; border: black 1px solid;">
            <thead>
                <tr>
                    <th scope="col" style="border: black 1px solid;">#</th>
                    <th scope="col" style="border: black 1px solid;">Identificador de producto</th>
                    <th scope="col" style="border: black 1px solid;">Nombre del producto</th>
                    <th scope="col" style="border: black 1px solid;">Cantidad</th>
                    <th scope="col" style="border: black 1px solid;">Unidad</th>
                    <th scope="col" style="border: black 1px solid;">Costo total de compra</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                while ($filas = $res->fetch_assoc()) { ?>
                    <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td style="border: black 1px solid;"><?php echo $filas['id_producto'] ?></td>
                        <td style="border: black 1px solid;"><?php echo $filas['nombre'] ?></td>
                        <td style="border: black 1px solid;"><?php echo $filas['cantidad'] ?> </td>
                        <td style="border: black 1px solid;"><?php echo $filas['unidad'] ?> </td>
                        <td style="border: black 1px solid;">$<?php echo $filas['precio'] ?>Mxn </td>
                    </tr>
                <?php } ?>
                <tr>
                    <th colspan="5" class="text-right">TOTAL</th>
                    <th id="dinero"><?php if ($totalR) { ?>
                            <?php echo "$" . $totalR . "Mxn" ?>
                        <?php } else { ?>
                            Aun no hay registro de ventas
                        <?php }

                        ?>

                </tr>

            </tbody>
        </table>
        <h2>Productos con menor cantidad de existencia</h2>
        <table class="table" style="width: 100%; border: black 1px solid;">
            <thead>
                <tr>
                    <th scope="col" style="border: black 1px solid;">#</th>
                    <th scope="col" style="border: black 1px solid;">Identificador de producto</th>
                    <th scope="col" style="border: black 1px solid;">Nombre del producto</th>
                    <th scope="col" style="border: black 1px solid;">Cantidad</th>
                    <th scope="col" style="border: black 1px solid;">Unidad</th>
                    <th scope="col" style="border: black 1px solid;">Costo total de compra</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                while ($row = $response->fetch_assoc()) { ?>
                    <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td style="border: black 1px solid;"><?php echo $row['id_producto'] ?></td>
                        <td style="border: black 1px solid;"><?php echo $row['nombre'] ?></td>
                        <td style="border: black 1px solid;"><?php echo $row['cantidad'] ?> </td>
                        <td style="border: black 1px solid;"><?php echo $row['unidad'] ?> </td>
                        <td style="border: black 1px solid;">$<?php echo $row['precio'] ?>Mxn </td>
                    </tr>
                <?php } ?>


            </tbody>
        </table>
    </div>
</body>


</html>

<?php
include './componentes/footer.php';
$html = ob_get_clean();
//echo $html;
require_once '../librerias/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->load_html($html);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("reporteVentas" . $fechaActual . ".pdf", array("Attachment" => false));

?>