<?php
include("nav.php");
$con = db_connect();
?>
<link rel="stylesheet" href="../css/c-index.css">
<body style="font-family:arial;">
<form class="inb-side"  style="font-family:arial;">
<input type="button" CLASS="side-btn" value="SITES">
<input type="button" CLASS="side-btn" value="PURCHASING">
<input type="button" CLASS="side-btn" value="OFFICE">
</form>







<?php 
$query1 	= "SELECT * FROM `sms_projpo` a inner join `sms_admin` b
			   ON a.EMPID = b.EMPID inner join `sms_projects` c
			   ON a.PROJID = c.PROJID inner join `sms_clients` d
			   ON c.CID = d.CID WHERE STATUS = 3;";
$result1 	= $con->query($query1);
$count1		= $result1->num_rows;
?>
<form class="inb-content"  style="font-family:arial;">
<table class="tbl">

<?php 
if($count1 == 0)
{
?>
<tr>
<td>No messages.</td>
</tr>
<?php 
}else
{
while($a1 = $result1->fetch_assoc())
{
$POID 	= $a1['POID'];
$PODA 	= $a1['PODATE'];
$PAYEE	= $a1['PAYEE'];
$AMOUNT	= $a1['AMOUNT'];
$CLIENT	= ($a1['FIRSTNAME'][0]).'.'. $a1['SURNAME'];
$EMP	= $a1['EMPNAME'].' '.$a1['EMPSURNAME'];

$q2 = "SELECT * FROM `sms_pocontent` WHERE POID = '$POID'";
$r2 = db_connect()->query($q2);	
$ctr = $r2->num_rows;
$AMOUNT = 0;
WHILE($re=$r2->fetch_assoc())
{
$t = ($re['POQTY'])* ($re['POUNITPRICE']);
$AMOUNT += $t;

}

?>
<tr class="tr-po" Onclick="window.location.href='approvepo.php?poid=<?php echo $POID;?>'">
<td								><?php echo $EMP;?></td>
<td								><?php echo $POID;?></td>
<td								><?php echo $CLIENT;?></td>
<td								><?php echo $PAYEE;?></td>
<td style="text-align:right;"	><?php echo number_format($AMOUNT,2);?></td>
<td								><?php echo date("M j, Y h:ia", strtotime($PODA));?></td>
</tr>
<?php 
}//end of while
}
?>


</table>
</form>
