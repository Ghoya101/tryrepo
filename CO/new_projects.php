<?php
include("nav.php");
$query1 	= "SELECT * FROM `sms_projects` a inner join `sms_clients` b ON a.CID = b.CID;";
$result1 	= db_connect()->query($query1);
$count1 	= $result1->num_rows;


?>
<link rel="stylesheet" href="../css/proj.css">

<form class="new-projects-content">
<table class="tbl1">
<tr class="tbl1-tr-head">
<th class="tbl1-th" colspan=3>
PROJECTS
</th>
</tr>

<?php
if($count1 != 0)
{
while($a1 = $result1->fetch_assOc())
{

$CLIENT = $a1['FIRSTNAME'].' '.$a1['SURNAME'];
$PROJECT = $a1['PROJID'];
$SITE = $a1['PROPERTYADD'];
$date1= $a1['STARTDATE'];
date_default_timezone_set("Asia/Manila");
$date2 = date('Y-m-d');
 
$datetime1 = new DateTime($date1);
$datetime2 = new DateTime($date2);
$interval = $datetime1->diff($datetime2);

?>
<tr class="listproj" Onclick="window.location.href='proj-files.php?proj=<?php echo $PROJECT;?>'">
<td><?PHP echo $CLIENT;?></td>
<td><?PHP echo $SITE;?></td>
<td><?PHP echo $interval->format('%a days');?></td>
</tr>

<?php
}
}else{
?>
<tr class="listproj">
<td colspan=3><?PHP echo 'NO DATABASE RECORDS.';?></td>
</tr>
<?php
}
?>



<tr class="listproj">
<td colspan=3></td>
</tr>



</table>

</form>