<?php
include("../connection/config.php");
$con = db_connect();

if(isset($_GET['poid']))
{
$poid = $_GET['poid'];

$query 	= "SELECT * FROM sms_projpo a inner join sms_projects b ON a.PROJID = b.PROJID 
		inner join sms_clients c ON b.CID = c.CID WHERE a.POID = '$poid' ;";
$run	= $con->query($query);
		while($A = $run->fetch_assoc())
		{
			$DELIVERYDATE 	= $A['DELIVERYDATE'];
			$DELIVERYPLACE 	= $A['DELIVERYPLACE'];
			$RECEIVER 		= $A['RECEIVER'];
			$PACCOUNT 		= $A['PACCOUNT'];
			$PAYEE 			= $A['PAYEE'];
			$BANK 			= $A['BANK'];
			$CONTACT 		= $A['CONTACT'];
			$CONTACTNO 		= $A['CONTACTNO'];
			$TERMS 			= $A['TERMS'];
			$pr  			= $A['PURCHASINGID'];
			$podate  		= $A['PODATE'];
			$checker 		= $A['CHECKER'];
			$cdate	 		= $A['APPROVEDATE'];
			$acct	 		= $A['RECOMMENDEDBY'];
			$adate   		= $A['RECDATE'];
			$approve 		= $A['APPROVEDBY'];
			$apdate  		= $A['APPDATE'];
			$disburst		= $A['DISBURSTBY'];
			$ddate   		= $A['DISDATE'];
		}
		
header("Content-type: application/vnd.ms-excel");
$filename = "Content-Disposition: attachment;Filename=PO# ".$poid." ".$PAYEE.".xls";
header($filename);

echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<table border=1>";

echo "<tr>";
echo "<td >PURCHASE ORDER NO.</td>";
echo "<td>";
echo $poid;
echo "</td>";

echo "</tr>";

//echo "<b>testdata1</b> \t <u>testdata2</u> \t \n ";
echo "</table>";
echo "</body>";
echo "</html>";
}
?>