<?php

require('../librerias/fpdf/fpdf.php');
include '../php/conexion.php';
$sql = "SELECT * from inventario";
$res = $conexion->query($sql);



class PDF extends FPDF
{

    // Cabecera de página
    function Header()
    {
        include '../php/conexion.php';
        $totales = "SELECT sum(VentaUsuario) from costos  ";
        $totalR = current($conexion->query($totales)->fetch_array());
        $fechaActual = date('d-m-Y H:i:s');
        $this->SetFont('Times', 'B', 20);
        $this->Image('../img/triangulosrecortados.png', 0, 0, 70); //imagen(archivo, png/jpg || x,y,tamaño)
        $this->setXY(60, 15);
        $this->Cell(100, 8, 'Reporte de Inventario', 0, 1, 'C', 0);
        $this->Ln(15);
        $this->Cell(100, 9, 'Total de Inventario: ' . '$' . $totalR . 'Mxn', 0, 1, 'C', 0);
        $this->Ln(15);
        $this->Cell(90, 9, 'Fecha: ' . $fechaActual, 0, 1, 'C', 0);
        $this->Image('../img/logo.jpg', 150, 10, 35); //imagen(archivo, png/jpg || x,y,tamaño)
        $this->Ln(40);
        $grafico = $_POST['variable'];

        $img = explode(',', $grafico, 2)[1];
        $pic = 'data://text/plain;base64,' . $img;
        $this->image($pic, 120, 27, 100, 0, 'png');
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'B', 10);
        // Número de página
        $this->Cell(170, 10, 'Todos los derechos reservados', 0, 0, 'C', 0);
        $this->Cell(25, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF(); //hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage(); //añade l apagina / en blanco
$pdf->SetMargins(10, 10, 10);

$pdf->SetAutoPageBreak(true, 20); //salto de pagina automatico
$pdf->SetX(15);
$pdf->SetFont('Helvetica', 'B', 15);
$pdf->Cell(10, 8, 'Id', 'B', 0, 'C', 0);
$pdf->Cell(60, 8, 'Nombre del producto', 'B', 0, 'C', 0);
$pdf->Cell(30, 8, 'Cantidad', 'B', 0, 'C', 0);
$pdf->Cell(35, 8, 'Unidad', 'B', 0, 'C', 0);
$pdf->Cell(50, 8, 'Costo total', 'B', 1, 'C', 0);

$pdf->SetFillColor(233, 229, 235); //color de fondo rgb
$pdf->SetDrawColor(61, 61, 61); //color de linea  rgb

$pdf->SetFont('Arial', '', 12);
while ($row = $res->fetch_assoc()) {
    $pdf->Ln(0.6);
    $pdf->setX(15);
    $pdf->Cell(10, 8, $row['id_producto'], 'B', 0, 'C', 1);
    $pdf->Cell(60, 8, $row['nombre'], 'B', 0, 'C', 1);
    $pdf->Cell(30, 8, $row['cantidad'], 'B', 0, 'C', 1);
    $pdf->Cell(35, 8, $row['unidad'], 'B', 0, 'C', 1);
    $pdf->Cell(50, 8, '$' . $row['precio'] . 'Mxn', 'B', 1, 'C', 1);
}
// for ($i = 1; $i <= 50; $i++) {

//     $pdf->Ln(0.6);
//     $pdf->setX(15);
//     $pdf->Cell(10, 8, $i, 'B', 0, 'C', 1);
//     $pdf->Cell(60, 8, 'Leche', 'B', 0, 'C', 1);
//     $pdf->Cell(30, 8, '$' . '20', 'B', 0, 'C', 1);
//     $pdf->Cell(35, 8, '2', 'B', 0, 'C', 1);
//     $pdf->Cell(50, 8, '40', 'B', 1, 'C', 1);
// }
// cell(ancho, largo, contenido,borde?, salto de linea?)


$pdf->Output();
