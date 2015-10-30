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

		echo "<script>
				localStorage.setItem('admin', $empid);
			</script>";
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
	<script type="text/javascript" src="../lib/date_time.js"></script>

	
	<script>
		$(function() {
			var pull 		= $('#pull');
				menu 		= $('nav ul');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});
	</script>
	
</head>

<nav class="clearfix">
    <ul class="clearfix">
        <li><a href="index.php"			>INBOX</a></li>
        <li><a href="new_projects.php"	>PROJECTS</a></li>
		<li><a href="inventory.php"		>INVENTORY</a></li>
		<!--<li><a href="sites.php"		>SITES</a></li>-->
		<li><a href="../logout.php"		>LOGOUT</a></li>
	</ul>
    <a href="#" id="pull">Menu</a>
</nav>
<br>
<table width='100%' style="margin-left:1%;margin-right:1%;" class="user"><tr><td><?php echo 'Hi! '.$NAME;?></td><td><span style="float:right;margin-right:3%;" id="date_time"></span>
            <script type="text/javascript">window.onload = date_time('date_time');</script></td></tr></table>
<hr>

