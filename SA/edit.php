<?php
include("nav.php");
$con = db_connect();

if(!isset($_GET['user']))
{
	
	
}
else
{
$user = $_GET['user'];
}


		$sql2 = "SELECT * FROM `sms_admin` a inner join `sms_admintype` t
				 ON a.ADMINID = t.ADMINID WHERE a.EMPID	 = '$user' ;";
		$res2 = $con->query($sql2);
		while($fet2=$res2->fetch_assoc())
		{

			$a = $fet2['EMPID'];
			$b = $fet2['EMPSURNAME'];
			$c = $fet2['EMPNAME'];
			$d = $fet2['USERNAME'];


?>

<html>
<link rel="stylesheet" href="../css/cc.css">

<center>
<form class="form-content" method = "GET" action="saveuser.php">
<div style="margin: 2%">

<br>
<div style="background: black; color: white;">
<table class="tbl_admin">
<input Type=hidden 	name="empid" value="<?php echo $a;?>">

<tr class="tbl_tr">
<td  class="tbl_td">EMPLOYEE NAME</td>
<td>
<input placeholder="EMPLOYEE SURNAME" 		value="<?php echo $b;?>"	type="text" name="SNAME" class="tbl_td" style="width:100%";></td>
<td>
<input placeholder="EMPLOYEE FIRST NAME" 	value="<?php echo $c;?>"	type="text" name="FNAME" class="tbl_td" style="width:100%";></td>
</tr>

<tr class="tbl_tr">
<td  class="tbl_td">ACCOUNT CONTROL</td>
<td><input placeholder="NEW USERNAME" 		value="<?php echo $d;?>"	type="text" 	name="UNAME" 	class="tbl_td" style="width:100%";></td>
<td><input placeholder="NEW PASSWORD" 									type="text" 	name="PWD" 	class="tbl_td" style="width:100%";></td>
</tr>



<?php	}?>
</table>

</div>
<br>
<input type=submit value="SAVE" name="cmd" 	class="rc-button rc-button-submit">
<input type=button value="BACK"  name="cmd"	class="rc-button rc-button-submit" Onclick="window.location.href='user-controls.php'">
</div>
</form>
</center>

</html>