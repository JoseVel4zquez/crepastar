<?php

include "php/conexion.php";
//order id
$id = $_GET['id'];
//total
$total_T = $_GET['dinero'];
//user id
$userId = $_GET['userId'];

//agregamos el venta por usuario
$misVentas = "INSERT into costos (ventaUsuario,id_usuarios) values ('$total_T','$userId')";
$conexion->query($misVentas);

require __DIR__ . '/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;



/*
Conectamos con la impresora
 */

/*
Aquí, en lugar de "POS58" (que es el nombre de mi impresora)
escribe el nombre de la tuya. Recuerda que debes compartirla
desde el panel de control
 */

$nombre_impresora = "POS58";
$nombre_impresora = "RP58";

$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->setJustification(Printer::JUSTIFY_CENTER);

// $logo = EscposImage::load("img/logo2.png", false);
// $printer->bitImage($logo);
$printer->text("********************************");
$printer->feed();
$printer->text(" Crepas & Brijes \n");
$printer->text("www.control-access.com/crepastar.brije.com.mx/login.php \n");
$printer->text("********************************");

$printer->setTextSize(1, 1);
$printer->feed();
$qrt = $conexion->query("SELECT * FROM servicios WHERE id = $id");
while ($row = $qrt->fetch_assoc()) {
    $printer->text("Nombre cliente: ");
    $printer->text($row['cliente_nombre']);
    $printer->text("\n");
}
/*
Imprimimos un mensaje. Podemos usar
el salto de línea o llamar muchas
veces a $printer->text()
 */
$printer->setTextSize(1, 1);
$printer->text("Ticket de venta \n");
$printer->text("-------------------------------- \n");

$printer->setTextSize(1, 1);
$printer->feed();
$total = 0;
$qry = $conexion->query("SELECT * FROM orden o inner join productos p on o.id_producto = p.id_producto  where id_servicio =" . $_GET['id']);
while ($row = $qry->fetch_assoc()) :
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $total += $row['qty'] * $row['precio'];
    $printer->text('Nombre:');
    $printer->text($row['codigo']);
    $printer->text("\n");
    $printer->text('Cantidad:');
    $printer->text($row['qty']);
    $printer->text("\n");
    $printer->text('Precio:$');
    $printer->text(number_format($row['qty'] * $row['precio'], 2));
    $printer->text("\n");
    $printer->text('Fecha:');
    $printer->text($row['Created_at']);
    $printer->text("\n");
    $printer->text('Total:$');
    $printer->text(number_format($total, 2));
    $printer->text("\n");
    $printer->text("-------------------------------- \n");

endwhile;

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("Gracias por su compra!");

header("location: index.php");

/*
Hacemos que el papel salga. Es como
dejar muchos saltos de línea sin escribir nada
 */
$printer->feed(15);

/*
Cortamos el papel. Si nuestra impresora
no tiene soporte para ello, no generará
ningún error
 */
$printer->cut();

/*
Por medio de la impresora mandamos un pulso.
Esto es útil cuando la tenemos conectada
por ejemplo a un cajón
 */
$printer->pulse();

/*
Para imprimir realmente, tenemos que "cerrar"
la conexión con la impresora.
 */
$printer->close();
