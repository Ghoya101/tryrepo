<?php
	include("functions.php");
    $desc = $_POST["desc"];
    $items = $_POST["items"];
    $admin = $_POST["admin"];
    $projId = $_POST["projId"];
    $response = array();
    $param = explode(".", $items);
    $id1 = $param[0];
    $id2 = $param[1];
    $id3 = $param[2];
    $id4 = $param[3];
    $dateCreated = date("Y-m-d H:i:s");
    $dateModified = date("Y-m-d H:i:s");

    insertCat4($projId, $id1, $id2, $id3, $id4, $desc, $dateCreated, $dateModified, $admin);
    $mainName = getCat3Name($id1, $id2, $id3, $projId);

    $response = array(
        "text" => $desc,
        "mainName" => $mainName
    );

    echo jsonify($response);
?>