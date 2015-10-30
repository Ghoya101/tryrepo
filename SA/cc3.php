<?php
include("nav.php");
$conn = db_connect();
$submit = $_GET['Submit'];
if(!isset($_GET['chk1']))
{
		echo 	"<script>
				alert('NO PROJECT HAS BEEN CHECKED.');
				window.location.href='projects.php';
				</script>";

}
else
{
?>
<link rel="stylesheet" href="../css/cc.css">	
<body>
<?php
/* Code for Delete */
if($submit == 'DELETE')
{ 
?>

<!--Form of Deletion-->

<form class="form-content" method = "GET" action="deleteproject.php">


<table class="tbl_admin1">
<tr><th colspan=3><H3>Are you sure you want to delete the following project?</H3></th></tr>
<tr>
<th class="tbl_th1">PROJECT ID</th>
<th class="tbl_th1">CLIENT</th>
<th class="tbl_th1">PRODUCT</th>
<th class="tbl_th1">LEVEL</th>
<th class="tbl_th1">SITE LOCATION</th>
</tr>
<?php
/*confirm deletion*/
	$ID = $_GET['chk1'];
	$index = 0;
	foreach($ID as $value) 
	{
	
    $ID[$index] = $value;
	$index++;
	}
	$ctr = 0;
	For($x=0; $x<$index; $x++)
	{

	$sql = "SELECT * FROM `sms_projects` a inner join `sms_clients` b ON a.CID =b.CID
			inner join `sms_prod` c ON a.PRODID = c.prodid 
			inner join `sms_levelno` d ON a.TYPEID = d.LVLID WHERE a.PROJID ='$ID[$x]'";
	$result = $conn->query($sql);
		While($value = $result->fetch_assoc())
		{
			$PROJ[$ctr] = $value['PROJID'];
			$CLIENT[$ctr] = $value['SURNAME'] .', '. $value['FIRSTNAME'];
			$SITE[$ctr] = $value['PROPERTYADD'];
			$PROD[$ctr] = $value['desc'];
			$TYPE[$ctr] = $value['DESCRIPTION'];
?>
	<!--rows -->
	<tr style="border-top: 1px solid #E1E1E1;">
		<input type="hidden" name="chk1[]" value="<?php echo $PROJ[$ctr];?>">
		<td class="accnum1"><?php echo $PROJ[$ctr];  ?>  	</td>
		<td class="title1"><?php echo $CLIENT[$ctr]; ?>   	</td>
		<td class="title1"><?php echo $PROD[$ctr]; ?>   	</td>	
		<td class="title1"><?php echo $TYPE[$ctr]; ?>   	</td>	
		<td class="title1"><?php echo $SITE[$ctr]; ?>   	</td>		
	</tr>
<?php
		
		}
	$ctr++;
	}
?>
</table>

<div style="margin-top:1%;margin-bottom: 2%;">
<input style="float:left;" class="rc-button rc-button-submit" type="button" name="Submit" value="CANCEL" Onclick="window.location.href='projects.php'">
<input style="float:left;" class="rc-button rc-button-submit" type="submit" name="cmdDelete" value="DELETE">
</div><br>
</form>
<?php
}
//CLOSE PROJECTS
else 
if($submit == 'CLOSE PROJECT')
{
?>
<form class="form-content" method = "GET" action="closeproject.php">
<table class="tbl_admin1">
<tr><th colspan=3><H3>Are you sure you want to close the following project?</H3></th></tr>
<tr>
<th class="tbl_th1">PROJECT ID</th>
<th class="tbl_th1">CLIENT</th>
<th class="tbl_th1">PRODUCT</th>
<th class="tbl_th1">LEVEL</th>
<th class="tbl_th1">SITE LOCATION</th>
</tr>
<?php
/*confirm deletion*/
	$ID = $_GET['chk1'];
	$index = 0;
	foreach($ID as $value) 
	{
	
    $ID[$index] = $value;
	$index++;
	}
	$ctr = 0;
	For($x=0; $x<$index; $x++)
	{

	$sql = "SELECT * FROM `sms_projects` a inner join `sms_clients` b ON a.CID =b.CID
			inner join `sms_prod` c ON a.PRODID = c.prodid 
			inner join `sms_levelno` d ON a.TYPEID = d.LVLID WHERE a.PROJID ='$ID[$x]'";
	$result = $conn->query($sql);
		While($value = $result->fetch_assoc())
		{
			$PROJ[$ctr] = $value['PROJID'];
			$CLIENT[$ctr] = $value['SURNAME'] .', '. $value['FIRSTNAME'];
			$SITE[$ctr] = $value['LOCATION'];
			$PROD[$ctr] = $value['desc'];
			$TYPE[$ctr] = $value['DESCRIPTION'];
?>
	<!--rows -->
	<tr style="border-top: 1px solid #E1E1E1;">
		<input type="hidden" name="chk1[]" value="<?php echo $PROJ[$ctr];?>">
		<td class="accnum1"><?php echo $PROJ[$ctr];  ?>  	</td>
		<td class="title1"><?php echo $CLIENT[$ctr]; ?>   	</td>
		<td class="title1"><?php echo $PROD[$ctr]; ?>   	</td>	
		<td class="title1"><?php echo $TYPE[$ctr]; ?>   	</td>	
		<td class="title1"><?php echo $SITE[$ctr]; ?>   	</td>		
	</tr>
<?php
		
		}
	$ctr++;
	}
?>
</table>

<div style="margin-top:1%;margin-bottom: 2%;">
<input style="float:left;" class="rc-button rc-button-submit" type="button" name="Submit" value="CANCEL" Onclick="window.location.href='projects.php'">
<input style="float:left;" class="rc-button rc-button-submit" type="submit" name="cmdclose" value="CLOSE">
</div><br>
</form>
<?php
}
}

?>