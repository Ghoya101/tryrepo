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
$sql = "DELETE FROM `sms_projects` WHERE PROJID = '$ID[$x]'";
$result = $conn->query($sql);
 
}
	If($result)
	{
		$message = "PROJECT/S DELETED.";
		echo "<script type='text/javascript'>alert('$message');
		window.location.href='projects.php';</script>";
	}
	else
	{
		$message = "PROJECT/S FAILED TO DELETE.";
		echo "<script type='text/javascript'>alert('$message');
		window.location.href='projects.php';</script>";
	}

?>