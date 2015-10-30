<?php
	include("functions.php");

    $projId = $_POST["projId"];
    $data = $_POST["data"];
    $response = array();
    
    // $check = checkFByProjId($projId);
    // if($check){
    //     //update
    // }else{
    //     //add
        addFByProjId($projId, $data);
    // }
    echo jsonify($response);
?>