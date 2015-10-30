<?php
	// include("../connection/config.php");
	// $con = db_connect();
	include("functions.php");

	$var = $_GET["id"];
	$params = explode(".", $var);
	$id = $params[0];
	$id2 = $params[1];

	$mains = getMainCat3ById($id, $id2);
	$response = array();
	// $main = "Sample";
	foreach($mains as $main){
		$e = $main['cat3Id'];
		$f = $main['DESCRIPTION'];
		$id2 = $main['SUBSUBCATID'];
		$DIGOFSPEC2 = $main['DIGOFSPEC'];
		$QTY2 = $main['QTY'];
		$UNIT2 = $main['UNIT'];
		$UM2 = number_format(floatval($main['UM']), 2);
		$M2 = number_format($main['M'], 2);
		$UL2 = $main['UL'];
		$L2 = number_format($main['L'], 2);
		$AMOUNT2 = number_format($main['AMOUNT'], 2);
		$F2 = $main['F'];
		$PROFIT_AMOUNT2 = number_format($main['PROFIT_AMOUNT'], 2);

		$response[] = array(
			"e" => $e,
			"f" => $f,
			"id2" => $id2,
			"DIGOFSPEC2" => $DIGOFSPEC2,
			"QTY2" => $QTY2,
			"UNIT2" => $UNIT2,
			"UM2" => $UM2,
			"M2" => $M2,
			"UL2" => $UL2,
			"L2" => $L2,
			"AMOUNT2" => $AMOUNT2,
			"F2" => $F2,
			"PROFIT_AMOUNT2" => $PROFIT_AMOUNT2
		);
	}
	
	echo jsonify($response);
?>