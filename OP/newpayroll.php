<?php
include("nav.php");
$con = db_connect();
$EMP = $empid;


$query1 = "SELECT * FROM `sms_clients` a inner join `sms_projects` b ON a.CID = b.CID WHERE b.PROJID = '$proj';";
$run1	= $con->query($query1);
while($a = $run1->fetch_assoc()){$client = $a['SURNAME']; $ctr = intval($a['PAYROLLCTR'])+1	;}
$PAYROLLID = 'PAYROLL '.$proj.' - '.$ctr ;


?>
<link rel="stylesheet" href="../css/new_payroll.css">
<form>


</form>