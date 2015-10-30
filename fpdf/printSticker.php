<?php
//session_start();
require("fpdf.php");

include "../connection/config.php";

class PDF extends FPDF
{

function Border()
{	
	$i=5;
	$y=5;
	$imgLoc = 48.5;
	//$this->BorderForQR();
		//$y=5;
		$yyeah = 0;
		while($i > 0)
		{
			$x=5;
			$imgLoc = 48.5;
			for($xdet=1;$xdet<=3;$xdet++)
			{
				if($i!=0){
				$wBr=36;
				$this->Rect($x,$y,65,$wBr);
				$this->SetFillColor(255,255,255);
				$this->SetTextColor(0);
				$this->SetLineWidth(.2);
				$this->SetTextColor(0);
				$this->SetFont('Times','B',8.5);
				$this->SetXY($x,$y);
				$image = "PUP-TMP_MN";
				$this->Cell(65,6.5,'Property Number:   '.$image,"LTBR",0,'L', True);
				$this->SetXY($x,11.5+$yyeah);	
				$desc = $_GET['desc'];
				$this->Cell(65,7,'Description: '.$desc,"LTBR",0,'L', True);
				$this->SetXY($x,18.5+$yyeah);
				$loc = $_GET['location'];
				$this->Cell(43,9,'Location:  '.$loc,"LTBR",0,'L', True);
				$this->SetXY($x,27+$yyeah);
				$officer = $_GET['officer'];
				$this->Cell(43,7,'Officer:  '.$officer,"LTBR",0,'L', True);
				$this->SetXY($x,34+$yyeah);
				//$todayDate = date('M d, Y');
				date_default_timezone_set('Asia/Kuala_Lumpur');
				$todayDate= date("F j, Y");
				//$date = ;
				$this->Cell(43,7,'Date:  '.$todayDate,"LTBR",0,'L', True);
				$this->Image("tmp/$image.png",$imgLoc,19.5+$yyeah,21);
				$x=$x+67;
				$imgLoc = $imgLoc + 67;
				$i = $i - 1;
				}
				else
					break;
			}
			$yyeah = $y+35;
			$y = $y + 40;
		}
}

function GetDataFromDatabase($data){

}

}

//$numberofcopies = $_GET['numberofcopies'];
$pdf = new PDF( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->Border();
//$pdf->BorderForQR();
$pdf->Output();
?>