<?php
include("nav.php");
$con = db_connect();

$PROJ = $_GET['proj'];
$poid = $_GET['poid'];
$note = $_GET['note'];
date_default_timezone_set('America/Los_Angeles');			
$notedate = date('Y-m-d h:i:s a', time());
$emp = $empid;
if(isset($_GET['add']))
{
$query = "INSERT INTO `sms_ponotes` (`POID`,`CONTENT`,`EMPID`,`DATECREATED`,`DATEMODIFIED`)
		  VALUES ('$poid','$note','$emp','$notedate','$notedate')";

}else if(isset($_GET['edit']))
{
$ID = $_GET['nid'];
$query = "update sms_ponotes SET CONTENT = '$note', DATEMODIFIED = '$notedate' WHERE ID = '$ID' ;";
}
$resqu = $con->query($query);
if($resqu)
{
		echo "<script>
		window.location.href='newpo.php?proj=$PROJ&&poid=$poid';
		</script>";
}
?>