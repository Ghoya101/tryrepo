<?php
	// include("functions.php");
    // $con = mysqli_connect("localhost","root","","db_sms");
	include("../connection/config.php");
    date_default_timezone_set("Asia/Manila");
	$con = db_connect();
    $column = $_POST["column"];
    $id = $_POST["id"];
    $admin = $_POST["admin"];
    $newValue = mysql_real_escape_string($_POST["newValue"]);
    $dateModified = date("Y-m-d H:i:s");

    $query = mysqli_query($con, "UPDATE sms_subsubcat SET `$column` = '$newValue', `date_modified` = '$dateModified', `admin_id` = '$admin' WHERE SUBSUBCATID = '$id'");
?>