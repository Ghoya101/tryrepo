<?php
include("nav.php");
$con = db_connect();
if(isset($_POST['cmdadd']))
{
$a = $_POST['owner'];
$c = $_POST['product'];
$d = $_POST['level'];
$e = $empid ;
$f = $_POST['engr'];
$g = $_POST['pur'];
date_default_timezone_set('America/Los_Angeles');
$now= date('Y-m-d');

$sql123 = "SELECT * from `sms_projects` WHERE `CID` = $a; ";
$res123=$con->query($sql123);
$ctr123	= $res123->num_rows;
if($ctr123 <= 0)
{
$msg1 = "PROJECT SUCCCESSFULLY ADDED.";
$msg2 = "PROJECT FAILED TO ADD.";

$sql1 = "INSERT INTO `sms_projects`(`CID`,`PRODID`, `TYPEID`,`ADMINID`,`OPERATIONSID`,`PURCHASINGID`,`STARTDATE`) 
		VALUES ('$a','$c','$d','$e','$f','$g','$now');";
$res1 = $con->query($sql1);
if($res1)
{

	$lastId = $con->insert_id;
	addSubcat($lastId, $con, $msg1, $e);
}
else
{

echo "<script type='text/javascript'>alert('$msg2');
window.location.href='addproject.php';</script>";
}

}//END if ctrverify = 0
else
{
$msg3 = "PROJECT ALREADY EXIST.";
echo "<script type='text/javascript'>alert('$msg3');
window.location.href='addproject.php';</script>";
}
}

function addSubcat($lastId,$con, $msg1, $admin){
	$sql2 = "SELECT * FROM `sms_subcat`";

	$res2 = $con->query($sql2);
	while($fetch2=$res2->fetch_assoc())
	{
		$c = $fetch2['CATID'];
		$e = $fetch2['SUBCATID'];
		$d = $fetch2['DESCRIPTION'];
		$g = $fetch2['SPECIFICATIONS'];
		$h = $fetch2['UNIT'];
		$i = $fetch2['UM'];
		$date = date("Y-m-d H:i:s");

		$sql = "INSERT INTO `sms_subsubcat` (`PROJID`, `cat1Id`, `cat2Id`, `cat3Id`, `cat4Id`, `cat5Id`, `DIGOFSPEC`,`DESCRIPTION`,`UNIT`,`UM`, `date_created`, `date_modified`,`admin_id`) VALUES
				('$lastId', '$c', '$e', 0, 0, 0,'$g', '$d','$h','$i', '$date', '$date', '$admin')";
		$res = $con->query($sql);
	}
	
	echo "<script type='text/javascript'>alert('$msg1');
	 window.location.href='addproject.php';</script>";

}
?>
