<?php
include("nav.php");
$con = db_connect();

$po = $_GET['poid'];
$em = $_GET['emp'];
date_default_timezone_set('America/Los_Angeles');			
$NOW = date('Y-m-d h:i:s', time());

$query1 = "UPDATE sms_projpo SET STATUS = '5',RECOMMENDEDBY = '$em', RECDATE = '$NOW' WHERE POID ='$po' ;";
$run1 = $con->query($query1);
if($run1)
{
echo "<script>
			alert('PO HAS BEEN RECOMMENDED.');
			window.location.href='index.php';
			</script>";
}else
{
echo "<script>
			alert('RECOMMENDATION ERROR.');
			window.location.href='index.php';
			</script>";
}
?>