<?php include('../connection/config.php');?>
<script type="text/javascript" >


</script>

<?php
date_default_timezone_set('America/Los_Angeles');			
$date = date('m/d/Y h:i:s a', time());
echo $date;
?>

	<script type="text/javascript" src="../lib/date_time.js"></script>
<table width='100%' style="margin-left:1%;margin-right:1%;" class="user"><tr><td><?php echo 'Hi! ';?></td><td><span style="float:right;margin-right:3%;" id="date_time"></span>
            <script type="text/javascript">window.onload = date_time('date_time');</script></td></tr></table>

<?php
echo "Current timezone: ".date_default_timezone_get()."</ br>
      Current time: ".date("d-m-Y H:i:s");
	  
	  
$q = "SELECT * FROM sms_admin WHERE EMPID = 3";
$r = db_connect()->query($q);	 
while($a=$r->fetch_assoc()) 
{
$ini = ($a['EMPNAME'][0]).''.($a['EMPMID'][0]).''.($a['EMPSURNAME'][0]);
echo "ADMIN IS ".$ini;
}

$po = '1 - 18';
$q2 = "SELECT sum(PCOTOTAL) as ey FROM `sms_pocontent` WHERE POID = '$po'";
$r2 = db_connect()->query($q2);	 
WHILE($re=$r2->fetch_assoc())
echo 'TOTAL IS '.$re['ey'];





?>


