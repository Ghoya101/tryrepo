<?php
	include("functions.php");

	$main = $_POST["mainName"];

	
	$check = checkCategory($main);
	if($check){
		$response = array(
			"prompt" => 1
		);
	}else{
		$ids = addCostCategory($main);
        $id = $ids["id"];

		addCostItems($id, $main);
		$response = array(
			"prompt" => 0
		);
	}

	echo jsonify($response);
?>