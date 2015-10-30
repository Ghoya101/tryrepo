<?php
	include("functions.php");
    $id = $_GET["id"];
    $param = explode(".", $id);
    $id1 = $param[0];
    $id2 = $param[1];
    $id3 = $param[2];
    $projId = $param[3];

    $x = getCat3($id1, $id2, $id3, $projId);
    $y = getLastIdCat3($id1, $id2, $id3, $projId);
    $check = checkCat4ForCat3($id1, $id2, $id3, $projId);

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
                "lastId" => "$y"
            );
        }
    }else{
       $response = array(
            "id" => $id1,
            "main" => $id1,
            "name" => "0",
            "cat2" => $id2,
            "cat3" => $id3,
            "cat4" => "0",
            "cat5" => "0",
            "lastId" => "$y"
        ); 
    }
    
    echo jsonify($response);
?>