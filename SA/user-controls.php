<?php
include("nav.php");
$con = db_connect();
?>
<center>
<form class="form-content" method = "GET" action="cc2.php">
<div style="margin: 2%">
<div style="background: blue; color: white;">
<table class='tbl-search'>
<tr>
<td>
			<Select name="searchby" class="searchcat">
				<option value="location">All matched info</option>
				<option value="name">Name</option>
				<option value="name">Username</option>
			</select>
</td>	
<td>		
			<Select name="dept" class="searchcat">
			<option value="All">All Departments</option>
<?php
$sql1 = "SELECT * From sms_prod";
$res1 = $con->query($sql1);

while($row1 = $res1->fetch_assoc())
{
	$prodid = $row1['prodid'];
	$desc   = $row1['desc'];
?>	
				<option value="<?php echo $prodid;?>"><?php echo $desc;?></option>
<?php 
}
?>			
			</select>			
</td>			
<td width='40%'>	<input type="text" name="s" class="searchbox"></td>
<td>	
<input style="width: 49.5%;float: left; margin-left: 0.5%;" class="rc-button rc-button-submit" type="submit" name="cmdSearch" value="SEARCH">
<input style="width: 49.5%;float: left; margin-left: 0.5%;" class="rc-button rc-button-submit" type="button" name="adduser"  value="+ USER" Onclick="window.location.href='adduser.php'">
</td>
</tr></table>
	</div>

<br><br><br><br>

<div style="background: black; color: white;">
<table class="tbl_admin">
<tr class="tbl_tr">
<th class="tbl_th">ADMINISTRATIVE LEVEL</th>
<th class="tbl_th">SURNAME</th>
<th class="tbl_th">FIRST NAME</th>
<th class="tbl_th">ACTION</th>
</tr>
<?php 
		$sql2 = "SELECT * FROM `sms_admin` a inner join `sms_admintype` t
				 ON a.ADMINID = t.ADMINID WHERE a.EMPID != '$EMP';";
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
<td class="tbl_td"><a href="post-delete.php?user=<?php echo $d;?>"><input type=button value="DEL" class=""></a>
				   <a href="edit.php?user=<?php echo $d;?>"><input type=button value="EDIT"></a>
</td>
</tr>
<?php	}?>
</table>
</div>

</div>
</form>
</center>


</html>