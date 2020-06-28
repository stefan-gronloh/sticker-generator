<?php

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

$width = 222;  
$height = 314; 

$pageLayout = array($width, $height); //  or array($height, $width) 
$pdf = new TCPDF('p', 'mm', $pageLayout, true, 'UTF-8', false);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set margins
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$position_imageuto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);

$pdf->AddPage();
$pdf->ImageEps('assets/images/achtergrond_clean.ai', 0,0);

// Footer
$pdf->ImageEps('assets/images/footer.eps',180,$height-40);

$pdf->SetXY(30,70);
$rockwell = TCPDF_FONTS::addTTFfont('assets/fonts/ROCK.TTF', 'TrueTypeUnicode', '', 32);
$pdf->SetFont($rockwell,'','12');
$pdf->MultiCell(40, 0, 'Stefan Grönloh Booschutterstraat 1 2333AH Apeldoorn', 1, 'L', 1, 1, '' ,'', true);

// Teken de buitenste snijlijnen
$pdf->SetLineStyle(array("width" => 0.3, "cap" => "butt", "join" => "miter", "dash" => 0, "color" => array(233, 30, 99)));

$pdf->RoundedRect(115,5, 103, 143, 3, "1111", "");     

$rockwell = TCPDF_FONTS::addTTFfont('assets/fonts/ROCKEB.TTF', 'TrueTypeUnicode', '', 32);
$pdf->SetFont($rockwell,'','15');
// Bepaal X en Y voor de stickers
$pdf->SetXY(40,115);

// Setup information
$name = 'Stefan Gronloh';
$pdf->SetTextColor(0,0,0);
// Positie van eerste rij labels op X-as
$x=196; 
// Positie van eerste rij labels op Y-as
$y=85;
$position_image =183;
$position_outlines = 182;
$pdf->ImageEps('assets/images/patroon.eps', 120,0);
$pdf->StartTransform();
$pdf->Rotate(90);
$pdf->SetXY($y,$x);

for($i=1; $i<=8; $i++) {    
    $x = $x + 12;
    $position_image = $position_image + 12;
    $position_outlines = $position_outlines + 12;
        
    // Breedte van de tekst
    $width = $pdf->GetStringWidth($name)+5;
    $posImage = $pdf->GetStringWidth($name)+88;    
    $pdf->RoundedRect(82, $position_outlines, $width+12, 10, 3, "1111", ""); 
    $pdf->ImageEps('assets/images/cow.eps', $posImage, $position_image, 10, '', '', true, '', '', 0, false);    
    $pdf->Cell( $width, 4, $name, 0, 0, 'L', 0, false);
    $pdf->SetXY($y,$x);
}

// Positie van tweede rij labels op X-as
$x=196; 
// Positie van tweede rij labels op Y-as
$y=15;
$position_image =183;
$position_outlines = 182;
$pdf->StartTransform();
$pdf->Rotate(0);
$pdf->SetXY($y,$x);

for($i=1; $i<=8; $i++) {    
    $x = $x + 12;
    $position_image = $position_image + 12;
    $position_outlines = $position_outlines + 12;    

    // Breedte van de tekst
    $width = $pdf->GetStringWidth($name)+5;
    $posImage = $pdf->GetStringWidth($name)+18;    
    $pdf->RoundedRect(12, $position_outlines, $width+12, 10, 3, "1111", "");     
    $pdf->ImageEps('assets/images/cow.eps', $posImage, $position_image, 10, '', '', true, '', '', 0, false);    
    $pdf->Cell( $width, 4, $name, 0, 0, 'L', 0, false);
    $pdf->SetXY($y,$x);
}

$pdf->StopTransform();


$pdf->Output('uitwerking06-new.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+