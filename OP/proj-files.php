<?php
include("nav.php");
$con	= db_connect();
$proj = $_GET['proj'];

$query1 	= "SELECT * FROM `sms_projects` a inner join `sms_clients` b ON a.CID = b.CID
			   inner join `sms_prod` c ON a.PRODID = c.prodid 
			   inner join `sms_levelno` d ON a.TYPEID = d.LVLID 
			   WHERE a.PROJID = '$proj';";
$result1 	= $con->query($query1);
//$count1 	= $result1->num_rows;
while($a1 = $result1->fetch_assoc())
{
$owner 	= $a1['FIRSTNAME'].' '.$a1['SURNAME'];
$mobile = $a1['CELLNO'];
$email	= $a1['EMAIL'];
$site	= $a1['LOCATION'];
$prod	= $a1['desc'];
$type	= $a1['DESCRIPTION'];
$pur	= $a1['PURCHASINGID'];
$opr	= $a1['OPERATIONSID'];

if($pur == 0)
{
$emp1 = 'No assigned staff.';
}else
if($pur != 0)
{

$sql1	= "SELECT * from `sms_admin` a inner join `sms_projects` WHERE a.EMPID = '$pur'";
$res1	= $con->query($sql1);
while($b1 = $res1->fetch_assoc()){$emp1 = $b1['EMPNAME'].' '.$b1['EMPSURNAME'];}
}

if($opr == 0)
{
$emp2 = 'No assigned staff.';
}else
if($opr != 0 )
{
$sql2	= "SELECT * from `sms_admin` a inner join `sms_projects` WHERE a.EMPID = '$opr'";
$res2	= $con->query($sql2);
while($b2 = $res2->fetch_assoc()){$emp2 = $b2['EMPNAME'].' '.$b2['EMPSURNAME'];}
}
}
?>
<link rel="stylesheet" href="../css/proj.css">
<form class="side">
<div width='100%'>
<input class="nav-proj" type=button value="Back" Onclick="window.location.href='new_projects.php'">
<input class="nav-proj" type=button value="PCF Replenishments" Onclick="window.location.href='pcf.php?proj=<?php echo $proj;?>&&stat=APPROVE'">
<input class="nav-proj" type=button value="Purchasing" Onclick="window.location.href='po.php?proj=<?php echo $proj;?>&&stat=APPROVE'">
<input class="nav-proj" type=button value="Payroll" Onclick="window.location.href='payroll.php?proj=<?php echo $proj;?>'">
<input class="nav-proj" type=button value="Monitoring" Onclick="window.location.href='new_monitoring.php?proj=<?php echo $proj;?>'">
</div>
</form>

<form class="content">
<table class="tbl1">
<tr class="tbl1-tr-head">
<th class="tbl1-th" colspan=3>
PROJECT FILES
</th>
</tr>

<tr class="tbl1-tr-content">
<td colspan=2><br></td>
</tr>  

<tr class="tbl1-tr-content">
<td>PROJECT:</td>
<td><?php echo $prod.' '.$type;?></td>
</tr>

<tr class="tbl1-tr-content">
<td width='20%'>OWNER:</td>
<td width='78%'><?php echo $owner;?></td>
</tr>

<tr class="tbl1-tr-content">
<td>LOCATION:</td>
<td><?php echo $site;?></td>
</tr>

<tr class="tbl1-tr-content">
<td>CONTACT NO:</td>
<td><?php echo $mobile;?></td>
</tr>

<tr class="tbl1-tr-content">
<td>EMAIL:</td>
<td><?php echo $email;?></td>
</tr>



<tr class="tbl1-tr-content">
<td>PURCHASER:</td>
<td><?php echo $emp1;?></td>
</tr>

<tr class="tbl1-tr-content">
<td>ENGINEER:</td>
<td><?php echo $emp2;?></td>
</tr>

<tr class="tbl1-tr-content">
<td colspan=2><br></td>
</tr>



</table>

</form>