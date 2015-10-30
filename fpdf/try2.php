<?php
define('FPDF_FONTPATH','font/');
require('fpdf.php');
include "../connection/config.php";
$con=db_connect();
$PO=$_GET['poid'];

class PDF extends FPDF
{

function FancyTable($header,$data)
{
//Colors, line width and bold font
$this->SetFillColor(0,0,0);
$this->SetTextColor(255);
$this->SetLineWidth(.3);
$this->SetFont('Arial','B',14);
//Header
 $w=array(10,65,20,20,40,40);
for($i=0;$i<count($header);$i++)
$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
$this->Ln();
//Color and font restoration
$this->SetFillColor(255,255,255);
$this->SetTextColor(0);
$this->SetFont('Arial','',10);
//Data
$fill=false;

$i = 0;


$x0=$x = $this->GetX();
$y = $this->GetY();
foreach($data as $row)
{

for ($i=0; $i<6; $i++) //Avoid very lengthy texts

{ 

$row[$i]=substr($row[$i],0,160);

}

$yH=15; //height of the row
$this->SetXY($x, $y);
$this->Cell($w[0], $yH, "", 'LRB',0,'',$fill);
$this->SetXY($x, $y);
$this->MultiCell($w[0],6,$row[0],0,'L'); 


$this->SetXY($x + $w[0], $y);
$this->Cell($w[1], $yH, "", 'LRB',0,'',$fill); 
$this->SetXY($x + $w[0], $y);
$this->MultiCell($w[1],6,$row[1],0,'L'); 


$x =$x+$w[0];
$this->SetXY($x + $w[1], $y);
$this->Cell($w[2], $yH, "", 'LRB',0,'',$fill); 
$this->SetXY($x + $w[1], $y);
$this->MultiCell($w[2],6,$row[2],0,'L'); 

$x =$x+$w[1];
$this->SetXY($x + $w[2], $y);
$this->Cell($w[3], $yH, "", 'LRB',0,'',$fill); 
$this->SetXY($x + $w[2], $y); 
$this->MultiCell($w[3],6,$row[3],0,'L'); 

$x =$x+$w[2];
$this->SetXY($x + $w[3], $y);
$this->Cell($w[4], $yH, "", 'LRB',0,'',$fill); 
$this->SetXY($x + $w[3], $y); 
$this->MultiCell($w[4],6,$row[4],0,'L'); 

$x =$x+$w[3]; 
$this->SetXY($x + $w[4],$y);
$this->Cell($w[5], $yH, "", 'LRB',0,'',$fill); 
$this->SetXY($x + $w[4], $y); 
$this->MultiCell($w[5],6,$row[5],0,'L'); 

$y=$y+$yH; //move to next row
$x=$x0; //start from firt column
$fill=!$fill;
}

}
}	


$pdf=new PDF();
//Column titles
$header=array('ID','DESCRIPTION','QTY','UOM','UNIT PRICE','AMOUNT');
//Data loading
//$data=$pdf->LoadData('countries.txt');
$sql1 = "SELECT * FROM `sms_pocontent` WHERE POID = '$PO' ;";
$res1 = $con->query($sql1);
$ctr1 = $res1->num_rows;

while($row= $res1->fetch_assoc()){ 
for($i=1;$i<$ctr1;$i++)
{

//PO ITEM CONTENT
$data[] = array(' '.$i, $row['PODESC'], $row['POQTY'],$row['POUNIT'], $row['POUNITPRICE'],$row['PCOTOTAL']);
}
}

//$data[] = array('countries','capitals','20','pcs','25000');



$pdf->SetFont('Arial','',14);
$pdf->AddPage();
//$pdf->BasicTable($header,$data);
//$pdf->AddPage();
//$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>