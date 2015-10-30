<?php
	include("functions.php");

	$id = $_GET["id"];
    $param = explode(".", $id);
    $cat1 = $param[0];
    $cat2 = $param[1];
    $projId = $param[2];

    $x = getCat2($cat1, $cat2, $projId);
    $y = getLastIdCat2($cat1, $cat2, $projId);
    $check = checkCat3ForCat2($cat1, $cat2, $projId);

    if($check){
        foreach($x as $data){
            $response = array(
                "id" => $data->SUBSUBCATID,
                "main" => $data->PROJID,
                "name" => $data->DESCRIPTION,
                "cat2" => $data->cat2Id,
                "cat3" => $data->cat3Id,
                "cat4" => $data->cat4Id,
                "cat5" => $data->cat5Id,
                "lastId" => $y
            );
        }
    }else{
       $response = array(
            "id" => $cat1,
            "main" => $cat1,
            "name" => "0",
            "cat2" => $cat2,
            "cat3" => "0",
            "cat4" => "0",
            "cat5" => "0",
            "lastId" => $y
        ); 
    }
    
    echo jsonify($response);
?>