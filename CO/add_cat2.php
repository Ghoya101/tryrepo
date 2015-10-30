<?php
	include("functions.php");

    $desc = $_POST["desc"];
    $projId = $_POST["projId"];
    $items = $_POST["items"];
    $admin = $_POST["admin"];
    $response = array();
    $param = explode(".", $items);
    $cat1 = $param[0];
    $cat2 = $param[1];
    $dateCreated = date("Y-m-d H:i:s");
    $dateModified = date("Y-m-d H:i:s");

    $mainName = getMainNameById($cat1);
    insertCat2($projId, $cat1, $cat2, $desc, $dateCreated, $dateModified, $admin);
    $response = array(
        "text" => $desc,
        "mainName" => $mainName
    );

    echo jsonify($response);
?>