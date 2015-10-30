<?php
	// include("../connection/config.php");
	// $con = db_connect();
	include("functions.php");

	$var = $_GET["id"];
	$params = explode(".", $var);
	$id = $params[0];
	$id2 = $params[1];
	$id3 = $params[2];
	$id4 = $params[3];

	$mains = getMainCat5ById($id, $id2, $id3, $id4);
	$response = array();
	// $main = "Sample";
	foreach($mains as $main){
		$i = $main['cat5Id'];
		$j = $main['DESCRIPTION'];
		$id4 = $main['SUBSUBCATID'];
		$DIGOFSPEC4 = $main['DIGOFSPEC'];
		$QTY4 = $main['QTY'];
		$UNIT4 = $main['UNIT'];
		$UM4 = number_format(floatval($main['UM']), 2);
		$M4 = number_format($main['M'], 2);
		$UL4 = $main['UL'];
		$L4 = number_format($main['L'], 2);
		$AMOUNT4 = number_format($main['AMOUNT'], 2);
		$F4 = $main['F'];
		$PROFIT_AMOUNT4 = number_format($main['PROFIT_AMOUNT'], 2);

		$response[] = array(
			"g" => $g,
			"h" => $h,
			"id4" => $id4,
			"DIGOFSPEC4" => $DIGOFSPEC4,
			"QTY4" => $QTY4,
			"UNIT4" => $UNIT4,
			"UM4" => $UM4,
			"M4" => $M4,
			"UL4" => $UL4,
			"L4" => $L4,
			"AMOUNT4" => $AMOUNT4,
			"F4" => $F4,
			"PROFIT_AMOUNT4" => $PROFIT_AMOUNT4
		);
	}
	
	echo jsonify($response);
?>