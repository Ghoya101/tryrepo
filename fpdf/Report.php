<img src="../CSS/images/logo.png" width="90" height="86" alt="logo" /><img src="../CSS/images/logo.png" width="90" height="86" />
<?php
//session_start();
require("fpdf.php");


require_once('../../Connections/pupcon.php');


class PDF extends FPDF {

//Page header method

// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 125, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 143, 173, 204 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 184, 207, 229 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportName = "Guidance Report";
$reportNameYPos = 160;
$logoFile = "CSS/images/logo.png";
$logoXPos = 50;
$logoYPos = 60;
$logoWidth = 100;
$columnLabels = array("yuu","uiyu","sfg","sf");
$rowLabels = array( "SupaWidget", "WonderWidget", "MegaWidget", "HyperWidget" );
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Product";
$chartYLabel = "2009 Sales";
$chartYStep = 20000;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );

$data = array(
          array( 9940, 10100, 9490, 11730 ),
          array( 19310, 21140, 20560, 22590 ),
          array( 25110, 26260, 25210, 28370 ),
          array( 27650, 24550, 30040, 31980 ),
        );

// End configuration
        function Header() {

			
       		$this->Image('headerreports.png',45,10,'210');
			
        	$this->SetFont('Times','',12);

      		$this->SetTextColor(0,0,255);

        	$this->SetLineWidth(2);



   		    $this->Write(80,'                             													   								');  
 	
			$DateFromm=$_GET['DateFrom'];
	
			$DateTooo=$_GET['DateTo'];

			$this->SetTextColor( 0, 0, 0 ,100 );
			$this->SetFont('Times','B',12);
			$this->Write(65,'                                                      	 Inventory of Equipments');
       		$this->Ln(2);
	   		$this->SetFont('Times','',11);
			$this->SetTextColor( 0, 0, 0 ,100 );
			$DateFrom=$_GET['DateFrom'];
			$DateToo=$_GET['DateTo'];
			If($DateFrom<>'' and $DateToo<>'')
			{
			
				$this->Write(70,'                                       			       									        																																															   ');
				$this->Write(70,'From ');
				$this->Write(70,$DateFromm);
				$this->Write(70,' To ');
				$this->Write(70,$DateTooo);	
			
			}
			elseif($DateFrom=='' and $DateToo=='')
			{
				$this->Write(70,'                                              			       									        																																															   ');
				$this->Write(70,'As of ');
				//$timezone = "Asia/Kuala_Lumpur";
				//$todayDate=date("d/m/Y", time());
				//$todayDate = date('D M j G:i:s T Y');  
				//$todayDate = date('M d, Y');
				
				//$timezone = date_default_timezone_set('');
				//$timezonee=date_default_timezone_set('Asia/Kuala_Lumpur');
				//$todayDate=date("Y-m-d h:iA");
				date_default_timezone_set('Asia/Kuala_Lumpur');
				$todayDate=date("F j, Y");
				
				$this->Write(70,$todayDate);
				
			
				
			
			}
			
	    	
		 	$this->Ln(5);
			$this->SetFont('Times','B',10);
			$this->SetTextColor( 0, 0, 0 ,100 );
	
			$this->Write(78,'Date/Time Printed: ');
	//$this->SetFont('Arial','B',12);	
    		date_default_timezone_set('Asia/Kuala_Lumpur');
			$todayDate=date("F j, Y g:i a",time());
			
			
			$this->SetFont('Times','',10);
			$this->Write(78,$todayDate);
			$this->Write(78,'       ');
			
			
            $Loc=$_GET['Location'];
			$Loc2=$_GET['lochidden'];
			
			if($Loc<>'')
				{	$this->SetFont('Times','B',10);
					$this->Write(78,'Office: ');
					$this->SetFont('Times','',10);
					$this->Write(78,"$Loc $Loc2");
					$this->Write(78,'         ');
				}
				
				$Cat=$_GET['CategoryList'];
				$Mod=$_GET['ModeList'];
				$Stat=$_GET['StatusList'];
		    If($Cat<>'')
			{
				$this->SetFont('Times','B',10);
					$this->Write(78,'Category: ');
					$this->SetFont('Times','',10);
					$this->Write(78,$Cat);
					$this->Write(78,'         ');
			}
			
			If($Mod<>'')
			{
				$this->SetFont('Times','B',10);
					$this->Write(78,'Mode: ');
					$this->SetFont('Times','',10);
					$this->Write(78,$Mod);
					$this->Write(78,'         ');
			
			}
			
			If($Stat<>'')
			{
				$this->SetFont('Times','B',11);
					$this->Write(78,'Status: ');
					$this->SetFont('Times','',11);
					$this->Write(78,$Stat);
					$this->Write(78,'         ');
			
			}
			$this->Ln(42);
 			 //Colors, line width and bold font
			 
			

        $this->SetFillColor(255, 255, 255);

        //$this->SetTextColor(255);
		$this->SetTextColor( 0, 0, 0 ,100 );

        //$this->SetDrawColor(128,0,0);

        $this->SetLineWidth(.3);

        $this->SetFont('','B');
$header=array('  Date Of Acquisition','    Property No.','       Qty.','    Unit','                  Item ','                              Description');

        //Header

        // make an array for the column widths

        $w=array(43,37,25,18,55,100);

        // send the headers to the PDF document

        for($i=0;$i<count($header);$i++)

        $this->Cell($w[$i],7,$header[$i],1,0,'L',1);

        $this->Ln();
		

}

        //Page footer method

        function Footer()       {

        $Fac=$_GET['Faculty'];
		$this->SetFont('Times','B',11);
		$this->SetXY(-288,-30);
		$this->Cell(100,2,'Verified by:',0,0,'L', False);
		$this->SetFont('Times','',11);
		$this->SetXY(-288,-25);
	    $this->Cell(100,4,'________________________',0,0,'L', False);
		$this->SetFont('Times','',11);
		$this->SetXY(-288,-25);
		$this->Cell(100,4,$Fac,0,0,'L', False);
		
		$this->SetFont('Times','B',11);
		$this->SetXY(-55,-30);
		$this->Cell(100,2,'Certified true and correct',0,0,'L', False);
		
		
        $this->SetY(-15);

        $this->SetFont('Times','I',8);

        $this->Cell(0,10,'Page '

        .$this->PageNo().'/{nb}',0,0,'C');

        }
       
		

        function BuildTable($data) {

        $w=array(43,37,25,18,55,100);

        //Color and font restoration

        $this->SetFillColor(255,255,255);

        $this->SetTextColor(0);

        $this->SetFont('');



        //now spool out the data from the $data array

        $fill=true; // used to alternate row color backgrounds
		
        foreach($data as $row)

        {

        $this->Cell($w[0],6,$row[0],'LTBR',0,'L',$fill);

        // set colors to show a URL style link

        $this->SetTextColor(2,0,0);

        $this->SetFont('', '');

        $this->Cell($w[1],6,$row[1],'LTBR',0,'L',$fill);

        // restore normal color settings

        $this->SetTextColor(0);

        $this->SetFont('');

        $this->Cell($w[2],6,$row[2],'LTBR',0,'L',$fill);

        $this->SetTextColor(0);

        $this->SetFont('');

        $this->Cell($w[3],6,$row[3],'LTBR',0,'L',$fill);

        $this->SetTextColor(0);

        $this->SetFont('');

        $this->Cell($w[4],6,$row[4],'LTBR',0,'L',$fill);

		$this->Cell($w[5],6,$row[5],'LTBR',0,'L',$fill);

        $this->Ln();

        // flips from true to false and vise versa

        $fill =! $fill;

        }

        $this->Cell(array_sum($w),10,'','T');
		

        }

}



