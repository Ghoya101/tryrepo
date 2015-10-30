<?php
	include("functions.php");

	$data = $_GET["id"];
	$params = explode(".", $data);
	$id = $params[0];
	$projId = $params[1];
	$main = getCat1($id, $projId);
	$lastId = getLastIdCat1($id, $projId);
	// $main = "Sample";
	if($main){
		$response = array(
			"main" => $id,
			"id" => $main["cat1Id"],
			"desc" => $main["DESCRIPTION"],
			"lastId" => $lastId
		);
	}else{
		$response = array(
			"main" => $id,
			"id" => 0,
			"desc" => "",
			"lastId" => $lastId
		);
	}
	
	echo jsonify($response);
?>