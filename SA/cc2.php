<?php
include("nav.php");
$conn= db_connect();

$proj = $_POST['proj'];
$c = $_POST['product'];
$d = $_POST['level'];
$f = $_POST['pur'];
$g = $_POST['engr'];
$h = $_POST['amount'];
date_default_timezone_set('America/Los_Angeles');
$now= date('Y-m-d');

$sql1 = "UPDATE `sms_projects` SET `PRODID`='$c',`TYPEID`='$d',
`PURCHASINGID`= '$f',`OPERATIONSID`= '$g',`CONTRACTAMOUNT`= '$h', `DATEMODIFIED` = '$now'
WHERE PROJID = '$proj' ;";
$res1 = $conn->query($sql1);
if($res1)
{
$message = "CHANGES HAVE BEEN SAVED.";
echo "<script type='text/javascript'>alert('$message');
window.location.href='projects.php';</script>";
}
else
{
$message = "UPATE FAILED.";
echo "<script type='text/javascript'>alert('$message');
window.location.href='projects.php';</script>";
}
?>
