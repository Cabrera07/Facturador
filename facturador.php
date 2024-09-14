<?php
require_once('tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    // Método para definir el encabezado del PDF
    public function Header() {
        // Logos
        $logo_ruta = 'img/logo.jpg';  
        $logo_ruta2 = 'img/monitor.jpg';  
        
        // Logo principal en la parte izquierda
        $this->Image($logo_ruta, 20, 5, 30, 30, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        // Segundo logo en la parte derecha
        $this->Image($logo_ruta2, 160, 5, 30, 30, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        // Título centrado
        $this->SetFont('helvetica', 'B', 30);
        $this->SetXY(25, 14);  
        $this->Cell(150, 15, 'Factura', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        
        // Subtítulo centrado
        $this->SetFont('helvetica', 'B', 12);
        $this->SetY(30);
        $this->Cell(170, 2, 'Tu Tienda de Artículos Computacionales', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->SetY(35);

        // Línea decorativa
        $this->SetLineStyle(array('width' => 0.85, 'color' => array(0,0,0)));
        $this->Line(15, 40, 200, 40); 
    }

    // Método para definir el pie de página del PDF
    public function Footer() {
        // Posición a 15 mm desde la parte inferior
        $this->SetY(-15);
        
        $this->SetLineStyle(array('width' => 0.85, 'color' => array(0,0,0)));
        $this->Line(10, 282, 200, 282); 

        // Fuente del pie de página
        $this->SetFont('helvetica', 'B', 15);
        
        // Texto centrado con número de página
        $this->Cell(215, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, 0, 'C');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores de los campos del formulario
    $nombres = $_POST['nombre'];
    $cantidades = $_POST['cantidad'];
    $precios = $_POST['precio'];

    // Crear nuevo documento PDF
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Establecer información del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Tu Tienda');
    $pdf->SetTitle('Factura');
    $pdf->SetSubject('Factura de compra');
    $pdf->SetKeywords('TCPDF, PDF, factura, computacionales');

    // Establecer fuentes de encabezado y pie de página
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // Establecer fuente monoespaciada predeterminada
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Establecer márgenes
    $pdf->SetMargins(PDF_MARGIN_LEFT, 45, PDF_MARGIN_RIGHT);  
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Establecer saltos de página automáticos
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Establecer factor de escala de imagen
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Añadir una página
    $pdf->AddPage();

    // Establecer fuente
    $pdf->SetFont('helvetica', '', 10);

    // Crear tabla
    $html = '<h2>Detalle de la factura</h2>';
    $html .= '<table border="1" cellpadding="4">
    <tr style="background-color:#CCCCCC;">
        <th><b>Artículo</b></th>
        <th><b>Cantidad</b></th>
        <th><b>Precio Unitario</b></th>
        <th><b>Total</b></th>
    </tr>';

    // Calcular subtotal y total de la factura
    $subtotal = 0;
    for ($i = 0; $i < count($nombres); $i++) {
        $total_articulo = $cantidades[$i] * $precios[$i];
        $subtotal += $total_articulo;

        // Agregar fila con detalles del artículo
        $html .= '<tr>
            <td>'.$nombres[$i].'</td>
            <td>'.$cantidades[$i].'</td>
            <td>$'.number_format($precios[$i], 2).'</td>
            <td>$'.number_format($total_articulo, 2).'</td>
        </tr>';
    }

    // Calcular ITBMS y total a pagar
    $itbms = $subtotal * 0.07;
    $total = $subtotal + $itbms;

    // Agregar fila con subtotal, ITBMS y total
    $html .= '<tr>
        <td colspan="3" align="right"><b>Subtotal:</b></td>
        <td><b>$'.number_format($subtotal, 2).'</b></td>
    </tr>
    <tr>
        <td colspan="3" align="right"><b>ITBMS (7%):</b></td>
        <td><b>$'.number_format($itbms, 2).'</b></td>
    </tr>
    <tr>
        <td colspan="3" align="right"><b>Total a Pagar:</b></td>
        <td><b>$'.number_format($total, 2).'</b></td>
    </tr>';

    $html .= '</table>';

    // Imprimir texto usando writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    // Cerrar y generar PDF
    $pdf->Output('factura.pdf', 'I');
} else {
    echo "Acceso no autorizado";
}
?>
