<?php
	// include("../connection/config.php");
	include("functions.php");
	$con = db_connect();

	$id = $_GET["id"];
	$main = getProjDetailsbyId($id);
	// $main = "Sample";
	if($main){
		$response = array(
			"sname" => $main["SURNAME"],
			"fname" => $main["FIRSTNAME"],
			"name" => $main["SURNAME"] .','. $main["FIRSTNAME"],
			"prod" => $main["desc1"],
			"site" => utf8_decode($main["site"]),
			"lvl" => $main["desc2"],
			"ef" => $main["ef"],
			"count" => $main["count"]
		);
		$ef = $main["ef"];

		$query = ("UPDATE sms_subsubcat SET M=REPLACE(QTY, ',', '')*REPLACE(UM, ',', '')");
	    $query1 = ("UPDATE sms_subsubcat SET L=REPLACE(QTY, ',', '')*REPLACE(UL, ',', '')");
	    $query2 = ("UPDATE sms_subsubcat SET AMOUNT=REPLACE(M, ',', '')+REPLACE(L, ',', '')");
	    $query3 = ("UPDATE sms_subsubcat SET PROFIT_AMOUNT=REPLACE(AMOUNT, ',', '')*$ef");
	    $queryy = $con->query($query);
		$queryy1 = $con->query($query1);
		$queryy2 = $con->query($query2);
		$queryy3 = $con->query($query3);
	}
	
	echo jsonify($response);
?>