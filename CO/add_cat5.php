<?php
	include("functions.php");
    $desc = $_POST["desc"];
    $admin = $_POST["admin"];
    $items = $_POST["items"];
    $projId = $_POST["projId"];
    $response = array();
    $param = explode(".", $items);
    $id1 = $param[0];
    $id2 = $param[1];
    $id3 = $param[2];
    $id4 = $param[3];
    $id5= $param[4];
    $dateCreated = date("Y-m-d H:i:s");
    $dateModified = date("Y-m-d H:i:s");

    insertCat5($projId, $id1, $id2, $id3, $id4, $id5, $desc, $dateCreated, $dateModified, $admin);
    $mainName = getCat4Name($id1, $id2, $id3, $id4, $projId);

    $response = array(
        "text" => $desc,
        "mainName" => $mainName
    );

    echo jsonify($response);
?>