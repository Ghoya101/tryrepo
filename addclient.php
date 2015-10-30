<?php
include ("connection/config.php");
$conn = db_connect();

$SN = $_GET['SURNAME'];
$FN = $_GET['FIRSTNAME'];
$MI = $_GET['MIDINI'];
$BD = $_GET['BIRTHDATE'];
$TN = $_GET['TIN'];
$CZ = $_GET['CITIZENSHIP'];
$HA = $_GET['HOMEADD'];
$CN = $_GET['CELLNO'];
$EM = $_GET['EMAIL'];


$LA = $_GET['LANDAREA'];
$PA = $_GET['PROPERTYADD'];

$SS  = $_GET['KnowService'];
$RA  = $_GET['ReferralAgent'];
$DT  = $_GET['dateofvisit'];

if($SN!='' && $FN!='' && $HA!='' && $CN!='' && $PA!='' && $LA!='')
{

 $sqladd = "INSERT INTO `sms_clients`(`SURNAME`, `FIRSTNAME`, `MIDDLENAME`,`CITIZENSHIP`, `TIN`, `BIRTHDATE`, 
`HOMEADD`,`CELLNO`, `EMAIL`,`LANDAREA`,`PROPERTYADD`,`QUERY`,`REFERRALAGENT`,`dateofvisit`)
 VALUES ('$SN','$FN', '$MI','$CZ','$TN','$BD','$HA','$CN','$EM','$LA','$PA','$SS','$RA','$DT')";

	$result = $conn->query($sqladd);
	if($result)
	{
		    echo
        "<script type=\"text/javascript\">".
        "window.alert('Client successfully added.');".
        'window.location.href="client-info-sheet.php";'.
        "</script>";
 
	}
	else
	{
	    echo
        "<script type=\"text/javascript\">".
        "window.alert('Client sign up error.');".
        'window.location.href="client-info-sheet.php";'.
        "</script>";
	}
 
 }
 else
 {
	    echo
        "<script type=\"text/javascript\">".
        "window.alert('Please fill in required fields.');".
        'window.location.href="client-info-sheet.php";'.
        "</script>";
}


?>
