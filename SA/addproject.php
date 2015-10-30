<?php
include("nav.php");
$conn= db_connect();
?>

<html>
<link rel="stylesheet" href="../css/cc.css">

<center>
<form class="form-content" method = "POST" action="pg1.php">
<H3 style="text-align: left;" class="h2-style">Please fill in all the fields.</H3>
<div style="margin: 2%">

<div style="background: black; color: white;">
<table class="tbl_admin" >

<tr class="tbl_tr">
<td  class="tbl_td">CLIENT INFORMATION</td>
<td colspan=2>
	<Select name="owner" class="tbl_td1">
	<?php
	$sql1 = "SELECT * From sms_clients ORDER BY  `SURNAME` ASC ";
	$res = $conn->query($sql1);

	while($row = $res->fetch_assoc())
	{
	$client 	= $row['CID'];
	$sname   	= $row['SURNAME'];
	$fname 		= $row['FIRSTNAME'];
	$name   	= $sname .', '.$fname;
	?>	
	<option value="<?php echo $client;?>"><?php echo $name;?></option>
	<?php 
	}
	?>			
	</select>			
</td>	

</tr>

<tr class="tbl_tr">	
<td  class="tbl_td">HOUSE TYPE</td>
<!--product-->
<td>
<Select name="product" class="tbl_td1">
<?php
	$sql1 = "SELECT * From sms_prod";
	$res = $conn->query($sql1);

	while($row = $res->fetch_assoc())
	{
	$prid 	= $row['prodid'];
	$prds   	= $row['desc'];

	?>	
	<option value="<?php echo $prid;?>"><?php echo $prds;?></option>
	<?php 
	}
	?>			
</select>			
</td>


<!--level-->
<td>
<Select name="level" class="tbl_td1">
<?php
	$sql1 = "SELECT * From sms_levelno";
	$res = $conn->query($sql1);

	while($row = $res->fetch_assoc())
	{
	$lvid 	= $row['LVLID'];
	$lvds   = $row['DESCRIPTION'];

	?>	
	<option value="<?php echo $lvid;?>"><?php echo $lvds;?></option>
	<?php 
	}
	?>			
</select>			
</td>
</tr>

<tr class="tbl_tr">	
<td  class="tbl_td">ASSIGNED STAFF</td>
<!--engr-->
<td>
<Select name="engr" class="tbl_td1">
<option value="0"><?php echo 'PLEASE SELECT SITE ENGINEER';?></option>
<?php
	$sql4 = "SELECT * From sms_admin a INNER JOIN sms_admintype b ON a.ADMINID = b.ADMINID WHERE b.DESCRIPTION = 'OPERATIONS' ORDER BY a.EMPSURNAME;";
	$res4 = $conn->query($sql4);
	while($row4 = $res4->fetch_assoc())
	{
	$ID = $row4['EMPID'];
	$NAME= $row4['EMPSURNAME'] .', '.$row4['EMPNAME'];
	?>	
	<option value="<?php echo $ID;?>"><?php echo $NAME;?></option>
	<?php 
	}
	?>			
</select>			
</td>
<!--pur-->
<td>
<Select name="pur" class="tbl_td1">
<option value="0"><?php echo 'PLEASE SELECT PURCHASING PERSONNEL';?></option>
<?php
	$sql4 = "SELECT * From sms_admin a INNER JOIN sms_admintype b ON a.ADMINID = b.ADMINID WHERE b.DESCRIPTION = 'PURCHASING' ORDER BY a.EMPSURNAME;";
	$res4 = $conn->query($sql4);
	while($row4 = $res4->fetch_assoc())
	{
	$ID = $row4['EMPID'];
	$NAME= $row4['EMPSURNAME'] .', '.$row4['EMPNAME'];
	?>	
	<option value="<?php echo $ID;?>"><?php echo $NAME;?></option>
	<?php 
	}
	?>			
</select>			
</td>
</tr>

<tr class="tbl_tr">	
<td  class="tbl_td">CONTRACT PRICE</td>
<!--contract price-->
<td colspan=2><input type=text name="amount" class="tbl_td1" placeholder="Please do not use ',' "></td>

</table>
</div>
<input style="width: 10%;float: right;" class="rc-button rc-button-submit" type="button" name="cmdback" value="CANCEL" Onclick="window.location.href='index.php'">
<input style="width: 10%;float: right;" class="rc-button rc-button-submit" type="submit" name="cmdadd" value="ADD">

</div>	
</form>
</center>


</html>