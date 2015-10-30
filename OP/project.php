<?php
include("nav.php");
require_once('functions.php');
$con = db_connect();
$EMP = $empid;

$query3 = "SELECT * FROM sms_projects a inner join sms_clients b ON a.CID = b.CID WHERE OPERATIONSID = '$empid' AND ENDDATE ='0000-00-00' ;";
$run3	= $con->query($query3);
$ctr3	= $run3->num_rows;



?>
<link rel="stylesheet" href="../css/oprproject.css">	

<body>
<form class="side"	>
<center>
<div class="divside">
<LABEL Class="">DATABASE</LABEL>
<input type=button class="btn" onclick="document.location.href='payroll.php';" value="PAYROLL RECORD">
<input type=button class="btn" Onclick="window.location.href='pcf.php'"  value="PCF RECORD">
</div>

<div class="divside">
<LABEL>PROJECTS</LABEL>
<?php 
if($ctr3 != 0)//4
{
	while($get3=$run3->fetch_assoc())
	{ //6
	$projclient = $get3['FIRSTNAME'][0].'.'.$get3['SURNAME'];
	$cid = $get3['PROJID'];
	?>
	<button class="btn" id="proj" STYLE="WIDTH:100%;" onclick="getproj('<?php echo $cid;?>')" ><?php echo strtoupper($projclient);?></button>
	<?php
	}//6
} //4
else
{	//5
ECHO 'NO ASSIGNED PROJECTS.';
} //5
?>
</div>
</center>
</form>



<form style="width:78%;BORDER:1PX SOLID blue;float:left;">
form
</form>





</body>


