<?php
	include("functions.php");

	$mains = getMainCat();
	
	foreach($mains as $main){
		$response[] = array(
			"a" => $main->cat,
			"b" => $main->cdesc
		);
	}
	
	echo jsonify($response);
?>