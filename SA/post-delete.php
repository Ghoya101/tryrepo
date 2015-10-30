<?php
include("nav.php");
$con = db_connect();

if(isset($_GET['user']))
{
$user = $_GET['user'];
}
?>


<html>
<link rel="stylesheet" href="../css/cc.css">

<center>
<form class="form-content" method = "GET" action="delete.php">
<div style="margin: 2%">

<div style="text-align:left;">	
<label class="tbl_lbl">ARE YOU SURE YOU WANT TO DELETE THIS USER?</label>
</div>
<br>
<div style="background: black; color: white;">
<table class="tbl_admin">
<tr class="tbl_tr">
<th class="tbl_th">ADMINISTRATIVE LEVEL</th>
<th class="tbl_th">SURNAME</th>
<th class="tbl_th">FIRST NAME</th>

</tr>
<?php 

		$sql2 = "SELECT * FROM `sms_admin` a inner join `sms_admintype` t
				 ON a.ADMINID = t.ADMINID WHERE a.EMPID = '$user' ;";
		$res2 = $con->query($sql2);
		while($fet2=$res2->fetch_assoc())
		{

			$a = $fet2['DESCRIPTION'];
			$b = $fet2['EMPSURNAME'];
			$c = $fet2['EMPNAME'];
			$d = $fet2['EMPID'];


?>
<tr class="tbl_tr">
<td class="tbl_td"><?php echo $a; ?></td>
<td class="tbl_td"><?php echo $b; ?></td>
<td class="tbl_td"><?php echo $c; ?></td>
<input type=hidden value="<?php echo $user;?>" name="uac">
</tr>
<?php	}?>
</table>

</div>
<br>

<input type=submit value="YES" name="cmd" 	class="rc-button rc-button-submit">
<input type=button value="NO"  name="cmd"	class="rc-button rc-button-submit" Onclick="window.location.href='user-controls.php'">
</div>
</form>
</center>
</html>