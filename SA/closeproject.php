<?php
include("nav.php");
$conn = db_connect();

$ID = $_GET['chk1'];
$ctr = 0;

foreach($ID as $value) {
    $ID[$ctr] = $value;
	$ctr++;
}

for($x = 0; $x<$ctr; $x++)
{
date_default_timezone_set('America/Los_Angeles');
$now= date('Y-m-d');
$sql = "UPDATE `sms_projects` SET ENDDATE ='$now' WHERE PROJID = '$ID[$x]'";
$result = $conn->query($sql);
 
}
	If($result)
	{
		$message = "PROJECT/S SUCCESSFULLY CLOSED.";
		echo "<script type='text/javascript'>alert('$message');
		window.location.href='projects.php';</script>";
	}
	else
	{
		$message = "PROJECT/S FAILED TO CLOSE.";
		echo "<script type='text/javascript'>alert('$message');
		window.location.href='projects.php';</script>";
	}

?>