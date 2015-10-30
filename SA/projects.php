<?php
include("nav.php");
$conn = db_connect();


$sql1		= "Select * from `sms_projects` a inner join `sms_clients` b
ON a.`CID`  = b.`CID` 
inner join `sms_levelno` c ON a.TYPEID = c.LVLID
inner join `sms_prod` d ON a.PRODID = d.prodid
WHERE a.`ENDDATE` = '0000-00-00' 
ORDER BY b.SURNAME;";
$result1	= $conn->query($sql1);
$row_ctr1	= $result1->num_rows;



?>

<center>
<form class="form-content" method = "GET" action="cc3.php">
<div style="background: #000; margin-top:1%;margin-bottom: 2%;">
<input style="width: 10%;float: left; margin-left: 0.5%;" class="rc-button rc-button-submit" type="button" name="addproj"  value="+ PROJECT" Onclick="window.location.href='addproject.php'">
<input style="width: 10%;float:left;" class="rc-button rc-button-submit" type="submit" name="Submit"  value="DELETE">
<input style="float:left;width:15%;" class="rc-button rc-button-submit" type="submit" name="Submit"  value="CLOSE PROJECT">
</div><br>


<div name="division for New Opened Projects" style="margin-top: 1%;bakcground: blue;">
<?php
if($row_ctr1=0)
{
?>
NO PROJECTS IN THE DATABASE.
<?php
}
else
{
?>
<table class="tbl_admin1">
<tr class="tbl_tr">
<th style="width:5px;" class="tbl_th1">#</th>
<th width="10%" class="tbl_th1">CLIENT NAME</th>
<th width="10%" class="tbl_th1">PRODUCT</th>
<th width="10%" class="tbl_th1">LEVEL</th>
<th width="15%" class="tbl_th1">LOCATION</th>
<th width="15%" class="tbl_th1">LAND AREA</th>
<th width="10%" class="tbl_th1">PROJECT AGE</th>
</tr>
<?php
while($fetch1=$result1->fetch_assoc())
{
$PROJECT = $fetch1['PROJID'];	
$CLIENTS  = $fetch1['CID'];
$CSNAME = $fetch1['SURNAME'];
$CFNAME = $fetch1['FIRSTNAME'];
$NAME 	= $CSNAME .','. $CFNAME;
$PROD	= $fetch1['desc'];
$SITE 	= $fetch1['PROPERTYADD'];
$AREA 	= $fetch1['LANDAREA'];
$TYPE	= $fetch1['DESCRIPTION'];
$date1= $fetch1['STARTDATE'];
date_default_timezone_set('America/Los_Angeles');
$date2 = date('Y-m-d');
 
$datetime1 = new DateTime($date1);
$datetime2 = new DateTime($date2);
$interval = $datetime1->diff($datetime2);
?>

<tr class="tbl_admin1tr">
<td class="tbl_admin1td"><input type="checkbox" name="chk1[]" value="<?php echo $PROJECT;?>"></td>
<td class="tbl_admin1td" Onclick="window.location.href='editproject.php?proj=<?php echo $PROJECT;?>'"><label style="text-align:center;"><?php echo $NAME; ?></label></td>
<td class="tbl_admin1td"><label style="text-align:center;"><?php echo $PROD; ?></label></td>
<td class="tbl_admin1td"><label style="text-align:center;"><?php echo $TYPE; ?></label></td>
<td class="tbl_admin1td"><label style="text-align:center;"><?php echo $SITE; ?></label></td>
<td class="tbl_admin1td"><label style="text-align:center;"><?php echo $AREA.' SQ. M.'; ?></label></td>
<td class="tbl_admin1td"><label style="text-align:center;"><?php echo $interval->format('%a days');?></label></td>
</tr>

<?php
}
?>
</table><hr><br>
</div>
</form>
</center>
<?php
}?>
