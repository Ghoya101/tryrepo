<?php
define('FPDF_FONTPATH','font/');
require('fpdf.php');
include "../connection/config.php";
$con=db_connect();
$PO =$_GET['poid'];

class PDF extends FPDF
{
function Header()
{
 // Logo
    $this->Image('../images/letterhead.png',0,0,210,25);
	//$this->Image('header.png',x,y,width,height);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    $this->Ln(10);
}
function info()
{
$PO =$_GET['poid'];
$sql = "SELECT * FROM `sms_projpo` WHERE POID = '$PO' ;";
$res = db_connect()->query($sql);
while($A = $res->fetch_assoc()){ 
$AMOUNT = $A['AMOUNT']; 
$CVNO = $A['CVNO'];
$CHECKNO = $A['CHECKNO'];
$CHECKDATE = $A['CHECKDATE'];
$PODATE = $A['PODATE'];
$CVDATE = $A['CVDATE'];
$DELIVERYDATE = $A['DELIVERYDATE'];
$DELIVERYPLACE = $A['DELIVERYPLACE'];
$RECEIVER = $A['RECEIVER'];
$RECEIVEDATE = $A['RECEIVEDDATE'];
$PACCOUNT = $A['PACCOUNT'];
$PAYEE = $A['PAYEE'];
$BANK = $A['BANK'];
$CONTACT = $A['CONTACT'];
$CONTACTNO = $A['CONTACTNO'];
$APPROVEDATE = $A['APPROVEDATE'];
}

	
    // Arial bold 15
    $this->SetFont('Arial','',12);
    $this->Cell(-1,20,"PURCHASE ORDER:      ".$PO."                                    					 PO DATE:              ".$PODATE,0,0,'L', False);$this->Ln(5);
    $this->Cell(-1,20,"CV NO:                             ".$CVNO."             						                           CV DATE:         ".$CVDATE,0,0,'L', False);$this->Ln(5);
    $this->Cell(-1,20,"CHECK NO:      ".$CHECKNO."                                                              CHECK DATE:    ".$CHECKDATE,0,0,'L', False);$this->Ln(5);
    $this->Cell(-1,20,"PAYEE:                             ".$PAYEE,0,0,'L', False);$this->Ln(5);
    $this->Cell(-1,20,"PAYEE ACCOUNT:          ".$PACCOUNT,0,0,'L', False);$this->Ln(5);
    $this->Cell(-1,20,"BANK:                      		     		".$BANK,0,0,'L', False);$this->Ln(5);
    $this->Cell(-1,20,"CONTACT:                       ".$CONTACT."/".$CONTACTNO,0,0,'L', False);$this->Ln(5);
    $this->Cell(-1,20,"DELIVERY INFO:             ".$DELIVERYDATE."/".$DELIVERYPLACE,0,0,'L', False);$this->Ln(5);
    $this->Cell(-1,20,"RECEIVER:                      ".$RECEIVER,0,0,'L', False);$this->Ln(5);

	$this->Ln(15);
}


function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

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
$this->MultiCell($w[4],6,number_format($row[4],2),0,'L'); 

$x =$x+$w[3]; 
$this->SetXY($x + $w[4],$y);
$this->Cell($w[5], $yH, "", 'LRB',0,'',$fill); 
$this->SetXY($x + $w[4], $y); 
$this->MultiCell($w[5],6,number_format($row[5],2),0,'L'); 

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
$i;	
for($i=1;$i<=$ctr1;$i++)
while($row= $res1->fetch_assoc())
{
	{	
//PO ITEM CONTENT
$data[] = array(' '.$i, $row['PODESC'], $row['POQTY'],$row['POUNIT'], $row['POUNITPRICE'],$row['PCOTOTAL']);
$i++;
	}
}

//$data[] = array('countries','capitals','20','pcs','25000');


$pdf->AliasNbPages();
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->info();
$pdf->FancyTable($header,$data);

$pdf->Output();
?>