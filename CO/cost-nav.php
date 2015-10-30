<?php
// include("header.php");
include("../connection/config.php");
$con = db_connect();	

session_start();
if(isset($_SESSION['curuser']))
{
  $username = $_SESSION['curuser'];
  $sql = "SELECT * FROM `sms_admin` WHERE `USERNAME` = '$username';";
  $res = $con->query($sql);
  $ctr = $res->num_rows;
  if ($ctr = 1)
  {
	while($fet = $res->fetch_assoc())
	{
		$empid = $fet['EMPID'];
		$emps = $fet['EMPSURNAME'];
		$empf = $fet['EMPNAME'];
		// $empm = $fet['EMPMID'];

		echo "<script>
				localStorage.setItem('admin', $empid);
			</script>";
	}
  }
}
// else
// {
//   header("Location: warning.php");
//   exit();
// }
?>
<head>
	<link rel="stylesheet" href="../css/nav.css">
	<!-- <link rel="stylesheet" href="../css/sa-nav.css"> -->
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

	<style type="text/css">
		#message{
			display:none;
			font:Tahoma, Geneva, sans-serif;
			font-size:18px;
			color:#ccc;
			text-align:center;
			width:150px;
			border:1px solid #ccc;
			background:#000;
			position:absolute;
			left:45%;
			top:16%;
			padding:10px;
			opacity:.5;
			border-radius:5px;
		}
		.keme{
			/*display:none;*/
			font:Tahoma, Geneva, sans-serif;
			font-size:13px;
			color:#00000;
			width:22%;
			position:relative;
			float: right;
		}
	</style>
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
	<script type="text/javascript" src="app.js"></script>
</head>

<nav class="clearfix">
    <ul class="clearfix">
        <li><a href="costing.php"	>COSTING</a></li>
        <li><a href="po.php"		>PURCHASING</a></li>
		<li><a href="warehouse.php"	>WAREHOUSE</a></li>
		<li><a href="sites.php"		>SITES</a></li>
		<li><a href="../logout.php"	>LOGOUT</a></li>
	</ul>
    <a href="#" id="pull">Menu</a>
</nav>

<div id="message">Updated...</div>

<!-- <div id="forData"></div> -->


<div class="container">
	  <!-- Modal -->
	<div class="modal fade" id="modalMain" role="dialog">
	    <div class="modal-dialog">
	    	<form role="form" id="frmCat2">
	      		<!-- Modal content-->
	      		<div class="modal-content">
	        		<div class="modal-header">
	          			<button type="button" class="close" data-dismiss="modal">&times;</button>
	          			<h4 class="modal-title" id="mainCount"></h4>
	        		</div>
	        		<div class="modal-body">
	          			<div class="form-group">
			      			<label>Description:</label>
			      			<input type="text" class="form-control" id="cat2Desc" name="cat2Desc" placeholder="Description">
			    		</div>
	        		</div>
	        		<div class="modal-footer">
	          			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	          			<input type="submit" class="btn btn-primary" value="Add Item"/>
	        		</div>
	      		</div>
	    	</form>
	    </div>
	</div>

	<div class="modal fade" id="modalcat3" role="dialog">
	    <div class="modal-dialog">
	    	<form role="form" id="frmCat3">
	      		<!-- Modal content-->
	      		<div class="modal-content">
	        		<div class="modal-header">
	          			<button type="button" class="close" data-dismiss="modal">&times;</button>
	          			<h4 class="modal-title" id="cat2Count"></h4>
	        		</div>
	        		<div class="modal-body">
	          			<div class="form-group">
			      			<label>Description:</label>
			      			<input type="text" class="form-control" id="cat3Desc" name="cat3Desc" placeholder="Description">
			    		</div>
	        		</div>
	        		<div class="modal-footer">
	          			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	          			<input type="submit" class="btn btn-primary" value="Add Item"/>
	        		</div>
	      		</div>
	    	</form>
	    </div>
	</div>

	<div class="modal fade" id="modalcat4" role="dialog">
	    <div class="modal-dialog">
	    	<form role="form" id="frmCat4">
	      		<!-- Modal content-->
	      		<div class="modal-content">
	        		<div class="modal-header">
	          			<button type="button" class="close" data-dismiss="modal">&times;</button>
	          			<h4 class="modal-title" id="cat3Count"></h4>
	        		</div>
	        		<div class="modal-body">
	          			<div class="form-group">
			      			<label>Description:</label>
			      			<input type="text" class="form-control" id="cat4Desc" name="cat4Desc" placeholder="Description">
			    		</div>
	        		</div>
	        		<div class="modal-footer">
	          			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	          			<input type="submit" class="btn btn-primary" value="Add Item"/>
	        		</div>
	      		</div>
	    	</form>
	    </div>
	</div>

	<div class="modal fade" id="modalcat5" role="dialog">
	    <div class="modal-dialog">
	    	<form role="form" id="frmCat5">
	      		<!-- Modal content-->
	      		<div class="modal-content">
	        		<div class="modal-header">
	          			<button type="button" class="close" data-dismiss="modal">&times;</button>
	          			<h4 class="modal-title" id="cat4Count"></h4>
	        		</div>
	        		<div class="modal-body">
	          			<div class="form-group">
			      			<label>Description:</label>
			      			<input type="text" class="form-control" id="cat5Desc" name="cat5Desc" placeholder="Description">
			    		</div>
	        		</div>
	        		<div class="modal-footer">
	          			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	          			<input type="submit" class="btn btn-primary" value="Add Item"/>
	        		</div>
	      		</div>
	    	</form>
	    </div>
	</div>

	<div class="modal fade" id="addMain" role="dialog">
	    <div class="modal-dialog">
	    	<form role="form" id="formMain">
	      		<!-- Modal content-->
	      		<div class="modal-content">
	        		<div class="modal-header">
	          			<button type="button" class="close" data-dismiss="modal">&times;</button>
	          			<h4 class="modal-title">Add Another Main Category</h4>
	        		</div>
	        		<div class="modal-body">
	          			<div class="form-group">
			      			<label>Item Name:</label>
			      			<input type="text" class="form-control" id="mainScope" name="mainScope" placeholder="Name">
			    		</div>
	        		</div>
	        		<div class="modal-footer">
	          			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	          			<input type="submit" class="btn btn-primary" value="Add Item"/>
	        		</div>
	      		</div>
	    	</form>
	    </div>
	</div>
</div>

