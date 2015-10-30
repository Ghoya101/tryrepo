<?php 
$con = db_connect();	


function listproj()
{
$query 	= "SELECT * FROM `sms_projects` a inner join `sms_clients` b ON a.CID = b.CID;";
$result = db_connect()->query($query);
$count 	= $result->num_rows;
if($count == 0)
{
while($a = $result->fetch_assOc())
{
	echo $CLIENT = $a['FIRSTNAME'].' '.$a['SURNAME'];
}
}
	


} 
?>