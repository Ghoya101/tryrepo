<?php
include("nav.php");
$con = db_connect();

$user = $_GET['uac'];


$btn = $_GET['cmd'];
if($btn = 'YES')
{	
	$sql3 = "DELETE FROM `sms_admin` WHERE EMPID = '$user';";
	$res3 = $con->query($sql3);
	
	if($res3)
	{
    echo
        "<script type=\"text/javascript\">".
        "window.alert('USER DELETED.');".
        'window.location.href="user-controls.php";'.
        "</script>";
	}
	else
	{
    echo
        "<script type=\"text/javascript\">".
        "window.alert('Operation failed.');".
        'window.location.href="user-controls.php";'.
        "</script>";

	}
}



?>