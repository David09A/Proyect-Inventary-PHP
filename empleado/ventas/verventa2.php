<?php
/// Powered by Evilnapsis go to http://evilnapsis.com
include "../../servicios/FPDF/fpdf.php";

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);    
$textypos = 5;
$pdf->setY(22);
$pdf->setX(10);
// Agregamos los datos de la empresa
$pdf->Image('../../img/logo.png', 160, 5, 20);
$pdf->Cell(5,$textypos,"GANJHA PRODUCTOS");
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(10);
$pdf->Cell(5,$textypos,"DE:");
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(10);
$pdf->Cell(5,$textypos,"GanJha");
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Direccion de la empresa");
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Telefono de la empresa");
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Email de la empresa");


include '../../servicios/conexion.php';



$idvt = $_GET['idvt'];

$consultacli= "SELECT V.id_venta, V.client_venta, C.cedula, C.nomb_compl_cli, C.telefono, C.correo, C.direccion 
        FROM cliente AS C
        INNER JOIN ventas AS V ON C.cedula=V.client_venta
        WHERE V.id_venta = $idvt;";
$resul1 = $con->query($consultacli);

$row1=mysqli_fetch_assoc($resul1);

// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(75);
$pdf->Cell(5,$textypos,"PARA:");
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(75);
$pdf->Cell(5,$textypos, utf8_decode($row1['nomb_compl_cli']));
$pdf->setY(40);$pdf->setX(75);
$pdf->Cell(5,$textypos, utf8_decode($row1['telefono']));
$pdf->setY(45);$pdf->setX(75);
$pdf->Cell(5,$textypos, utf8_decode($row1['correo']));
$pdf->setY(50);$pdf->setX(75);
$pdf->Cell(5,$textypos, utf8_decode($row1['direccion']));

$consutaemp = "SELECT V.id_venta, V.usuario_venta, E.num_cedula 
        FROM empleados AS E
        INNER JOIN ventas AS V ON E.num_cedula=V.usuario_venta
        WHERE V.id_venta = $idvt;";
$resul2 = $con->query($consutaemp);

$row2=mysqli_fetch_assoc($resul2);
date_default_timezone_set('America/Bogota'); //Configuramos el horario de acuerdo a la ubicación del servidor

// Agregamos los datos de la factura
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(135);
$pdf->Cell(5,$textypos,"FACTURA: ".$idvt."-".$row2['num_cedula']);
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(135);
$pdf->Cell(5,$textypos,"Fecha: ".date('d M Y H:i:s'));
$pdf->setY(40);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");
$pdf->setY(45);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");
$pdf->setY(50);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");

        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('arial', '', 9); //Asignar la fuente, el estilo de la fuente (subrayado) y el tamaño de la fuente
        $y = $pdf->GetY() + 8;
        $pdf->SetXY(10, $y);
        $pdf->MultiCell(20, 8, utf8_decode("Cod."), 1, 'C'); //Utilizamos el utf8_decode para evitar código basura o ilegible
        $pdf->SetXY(30, $y);
        $pdf->MultiCell(90, 8, utf8_decode("Nombre"), 1, 'C'); //Utilizamos el utf8_decode para evitar código basura o ilegible
        $pdf->SetXY(120, $y); //El resultado 35 es la suma de la posición 10 y el tamaño del MultiCell de 25.
        $pdf->MultiCell(25, 8, utf8_decode("cantidad"), 1, 'C');
        $pdf->SetXY(145, $y);
        $pdf->MultiCell(27, 8, utf8_decode("Precio u."), 1, 'C');
        $pdf->SetXY(172, $y);
        $pdf->MultiCell(27, 8, utf8_decode("Total"), 1, 'C');

        
    
        include '../../servicios/conexion.php';
        $idvt = $_GET['idvt'];

        
        $consulta="SELECT V.id_venta, D.id_venta, D.cod_producto, P.id, P.nombre, P.precio_venta, D.cant_prod, D.total_prod_cant, V.valor_total
        FROM det_ventas AS D
        INNER JOIN ventas AS V ON D.id_venta=V.id_venta
        INNER JOIN productos AS P ON D.cod_producto=P.id
        WHERE V.id_venta=$idvt;";
        //$consulta = "SELECT id_venta, cod_producto, cant_prod FROM det_ventas WHERE id_venta = $id";
        $resul = $con->query($consulta);

        while($row = $resul ->fetch_assoc()) {       
            $y = $pdf->GetY();
            $pdf->SetXY(10, $y);
            $pdf->MultiCell(20, 6, utf8_decode($row['id']), 1, 'C');
            $pdf->SetXY(30, $y);
            $pdf->MultiCell(90, 6, utf8_decode($row['nombre']), 1, 'C');
            $pdf->SetXY(120, $y);
            $pdf->MultiCell(25, 6, utf8_decode($row['cant_prod']), 1, 'C');
            $pdf->SetXY(145, $y);
            $pdf->MultiCell(27, 6, utf8_decode($row['precio_venta']), 1, 'C');
            $pdf->SetXY(172, $y);
            $pdf->MultiCell(27, 6, utf8_decode($row['total_prod_cant']), 1, 'C');      
        }
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        $sentencia="SELECT id_venta, valor_total FROM ventas WHERE id_venta =$idvt";
        $resultado = $con->query($sentencia);

        $row4=$resultado->fetch_assoc();

        $pdf->SetXY(120, $y+20);
        $pdf->MultiCell(52, 8, utf8_decode("Total a pagar!:"), 1, 'C'); //Utilizamos el utf8_decode para evitar código basura o ilegible
        $pdf->SetXY(172, $y+20);
        $pdf->MultiCell(27, 8, $row4['valor_total'], 1, 'C');




