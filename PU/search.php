<?php
include("pur-nav.php");
$con = db_connect();	
$b = $_GET['search'];

$sql1 = "SELECT * FROM `sms_projpo` a inner join `sms_projects` b ON a.PROJID = b.PROJID
inner join `sms_clients` c ON b.CID = c.CID
WHERE CONCAT_WS(' ', a.POID ,a.AMOUNT,a.PODATE,a.PAYEE,c.SURNAME,c.FIRSTNAME,c.MIDDLENAME) 
LIKE '%$b%' ;";
$res1 = $con->query($sql1);
$row1 = $res1->num_rows;
?>
<link rel="stylesheet" href="../css/pur.css">

<form class="form-content" method = "GET" action="search.php">
<div style="width: 100%;">
<center>
<input type=text name="search" class="search">
<input type="submit" name="cmdsearch"  style="width: 20%;"  class="rc-button rc-button-submit" value="SEARCH">
</center>
</div>
	
<table class="PO">
<?php 
if($row1 == 0)
{
?>
<tr><td>NO PURCHASE RECORDS MATCHED.</td></tr><table>
<?php		  
}
else
{
while($fet1=$res1->fetch_assoc())
{
		$POID = $fet1['POID'];
		$POD  = $fet1['PODATE'];
		$date = date("M j, Y", strtotime($POD));		
		$PAYE = $fet1['PAYEE'];
		$COST = number_format($fet1['AMOUNT'],2);
		$FNAME = $fet1['FIRSTNAME'];
		$f = $FNAME[0];
		$PROJ =  $f.'.'.  $fet1['SURNAME'];
?>

<tr class="POTR" Onclick="window.location.href='viewpo.php?poid=<?php echo $POID;?>>'">
<td><?php echo $POID;?></td>
<td><?php echo strtoupper($PROJ);?></td>
<td><?php echo $PAYE;?></td>
<td><?php echo $COST;?></td>
<td><?php echo $date;?></td>
</tr>

<?php				
}//END OF WHILE
}//END OF ELSE
?>
</table>
</form>














<!--SIDE FORM-->
<?php
$sql2 = "Select * from `sms_projects` pr inner join `sms_clients` c ON pr.CID  = c.CID 
inner join `sms_admin` sa ON sa.EMPID = pr.PURCHASINGID WHERE pr.ENDDATE = '0000-00-00' AND sa.EMPID = '$empid' ;";
$res2	= $con->query($sql2);
$row2	= $res2->num_rows;
?>
<form class="form-projects" method = "GET" action="">
<table class="tbl-proj">
<?php 
if($row2 == 0)
{
?>
<tr><td>NO RECORDS FOUND.</td></tr><table>
<?php		  
}
else
{
while($f2=$res2->fetch_assoc())
{$PROJID = $f2['PROJID'];$CID  = $f2['CID'];$NAME = $f2['SURNAME'] .','. $f2['FIRSTNAME'];$SITE=$f2['LOCATION'];
$PO=$f2['POCTR'];
$datetime1 = new DateTime($f2['STARTDATE']);
date_default_timezone_set('America/Los_Angeles');	
$datetime2 = new DateTime(date('Y-m-d'));
$interval = $datetime1->diff($datetime2);?>

<tr class="tbl-proj-tr">
<td><?php echo $NAME ."(". $PO .')';?></td>
</tr>

<?php				
}//END OF WHILE
}//END OF ELSE
?>
</table>
</form>
