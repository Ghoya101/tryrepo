<?php
	include("functions.php");
    $id = $_GET["id"];
    $param = explode(".", $id);
    $id1 = $param[0];
    $id2 = $param[1];
    $id3 = $param[2];
    $id4 = $param[3];
    $projId = $param[4];

    $x = getCat4($id1, $id2, $id3, $id4, $projId);
    $y = getLastIdCat4($id1, $id2, $id3, $id4, $projId);
    $check = checkCat5ForCat4($id1, $id2, $id3, $id4, $projId);

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
            "cat4" => $id4,
            "cat5" => "0",
            "lastId" => "$y"
        ); 
    }
    
    echo jsonify($response);
?>