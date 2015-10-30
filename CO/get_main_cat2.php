<?php
	// include("../connection/config.php");
	// $con = db_connect();
	include("functions.php");

	$id = $_GET["id"];
	$mains = getMainCat2ById($id);
	// $main = "Sample";
	foreach($mains as $main){
		$c = $main['cat2Id'];
		$d = $main['DESCRIPTION'];
		$id1 = $main['SUBSUBCATID'];
		$DIGOFSPEC1 = $main['DIGOFSPEC'];
		$QTY1 = $main['QTY'];
		$UNIT1 = $main['UNIT'];
		$UM1 = number_format(floatval($main['UM']), 2);
		$M1 = number_format($main['M'], 2);
		$UL1 = $main['UL'];
		$L1 = number_format($main['L'], 2);
		$AMOUNT1 = number_format($main['AMOUNT'], 2);
		$F1 = $main['F'];
		$PROFIT_AMOUNT1 = number_format($main['PROFIT_AMOUNT'], 2);

		$response[] = array(
			"c" => $c,
			"d" => $d,
			"id1" => $id1,
			"DIGOFSPEC1" => $DIGOFSPEC1,
			"QTY1" => $QTY1,
			"UNIT1" => $UNIT1,
			"UM1" => $UM1,
			"M1" => $M1,
			"UL1" => $UL1,
			"L1" => $L1,
			"AMOUNT1" => $AMOUNT1,
			"F1" => $F1,
			"PROFIT_AMOUNT1" => $PROFIT_AMOUNT1
		);
	}
	
	echo jsonify($response);
?>