<?php
include("../connection/config.php");
$con = db_connect();	

session_start();
if(isset($_SESSION['curuser']))
{
	$EMP = $_SESSION['curuser'];
	$sql = "SELECT * FROM `sms_admin` WHERE EMPID = '$EMP';";
	$res = $con->query($sql);
	$ctr = $res->num_rows;
	while($fet = $res->fetch_assoc())
	{
		$empid = $fet['EMPID'];
		$emps = $fet['EMPSURNAME'];
		$empf = $fet['EMPNAME'];
		$empm = $fet['EMPMID'];
		$NAME = $fet['EMPNAME'].' '.$fet['EMPSURNAME'];	

		
	}
  
}
else
{
  header("Location: warning.php");
  exit();
}
?>
<head>
	<link rel="stylesheet" href="../css/nav.css">
	<link rel="stylesheet" href="bootstrap.min.css">
	<script src="jquery.min.js"></script>
	<script src="bootstrap.min.js"></script>
	<link type="text/css" rel="stylesheet" href="js/jquery.dataTables.min.css">
	<link type="text/css" rel="stylesheet" href="js/index.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/mindmup-editabletable.js"></script>
	<script type="text/javascript" src="js/numeric-input-example.js"></script>
	<script type="text/javascript" src="fnSortNeutral.js"></script>
	<script type="text/javascript" src="../lib/date_time.js"></script>

	
</head>

<nav class="clearfix">
    <ul class="clearfix">
        <li><a href="index.php"			>INBOX</a></li>
        <li><a href="project.php"		>PROJECTS</a></li>
        <li><a href="projects.php"		>ACCOUNT</a></li>
		<li><a href="../logout.php"		>LOGOUT</a></li>
	</ul>
    <a href="#" id="pull">Menu</a>
</nav>
<br>
<table width='100%' style="margin-left:1%;margin-right:1%;" class="user"><tr><td><?php echo 'Hi! '.$NAME;?></td><td><span style="float:right;margin-right:3%;" id="date_time"></span>
<script type="text/javascript">window.onload = date_time('date_time');</script></td></tr></table>
<hr>


