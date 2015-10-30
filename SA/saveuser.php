<?php
include("nav.php");
$con= db_connect();

$id 	= $_GET['empid'];
$sn 	= $_GET['SNAME'];
$fn 	= $_GET['FNAME'];
$un 	= $_GET['UNAME'];
$pw 	= $_GET['PWD'];
if($pw == '')
{
$sql1 = "UPDATE `sms_admin` SET `EMPSURNAME`='$sn',`EMPNAME`='$fn',`USERNAME`= '$un' WHERE `EMPID` = '$id' ;";
}
else{

$sql1 = "UPDATE `sms_admin` SET `EMPSURNAME`='$sn',`EMPNAME`='$fn',`USERNAME`= '$un',`PASSWORD`= '$pw' WHERE `EMPID` = '$id' ;";
}
$res1 = $con->query($sql1);
if($res1)
{
$message = "CHANGES HAVE BEEN SAVED.";
echo "<script type='text/javascript'>alert('$message');
window.location.href='user-controls.php';</script>";
}
else
{
$message = "UPATE FAILED.";
echo "<script type='text/javascript'>alert('$message');
window.location.href='user-controls.php';</script>";
}
?>
