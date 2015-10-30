<?php
	include("functions.php");

	$data = $_POST["data"];
	$param = explode(".", $data);
	$projId = $param[0];
	$subId = $param[1];
	$s_digOfSpec = $_POST["s_digOfSpec"];
	$s_Qty = $_POST["s_Qty"];
	$s_Unit = $_POST["s_Unit"];
	$s_Um = $_POST["s_Um"];
	// $s_M = $_POST["s_M"];
	$s_Ul = $_POST["s_Ul"];
	$s_Amount2 = $_POST["s_Amount2"];

	$s_M = $s_Qty * $s_Um;
	$s_L = $s_Qty * $s_Ul;
	$s_Amount1 = $s_M * $s_L;

	// $main = "Sample";
	
	addItems($projId,$subId,$s_digOfSpec,$s_Qty,$s_Unit,$s_Um,$s_M,$s_Ul,$s_L,$s_Amount1,$s_Amount2);
	echo jsonify($response);
?>