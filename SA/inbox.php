<?php
include("nav.php");
$con = db_connect();
?>

<html>

<link rel="stylesheet" href="../css/inbox.css">
<center>
<form class="form-content" method = "GET" action="index.php">
<div style="margin: 2%">
<table class='tbl-search'>
<tr>
<td>
			<Select name="searchby" class="searchcat">
				<option value="all">All matched info</option>
				<option value="HOMEADD">Check Number</option>
				<option value="HOMEADD">CV Number</option>
				<option value="SURNAME">Id</option>
				<option value="CITIZENSHIP">Department</option>
				<option value="CITIZENSHIP">Description</option>
				<option value="CITIZENSHIP">Payee Name</option>
			</select>
</td>			
<td width='60%'><input style=""				type="text" name="s" class="searchbox"></td>
<td><input style="width: 100%;float: left; margin-left: 0.5%;" class="rc-button rc-button-submit" type="submit" name="cmdSearch" value="SEARCH"></td>
</tr>
</table>	

<?php
if(isset($_GET['cmdSearch']))
{
	$a = $_GET['searchby'];
	$b = $_GET['s'];

if($a = 'all' && $b != '')
{
$sql2 = "SELECT * FROM `sms_clients` 
WHERE CONCAT_WS(' ', `SURNAME`, `FIRSTNAME`, `MIDDLENAME`,`CIVIL STATUS`,`CITIZENSHIP`,`TIN`,`BIRTHDATE`,
`HOMEADD`,`BILLINGADD`,`OFFICETEL`,`HOMETEL`,`CELLNO`,`EMAIL`,`LANDFORCONSTRUCTION`,`LANDAREA`,`NAMEOFSUBDIVISION`,`PROPERTYADD`) LIKE '%$b%' ;";
}
else if($a != 'all' && $b != '')
{
$sql2 = "SELECT * FROM `sms_clients` WHERE '$a' LIKE '%$b%' ORDER BY SURNAME; ";	
}

$res2 = $con->query($sql2);
$ctr2 = $res2->num_rows;
if($ctr2 == 0)
{
?>
<br><br><br><br>
<div class="no">
NO ITEMS MATCHED.
</div>
<?php
}else
if($ctr2 >= 1)	
{	
?>


<?php
}
}else{
?>
<!--INBOX-->
<div class="side-nav">

</div>


<div class="inb-side">
<input type="button" CLASS="side-btn" value="SITES">
<input type="button" CLASS="side-btn" value="PURCHASING">
<input type="button" CLASS="side-btn" value="OFFICE">
</div>

<?php 
$query1 	= "SELECT * FROM `sms_projpo` a inner join `sms_admin` b
			   ON a.EMPID = b.EMPID inner join `sms_projects` c
			   ON a.PROJID = c.PROJID inner join `sms_clients` d
			   ON c.CID = d.CID WHERE PO_STATUS = 'APPROVE' AND CVNO != ''   ;";
$result1 	= $con->query($query1);
$count1		= $result1->num_rows;
?>
<div class="inb-content">
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

?>
<tr class="tr-po" Onclick="window.location.href='approvepo.php?poid=<?php echo $POID;?>'">
<td								><?php echo $EMP;?></td>
<td								><?php echo $POID;?></td>
<td								><?php echo $CLIENT;?></td>
<td								><?php echo $PAYEE;?></td>
<td style="text-align:right;"	><?php echo $AMOUNT;?></td>
<td								><?php echo date("M j, Y h:ia", strtotime($PODA));?></td>
</tr>
<?php 
}//end of while
}
?>


</table>
</div>
<?php
}
?>
</div>
</form>
</center>


</html>