//connect to database

//$connection = mysql_connect("puptaguigeduph.ipagemysql.com","2a2rg", "2a2rg");
//
//$db = "dbpuptinventory";

mysql_select_db($database_pupcon, $pupcon)

        or die( "Could not open $db database");





//$sql = 'select * from tblmedicines where department = 1
//order by Date';
//$id =$_SESSION['Stock_No'];
$DateFrom=$_GET['DateFrom'];
$DateToo=$_GET['DateTo'];
$Loc=$_GET['Location'];
$Cat=$_GET['CategoryList'];
$Mod=$_GET['ModeList'];
$Stat=$_GET['StatusList'];
$y = date('Y');



	
if($DateFrom=='' and $DateToo=='')
	{
		
$sql =("Select e.Date_Of_Acquisition,e.SerialNumber,e.Quantity,u.Unit,e.Description,i.Item_Name from tblinv_equipments as e left join tblinv_unit as u on e.Unit=u.UnitID left join tblinv_status as s on e.Status=s.StatusID left join tblinv_mode as m on e.mode=m.ModeID join tblinv_location as l on e.LocationName=l.LocationID join tblinv_itemname as i on e.ItemID=i.ItemID join tblinv_category as c on e.CategoryID=c.CategoryID WHERE e.Quantity >'0' and s.Status LIKE '%$Stat' and l.LocationName LIKE '%".addslashes($Loc)."' and c.CategoryName LIKE '%$Cat' and m.Mode LIKE '%$Mod' ORDER BY e.Eq_ID");
	}
elseif($DateFrom<>'' and $DateToo<>'')
	{
$sql =("Select e.Date_Of_Acquisition,e.SerialNumber,e.Quantity,u.Unit,e.Description,i.Item_Name from tblinv_equipments as e left join tblinv_unit as u on e.Unit=u.UnitID left join tblinv_status as s on e.Status=s.StatusID left join tblinv_mode as m on e.mode=m.ModeID join tblinv_location as l on e.LocationName=l.LocationID join tblinv_itemname as i on e.ItemID=i.ItemID join tblinv_category as c on e.CategoryID=c.CategoryID WHERE e.Quantity >'0' and s.Status LIKE '%$Stat' and l.LocationName LIKE '%".addslashes($Loc)."' and c.CategoryName LIKE '%$Cat' and m.Mode LIKE '%$Mod' and e.Date_Of_Acquisition >= '$DateFrom' and e.Date_Of_Acquisition<= '$DateToo' and e.Date_Of_Acquisition LIKE '%$y' ORDER BY e.Eq_ID");
	}
$result = mysql_query($sql, $pupcon)

   or die( "Could not execute sql: $sql");



// build the data array from the database records.

While($row = mysql_fetch_array($result)) {
		
        $data[] = array($row['Date_Of_Acquisition'],$row['SerialNumber'], $row['Quantity'], $row['Unit'], $row['Item_Name'], $row['Description'] );

}


//$balance = $res[$i]['Quantity'] - $res[$i]['Consumed']; 
// start and build the PDF document

$pdf = new PDF("L");



//Column titles

	


$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->AddPage();

// Logo
$pdf->Image( $logoFile, $logoXPos, $logoYPos, $logoWidth );


$pdf->SetFont('Times','',10);
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true,35);
$pdf->AddPage();

// call the table creation method

$pdf->BuildTable($data);

//$pdf->Cell(20,100,'Prepared by: Ms. Joyce S. Reyes',0,0,'L');

$today= date('dMY');
$pdf->Output($today.'Equipments','I');
?>