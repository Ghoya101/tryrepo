<?php
include("cost-nav.php");
$conn = db_connect();


$sql1		= "Select * from `sms_projects` inner join `sms_clients` 
ON `sms_projects`.`CID`  = `sms_clients`.`CID` WHERE `sms_projects`.`ENDDATE` = '0000-00-00';";
$result1	= $conn->query($sql1);
$row_ctr1	= $result1->num_rows;



?>
<link rel="stylesheet" href="../css/costing.css">
<?php
if($row_ctr1=0)
{
?>
<center>
<form class="form-content" method = "GET" action="">
<div style="margin: 2%">

NO NEW PROJECTS SUBJECTED FOR COST ESTIMATE. 

</div>
</form>
</center>
<?php
}
else
{

?>
<form class="form-content" method = "GET" action="cpage1.php">
<div name="division for New Opened Projects" style="margin: 2%;">
<h3 class="h2-style">NEW PROJECTS FOR COSTING</h3>
<?php

while($fetch1=$result1->fetch_assoc())
{
$PROJECT = $fetch1['PROJID'];	
$CLIENTS  = $fetch1['CID'];
$CSNAME = $fetch1['SURNAME'];
$CFNAME = $fetch1['FIRSTNAME'];
$NAME = $CSNAME .','. $CFNAME;


?>
<div class="divfldr">
<center>
<a href="addcostestimate.php?proj=<?php echo $PROJECT;?>">
<img src="../images/folder.png" class="img"></a>
<BR>
<label><?php echo $NAME; ?></label>
</center>
</div>
<?php
}
?>

</div>
</form>

<?php
}?>
