<?php
	include("functions.php");
    // $con = mysqli_connect("localhost","root","","db_sms");
	// include("../connection/config.php");
    date_default_timezone_set("Asia/Manila");
	$con = db_connect();

    $dateModified = date("Y-m-d H:i:s");

    $query = mysqli_query($con, "UPDATE sms_subsubcat SET M=REPLACE(QTY, ',', '')*REPLACE(UM, ',', '')");
    $query1 = mysqli_query($con, "UPDATE sms_subsubcat SET L=REPLACE(QTY, ',', '')*REPLACE(UL, ',', '')");
    $query2 = mysqli_query($con, "UPDATE sms_subsubcat SET AMOUNT=REPLACE(M, ',', '')+REPLACE(L, ',', '')");
    $query3 = mysqli_query($con, "UPDATE sms_subsubcat SET PROFIT_AMOUNT=REPLACE(AMOUNT, ',', '')*F");

    $dateMod = getLastModified();
    $dateCre = getLastCreated();
    $getLastAdmin = getLastAdmin();
    if($getLastAdmin){
    	$name = $getLastAdmin["EMPSURNAME"] . ", " . $getLastAdmin["EMPNAME"];
    }else{
    	$name = "";
    }
    $response = array(
    	"dateMod" => date("M d, Y h:i A", strtotime($dateMod)),
    	"dateCre" => date("M d, Y h:i A", strtotime($dateCre)),
    	"adminName" => $name
    );

    echo jsonify($response);
?>