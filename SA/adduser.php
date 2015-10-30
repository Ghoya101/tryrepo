<?php
include("nav.php");
$con = db_connect();

$sql1 = "SELECT * FROM `sms_admintype`;";
$res1 = $con->query($sql1);

?>
<center>
<form class="form-content" method = "GET" action="adduser.php">
<H3 style="text-align: left;" class="h2-style">Please fill in all the fields.</H3>
<div style="margin:1%;">

<Select name="adminlevel" class="dd-admin">
<?php
while($fet1 = $res1->fetch_assoc())
		{
			$a = $fet1['ADMINID'];
			$b = $fet1['DESCRIPTION'];

?>
			<option value="<?php echo $a;?>"><?php echo $b;?></option>	
<?php 	}?>
</select>
<input placeholder="EMPLOYEE SURNAME" 	type="text" 	name="SNAME" 	class="dd-admin">
<input placeholder="EMPLOYEE FIRSTNAME" type="text" 	name="FNAME" 	class="dd-admin">
<input placeholder="USERNAME" 			type="text" 	name="UNAME" 	class="dd-admin">
<input placeholder="TEMPORARY PASSWORD" type="text" 	name="PWD" 		class="dd-admin">
<input style="width: 5%;" 				type="submit" 	name="btn1" 	class="rc-button rc-button-submit"   value="ADD">

</div>

<div style="background: black;color: white;">

<?php
if ( isset( $_GET['btn1'] ) )
{

	$c = $_GET['adminlevel'];
	$d = $_GET['SNAME'];
	$e = $_GET['FNAME'];
	$f = $_GET['UNAME'];
	$g = $_GET['PWD'];	
	$h = sha1($g);	
	
	//echo $c .' '. $d .' '. $e .' '. $f .' '. sha1($g);
	$sql2 = "INSERT INTO `sms_admin`(`ADMINID`,`EMPSURNAME`,`EMPNAME`,`USERNAME`,`PASSWORD`)
			 VALUES ('$c','$d','$e','$f','$h') ";
	$res2 = $con->query($sql2);
	
	if($res2)
	{ 
		$sql3 = "SELECT * FROM `sms_admin`;";
		$res3 = $con->query($sql3);
		while($fet3=$res3->fetch_assoc())
		{
			$i = $fet3['ADMINID'];
			$j = $fet3['EMPSURNAME'];
			$k = $fet3['PASSWORD'];
			echo $i .'. '. $j .' '. $k ;
			echo '<br>';
		}
	}
	else
	{
		echo "Adding failed."; 
	}
}
else
{
	echo "add user";
	
}

?>
</div>




</form>
</center>