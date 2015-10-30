<?php
include("nav.php");
$con = db_connect();	
$EMP = $empid;
$sql = "SELECT * FROM `sms_admin` WHERE EMPID = '$EMP' ; ";
$res = $con->query($sql);
while($fet=$res->fetch_assoc())
{$empid = $fet['EMPID'];}	
$sql1 = "Select * from `sms_projects` pr inner join `sms_clients` c ON pr.CID  = c.CID 
inner join `sms_admin` sa ON sa.EMPID = pr.PURCHASINGID WHERE pr.ENDDATE = '0000-00-00' AND sa.EMPID = '$empid' ;";
$res1	= $con->query($sql1);
$row1	= $res1->num_rows;
?>
<link rel="stylesheet" href="../css/pur.css">
<form class="form-content" method = "GET" action="cpage1.php">
<table class="PO">
<?php 
if($row1 == 0)
{
?>
<tr><td>NO RECORDS FOUND.</td></tr><table>
<?php		  
}
else
{
while($f1=$res1->fetch_assoc())
{$PROJID = $f1['PROJID'];$CID  = $f1['CID'];$NAME = $f1['SURNAME'] .','. $f1['FIRSTNAME'];$SITE=$f1['PROPERTYADD'];
$PO=$f1['POCTR'];
$datetime1 = new DateTime($f1['STARTDATE']);
date_default_timezone_set('America/Los_Angeles');	
$datetime2 = new DateTime(date('Y-m-d'));
$interval = $datetime1->diff($datetime2);?>

<tr class="POTR" Onclick="window.location.href='listpo.php?proj=<?php echo $PROJID;?>'">
<td><?php echo $PROJID;?></td>
<td><?php echo $NAME;?></td>
<td><?php echo $SITE;?></td>
<td><?php echo "Items(". $PO .')';?></td>
<td><?php  echo $interval->format('%a days');?>	</td>
</tr>

<?php				
}//END OF WHILE
}//END OF ELSE
?>
</table>
</form>
