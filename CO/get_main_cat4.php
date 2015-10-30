<?php
	// include("../connection/config.php");
	// $con = db_connect();
	include("functions.php");

	$var = $_GET["id"];
	$params = explode(".", $var);
	$id = $params[0];
	$id2 = $params[1];
	$id3 = $params[2];

	$mains = getMainCat4ById($id, $id2, $id3);
	$response = array();
	// $main = "Sample";
	foreach($mains as $main){
		$g = $main['cat4Id'];
		$h = $main['DESCRIPTION'];
		$id3 = $main['SUBSUBCATID'];
		$DIGOFSPEC3 = $main['DIGOFSPEC'];
		$QTY3 = $main['QTY'];
		$UNIT3 = $main['UNIT'];
		$UM3 = number_format(floatval($main['UM']), 2);
		$M3 = number_format($main['M'], 2);
		$UL3 = $main['UL'];
		$L3 = number_format($main['L'], 2);
		$AMOUNT3 = number_format($main['AMOUNT'], 2);
		$F3 = $main['F'];
		$PROFIT_AMOUNT3 = number_format($main['PROFIT_AMOUNT'], 2);

		$response[] = array(
			"g" => $g,
			"h" => $h,
			"id3" => $id3,
			"DIGOFSPEC3" => $DIGOFSPEC3,
			"QTY3" => $QTY3,
			"UNIT3" => $UNIT3,
			"UM3" => $UM3,
			"M3" => $M3,
			"UL3" => $UL3,
			"L3" => $L3,
			"AMOUNT3" => $AMOUNT3,
			"F3" => $F3,
			"PROFIT_AMOUNT3" => $PROFIT_AMOUNT3
		);
	}
	
	echo jsonify($response);
?>