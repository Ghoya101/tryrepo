<?php
include("../connection/config.php");
$con=db_connect();
date_default_timezone_set('America/Los_Angeles');
$now = date("Y-m-d h:i:s A");

session_start();
if(isset($_SESSION['curuser']))
{
  $EMP = $_SESSION['curuser'];
  $sql = "SELECT * FROM `sms_admin` WHERE EMPID = '$EMP';";
  $res = $con->query($sql);
  $ctr = $res->num_rows;
  
	while($fet = $res->fetch_assoc())
	{
		$NAME = $fet['EMPNAME'].' '.$fet['EMPSURNAME'];	
		$empid = $fet['EMPID'];
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
<link rel="stylesheet" href="../css/sa.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
        <li><a href="index.php"				>Home</a></li>
        <li><a href="clientlist.php"		>Clients</a></li>
        <li><a href="projects.php"			>Projects</a></li>
		<li><a href="user-controls.php"		>Accounts</a></li>
		<li><a href="../logout.php"			>Logout</a></li>	
    </ul>
    <a href="#" id="pull">Menu</a>
</nav>
<br>
<table class="user"><tr><td><?php echo 'Hi! '.$NAME;?></td><td><span style="float:right;" id="date_time"></span>
            <script type="text/javascript">window.onload = date_time('date_time');</script></td></tr></table>
<hr>
