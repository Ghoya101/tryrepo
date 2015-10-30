<?php
include("nav.php");
$con = db_connect();

$po = $_GET['poid'];
$query1 = "UPDATE sms_projpo SET STATUS = '5' WHERE POID ='$po' ;";
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