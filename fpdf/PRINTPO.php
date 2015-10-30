<?php
session_start();
require("fpdf.php");
include "../connection/config.php";
$con=db_connect();
$PO=$_GET['poid'];

class PDF extends FPDF 
{
	
//Page header method
 /*   function Header() {
        // GET DETAILS

		date_default_timezone_set('America/Los_Angeles');
        $todayDate=date("F j, Y g:i a",time());
		$now = date('Y-m-d');

    }*/
	function Header()
{
 // Logo
    $this->Image('../images/letterhead.png',0,0,210,25);
	//$this->Image('header.png',x,y,width,height);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
   // $this->Cell(80);
    // Title
  //  $this->Cell(30,10,'Title',1,0,'C');
    // Line break
    $this->Ln(20);
	$this->Ln(5);
		$this->SetFillColor(255, 255, 255);
        $this->SetTextColor( 0, 0, 0 ,100 );
        $this->SetLineWidth(3);
        $this->SetFont('Times','B','30%');
        $header=array('ITEM ID','DESCRIPTION','QTY','UOM', 'UNIT PRICE','AMOUNT');
        //Header
        // make an array for the column widths
          $w=array(80,240,50,50,150,380);
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

function BuildTable($data) {
          $w=array(80,240,50,50,150,380);
		  
        //Color and font restoration
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        $this->SetFont('Times','','30%');
        //now spool out the data from the $data array
        // row[0] = student number
        // row[1] = student name
        // row[2] = course
        // row[3] = offense
        // row[4] = date
        // row[5] = action
        // row[6] = remarks
        // row[7] = status
        $fill=true; 
        
		$ctr = count($data);
        foreach($data as $row){
            
          
			
			if(strlen($row[5])<80)
			{
			$h=100;
			$this->SetFont('Times','','30%');
			$this->Cell($w[0],$h,$row[0],'LTBR',0,'L',$fill);            
            $this->Cell($w[1],$h,$row[1],'LTBR',0,'L',$fill);
            $this->Cell($w[2],$h,$row[2],'LTBR',0,'L',$fill);            
            $this->Cell($w[3],$h,$row[3],'LTBR',0,'L',$fill);  
            $this->Cell($w[4],$h,$row[4],'LTBR',0,'L',$fill);
           // $this->Cell($w[5],$h,$row[5],'LTBR',0,'L',$fill);
          //  $this->Cell($w[6],$h,$row[6],'LTBR',0,'L',$fill);
			$this->MultiCell($w[5],'40%',$row[5],'LTBR',5,'L',5);
			}else
			{
			  $this->SetFont('Times','','30%');
			$h=60;
			$this->Cell($w[0],$h,$row[0],'LTBR',0,'L',$fill);            
            $this->Cell($w[1],$h,$row[1],'LTBR',0,'L',$fill);
            $this->Cell($w[2],$h,$row[2],'LTBR',0,'L',$fill);            
            $this->Cell($w[3],$h,$row[3],'LTBR',0,'L',$fill);  
            $this->Cell($w[4],$h,$row[4],'LTBR',0,'L',$fill);
          //  $this->Cell($w[5],$h,$row[5],'LTBR',0,'L',$fill);
            //$this->Cell($w[6],$h,$row[6],'LTBR',0,'L',$fill);
			$this->MultiCell($w[5],'20%',$row[5],'LTBR',5,'L',5);
			}
           
                           
            //$this->Ln();

            // flips from true to false and vise versa
            $fill =! $fill;
			
        }
		date_default_timezone_set('America/Los_Angeles');
        //$todayDate=date("F j, Y g:i a",time());
		$now = date('Y-m-d');
	
		
		$this->Cell(10,40,"REPORT GENERATED ON: ".$now." ",0,0,'L', False);
        $this->Cell(array_sum($w),10,'','T');
		
    }
}

$sql1 = "SELECT * FROM `sms_pocontent` WHERE POID = '$PO' ;";
$res1 = $con->query($sql1);
$ctr1 = $res1->num_rows;

while($row= $res1->fetch_assoc()){ 
for($i=1;$i<$ctr1;$i++)
{

//PO ITEM CONTENT$data[] = array(' '.$i, $row['PODESC'], $row['POQTY'],$row['POUNIT'], $row['POUNITPRICE'],$row['PCOTOTAL']);
}
}

$pdf = new PDF('P','mm',array(215,279));
$pdf->SetFont('Times','',10);
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true,20);
$pdf->AddPage();

//$pdf->BuildTable($data);
//$pdf->SetMargins(float left, float top [, float right])
$pdf->SetMargins(5,5,5,5);
$pdf->SetFont('Times','',12);
/*
for($i=1;$i<=20;$i++)
{$pdf->Cell(0,0,'PURCHASE ORDER:'.$PO.'item: '.$i,0,0);
$pdf->LN(10);
}	
*/

$pdf->Output();
?>