<?php
	include("../connection/config.php");
	$con = db_connect();
	include("functions.php");
	$id = $_GET["id"];
	// $res = getSumPerCat($id);
    $calc = "SELECT SUM(PROFIT_AMOUNT) as tot FROM sms_subsubcat WHERE PROJID = $id";
    $resCalc = $con->query($calc);
	while($fetchCalc=$resCalc->fetch_assoc())
	{
		$result =number_format(floatval($fetchCalc['tot']), 2);
		$response = array(
			"result" => $result
		);
	}
	// print_r($res);
		
	echo jsonify($response);
?>