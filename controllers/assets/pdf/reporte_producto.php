<?php

require('FPDF/fpdf.php'); // Incluímos la clase fpdf.php para poder utilizar sus métodos para generar nuestro pdf


date_default_timezone_set('America/Bogota'); //Configuramos el horario de acuerdo a la ubicación del servidor
class PDF extends FPDF{    
    function Header() {        
        $this->Image('../imgs/logo.jpg', 12, 12, 25); //Insertamos el logo si es en PNG su calidad o formato debe estar entre PNG 8/PNG 24
         
        $ancho = 190;
        $this->SetFont('Arial', 'B', 6);
         
        if($this->pagina == 1){ //Cuando el archivo está en Horizontal
            $horizontal = 85; //Permitirá que las dimensiones que abarca horizontalmente sea 85 puntos más que cuando es vertical
            $this->SetY(12);
            $this->Cell($ancho + $horizontal, 10,'Fecha: '.date('d/m/Y'), 0, 0, 'R');
            $this->SetY(18);
            $this->Cell($ancho + $horizontal, 10,'Hora: '.date('H:i:s'), 0, 0, 'R');            
        } else {            
            $this->SetY(12); //Mencionamos que el curso en la posición Y empezará a los 12 puntos para escribir el Usuario:
            $this->Cell($ancho, 10,'Fecha: '.date('d/m/Y'), 0, 0, 'R');
            $this->SetY(18);
            $this->Cell($ancho, 10,'Hora: '.date('H:i:s'), 0, 0, 'R');            
        }        
    }
     
    function Body() {
        $yy = 40; //Variable auxiliar para desplazarse 40 puntos del borde superior hacia abajo en la coordenada de las Y para evitar que el título este al nivel de la cabecera.
        $y = $this->GetY(); 
        $x = 12;
        $this->AddPage($this->CurOrientation);
         
        $this->SetFont('helvetica', 'B', 20); //Asignar la fuente, el estilo de la fuente (negrita) y el tamaño de la fuente
        $this->SetXY(0, $y + $yy); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
        $this->Cell(220, 10, "Reportes Productos", 0, 1, 'C');
         
        $this->SetFont('courier', 'U', 15); //Asignar la fuente, el estilo de la fuente (subrayado) y el tamaño de la fuente
        $y = $this->GetY(); 
        $this->SetXY(0, $y); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
        $this->Cell(220, 10, "Lista de Productos", 0, 1, 'C');
         
        $this->SetFont('arial', '', 8); //Asignar la fuente, el estilo de la fuente (subrayado) y el tamaño de la fuente
        $y = $this->GetY() + 8;
        $this->SetXY(10, $y);
        $this->MultiCell(15, 4, utf8_decode("Cod."), 1, 'C'); //Utilizamos el utf8_decode para evitar código basura o ilegible
        $this->SetXY(25, $y); //El resultado 35 es la suma de la posición 10 y el tamaño del MultiCell de 25.
        $this->MultiCell(50, 4, utf8_decode("Nombre"), 1, 'C');
        $this->SetXY(75, $y);
        $this->MultiCell(35, 4, utf8_decode("Descripcion"), 1, 'C');
        $this->SetXY(110, $y);
        $this->MultiCell(40, 4, utf8_decode("Marca "), 1, 'C');
        $this->SetXY(150, $y);
        $this->MultiCell(15, 4, utf8_decode("Stock"), 1, 'C');
        $this->SetXY(165, $y);
        $this->MultiCell(35, 4, utf8_decode("Precio"), 1, 'C');

        include '../../../db/config.php';
        $consulta = "SELECT * FROM pr005m_prod";
        $resultado = $con->query($consulta);

        while($row = $resultado ->fetch_assoc()) {            
            $y = $this->GetY();
            $this->SetXY(10, $y);
            $this->MultiCell(15, 4, utf8_decode($row['k_refprod']), 1, 'C');
            $this->SetXY(25, $y);
            $this->MultiCell(50, 4, utf8_decode($row['n_name_prod']), 1, 'C');
            $this->SetXY(75, $y);
            $this->MultiCell(35, 4, utf8_decode($row['n_desc_prod']), 1, 'C');
            $this->SetXY(110, $y);
            $this->MultiCell(40, 4, utf8_decode($row['n_brand']), 1, 'C');
            $this->SetXY(150, $y);
            $this->MultiCell(15, 4, utf8_decode($row['v_cant']), 1, 'C');
            $this->SetXY(165, $y);
            $this->MultiCell(35, 4, utf8_decode($row['v_valor_prod']), 1, 'C');
        }
    }
     
    function Footer() {        
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ').$this->PageNo().'/{nb}', 0, 0, 'C');
        if($this->CurOrientation == 'L') { //Se reconoce el tipo de Orientación de la página (Vertical = P|Horizontal = L)
            $this->SetX(0);            
        } else {       
            $this->SetX(0);
             
        }        
    }
}
 
$pdf = new PDF();
$pdf->pagina = 0;
$pdf->AliasNbPages(); //Permitir el conteo de la cantidad de páginas existentes {nb}
$pdf->Body(); //Llamada a la función Body para generar el PDF
$pdf->Output('Reporte_Productos_GNR'.date("d_m_Y_H_i_s").'.pdf', 'I'); //El primer parámetro es para colocar el nombre del archivo al momento de ser descargado y el segundo parámetro es para abrir el archivo en el navegador con la opción para poder ser descargado
?>
