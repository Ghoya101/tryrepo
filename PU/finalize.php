<?php
include("nav.php");
$con = db_connect();
if(isset($_POST['addnotes']))
{
$poid = $_POST['poid'];
$note = $_POST['note'];
$PROJ 	= $_POST['PROJ'];
echo "<script>
		window.location.href='notes.php?poid=$poid&&note=$note&&proj=$PROJ';
		</script>";

}else if(isset($_POST['finalize']))
{

$PROJ 	= $_POST['PROJID'];
$POID 	= $_POST['POID'];
$EMPID 	= $empid;
date_default_timezone_set('America/Los_Angeles');			
$NOW = date('Y-m-d h:i:s a', time());
$DDATE 	= $_POST['ddate'];
$DPLACE = $_POST['dplace'];
$RECEIVER = $_POST['receiver'];	
$PAYACC = $_POST['paccount'];	
$PAYEE	= $_POST['payee'];
$PBANK	= $_POST['pbank'];
$TERMS = $_POST['terms'];
$CONTACT = $_POST['contact'];
$CONTACTNO = $_POST['contactno'];
$STATUS = 0;
$READ = "UNREAD";


$sql2 = "SELECT sum(PCOTOTAL) as sum FROM `sms_pocontent` WHERE `POID` = '$POID';";
$res2 = $con->query($sql2);
$ctr2 = $res2->num_rows;
while($fet2=$res2->fetch_assoc())
{
$TOTAL = $fet2['sum'];
$AMOUNT = $TOTAL;}


if($PAYEE !='')
{
$sql3 = "UPDATE `sms_projpo` set `PROJID` ='$PROJ',`EMPID`='$EMPID',`AMOUNT`='$AMOUNT',`PODATE`='$NOW',
		`DELIVERYDATE`='$DDATE', `DELIVERYPLACE`='$DPLACE',`RECEIVER`='$RECEIVER',
		`PACCOUNT`='$PAYACC',`PAYEE`='$PAYEE', `BANK`='$PBANK', `TERMS`='$TERMS',
		`CONTACT`='$CONTACT',`CONTACTNO`='$CONTACTNO',`STATUS`='$STATUS', `READSTAT`='$READ' WHERE POID = '$POID';";
	
$res3 = $con->query($sql3);
	if($res3)
	{
		$sql4 = "SELECT * FROM `sms_projects` WHERE PROJID = '$PROJ';";
		$res4 =$con->query($sql4);
			while($fet4=$res4->fetch_assoc())
			{$POCTR = $fet4['POCTR'];
			 $POCTR = intval($POCTR)+ 1 ;
			}
	  $sql5 = "UPDATE `sms_projects` set POCTR = '$POCTR' WHERE PROJID = $PROJ;";
	  $res5 = $con->query($sql5);
	  if($res5)
	  {
		  echo "<script>
		alert('PURCHASE ORDER SUCCESSFULLY SUBMITTED.');
		window.location.href='po.php?proj=$PROJ&&stat=ALL';
		</script>";
	  }else
	  {
		  echo "<script>
		alert('PO COUNTER FAILED TO UPDATE.');
		window.location.href='po.php?proj=$PROJ&&stat=ALL';
		</script>";
	  }
	  
	}

}else
{
	echo "<script>
		alert('PLEASE FILL IN THE REQUIRED FIELDS.');
		window.location.href='submit.php?proj=$PROJ&&poid=$POID';
		</script>";
}
}

?>
