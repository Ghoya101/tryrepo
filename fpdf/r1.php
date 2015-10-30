<?php
session_start();
require("fpdf.php");
include "../connection/config.php";


class PDF extends FPDF {
	
//Page header method
    function Header() {
        // GET DETAILS
        //$date1=$_GET['datefrom'];
      //  $category=$_GET['category'];
		//$conn=db_connect();
		//$sqlasof="SELECT * FROM inventory WHERE invid = '$date1' ";
		//$resasof=$conn->query($sqlasof);
		//while($a=$resasof->fetch_assoc()){$asof = $a['lastinvdate'];}
		
		//$sqlcat="SELECT * FROM tbl_cat WHERE catid = '$category' ";
	//	$rescat=$conn->query($sqlcat);
	//	while($b=$rescat->fetch_assoc()){$cat=$b['cat_desc']; $catd=strtoupper($cat);}
		
		
        //$this->SetMargins(20,20, 20);
        //$this->Image('report-header.png',170,10,'100');
       // $this->SetFont('Times','',12);
       // $this->SetTextColor(0,0,255);
       // $this->SetLineWidth(2);
       // $this->Write(100,'');

       date_default_timezone_set('America/Los_Angeles');
        $todayDate=date("F j, Y g:i a",time());
		$now = date('Y-m-d');

        /*$this->SetFont('Times','',12);
        $this->SetTextColor(0,0,0);
        $this->SetXY(265, 45);
        $this->Cell(10,2,'From: ',0,0,'L', False);
        $this->SetXY(280, 45);
        $this->Cell(10,2,$date1,0,0,'L', False);

        $this->SetFont('Times','',12);
        $this->SetTextColor(0,0,0);
        $this->SetXY(305, 45);
        $this->Cell(10,2,'To: ',0,0,'L', False);
        $this->SetXY(315, 45);
        $this->Cell(10,2,$date2,0,0,'L', False);
             */
        $this->SetFont('Times','','40%');
        $this->SetTextColor(0,0,0);
        $this->SetXY(400, 45);
		
           
       /* if ($date1!='' && $category=='')
		{
			//$this->Image('report-header.png',120,0,'600');	
          //  $this->Cell(50,2,"PCHRD INVENTORY REPORTS ",0,0,'L', False);
			//$this->Cell(-20,25,"AS OF ",0,0,'L', False);
			//$this->Cell(0,50," ".$asof."",0,0,'L', False);
        }else if($date1!='' && $category!=''){
		$this->Image('report-header.png',120,0,'600');	
			$this->Cell(10,2,"PCHRD INVENTORY REPORTS ",0,0,'L', False);
			$this->Cell(15,25,"OF ".$catd." ",0,0,'L', False);
			$this->Cell(0,50," AS OF ".$asof."",0,0,'L', False);
        }*/

        $this->SetFont('Times','',16);
        $this->SetXY(500,65);
       // $this->Cell(30,2,,0,0,'L', False);
        $this->Ln(5);
		$this->Ln(5);
		$this->Ln(5);
		$this->Ln(5);
		$this->Ln(5);
		$this->Ln(5);
		$this->Ln(5);
		$this->Ln(5);
		$this->Ln(5);
		$this->Ln(5);
		$this->Ln(5);
		
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor( 0, 0, 0 ,100 );
        $this->SetLineWidth(3);
        $this->SetFont('Times','B','30%');
        $header=array('ACCESSION NO.','AUTHOR','COPIES','STATUS', 'REMARKS','TITLE');
        //Header
        // make an array for the column widths
          $w=array(80,240,50,50,150,380);
        // send the headers to the PDF document

        for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],25,$header[$i],1,0,'L',1);
        $this->Ln();
		$this->Ln();
    }

        //Page footer method
    function Footer(){
        $this->SetY(-40);
        $this->SetFont('Times','I','25%');
        $this->Cell(0,10,'Page '
        .$this->PageNo().'/{nb}',0,0,'C');
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
		
		$this->Cell(-1,20,"MATERIALS COUNT: ".$ctr." ",0,0,'L', False);
		
		$this->Cell(10,40,"REPORT GENERATED ON: ".$now." ",0,0,'L', False);
        $this->Cell(array_sum($w),10,'','T');
		
    }

}



mysql_select_db($database, $PUPGIS) or die( "Could not open $db database");



$date1=$_GET['datefrom'];
$category=$_GET['category'];
//echo $course;


if ($date1!='' && $category=='')
{
       $sql =("SELECT inv.accid AS accnum, mat.title AS title,mat.subj AS subj,mat.author AS author,inv.copy AS invcopy,mat.amount AS amount, inv.invdesc AS invdesc, mat.Remarks AS remarks
		FROM tbl_cat AS categ
		INNER JOIN materials AS mat ON categ.catid = mat.categoryid
		INNER JOIN tbl_inventory AS inv ON mat.accnum= inv.accid
		WHERE mat.accnum= inv.accid AND inv.invid = '$date1'
		AND inv.invdesc != ''
		order by CHAR_LENGTH(accnum)ASC");
       
}
else 
if($date1!='' && $category!='')
{
         $sql =("SELECT inv.accid AS accnum,mat.subj AS subj,mat.title AS title,mat.author AS author,inv.copy AS invcopy,mat.amount AS amount, inv.invdesc AS invdesc, mat.Remarks AS remarks
		FROM tbl_cat AS categ
		INNER JOIN materials AS mat ON categ.catid = mat.categoryid
		INNER JOIN tbl_inventory AS inv ON mat.accnum= inv.accid
		WHERE mat.accnum= inv.accid AND inv.invid = '$date1'
		AND mat.categoryid = '$category'
		AND inv.invdesc != ''
		order by CHAR_LENGTH(accnum) ASC");

}



//$result = mysql_query($sql, $PUPGIS) or die( "Could not execute sql: $sql");
connect();
$result = mysql_query($sql, $PUPGIS) or die( "No results found");
//$result = mysql_query($sql) or die( "No results found");
if (mysql_num_rows($result)>=1) {

// build the data array from the database records.

While($row = mysql_fetch_array($result)) {

        $data[] = array(' '.$row['accnum'], $row['author'], $row['invcopy'],$row['invdesc'], $row['remarks'],$row['title']);
		$inv	= count(mysql_num_rows($result));
		

}


//$balance = $res[$i]['Quantity'] - $res[$i]['Consumed'];
// start and build the PDF document

$pdf = new PDF('L','mm',array(612,1008));



//Column titles


$pdf->SetFont('Times','',10);
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true,20);
$pdf->AddPage();

// call the table creation method

$pdf->BuildTable($data);

//$pdf->Cell(20,100,'Prepared by: Ms. Joyce S. Reyes',0,0,'L');

$today= date('dMY');
$pdf->Output($today.'InventoryReport','I');

}
    else{
	?>
     <div id="NoRecOffense" style="position:relative; font:'Comic Sans MS', cursive; font-size:18px; font-weight:bold; color:#FFFFB3" ><?php echo 'No records found.'; 
       }
?></div>
 <img id="noRecord" src="../images/book-icon.png" width=150px height=120px style="position:relative; margin-top:12px" />