/*
/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
/////////////////////////////
//// Array de Cabecera

$header = array("Cod.", "Descripcion","Cant.","Precio","Total");
//// Arrar de Productos
$products = array(
    array("0010", "Producto 1",2,120,0),
    array("0024", "Producto 2",5,80,0),
    array("0001", "Producto 3",1,40,0),
    array("0001", "Producto 3",5,80,0),
    array("0001", "Producto 3",4,30,0),
    array("0001", "Producto 3",7,80,0),
);
    // Column widths
    $w = array(20, 95, 20, 25, 25);
    // Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
    // Data
    $total = 0;
    foreach($products as $row)
    {
        $pdf->Cell($w[0],6,$row[0],1);
        $pdf->Cell($w[1],6,$row[1],1);
        $pdf->Cell($w[2],6,number_format($row[2]),'1',0,'R');
        $pdf->Cell($w[3],6,"$ ".number_format($row[3],2,".",","),'1',0,'R');
        $pdf->Cell($w[4],6,"$ ".number_format($row[3]*$row[2],2,".",","),'1',0,'R');

        $pdf->Ln();
        $total+=$row[3]*$row[2];

    }
/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
$yposdinamic = 60 + (count($products)*10);

$pdf->setY($yposdinamic);
$pdf->setX(235);
    $pdf->Ln();
/////////////////////////////
$header = array("", "");
$data2 = array(
    array("Subtotal",$total),
    array("Descuento", 0),
    array("Impuesto", 0),
    array("Total", $total),
);
    // Column widths
    $w2 = array(40, 40);
    // Header

    $pdf->Ln();
    // Data
    foreach($data2 as $row)
    {
$pdf->setX(115);
        $pdf->Cell($w2[0],6,$row[0],1);
        $pdf->Cell($w2[1],6,"$ ".number_format($row[1], 2, ".",","),'1',0,'R');

        $pdf->Ln();
    }
/////////////////////////////

$yposdinamic += (count($data2)*10);
$pdf->SetFont('Arial','B',10);    

$pdf->setY($yposdinamic);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"TERMINOS Y CONDICIONES");
$pdf->SetFont('Arial','',10);    

$pdf->setY($yposdinamic+10);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"El cliente se compromete a pagar la factura.");
$pdf->setY($yposdinamic+20);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"Powered by Evilnapsis");
*/

$pdf->output();