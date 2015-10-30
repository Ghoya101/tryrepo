<?php
	include("functions.php");
    $desc = $_POST["desc"];
    $items = $_POST["items"];
    $projId = $_POST["projId"];
    $admin = $_POST["admin"];
    $response = array();
    $param = explode(".", $items);
    $id1 = $param[0];
    $id2 = $param[1];
    $id3 = $param[2];
    $dateCreated = date("Y-m-d H:i:s");
    $dateModified = date("Y-m-d H:i:s");

    insertCat3($projId, $id1, $id2, $id3, $desc, $dateCreated, $dateModified, $admin);
    $mainName = getCat2Name($id1, $id2, $projId);

    $response = array(
        "text" => $desc,
        "mainName" => $mainName
    );

    echo jsonify($response);
?>