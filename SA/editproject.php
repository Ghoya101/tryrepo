<?php
include("nav.php");
$conn= db_connect();
$PROJ = $_GET['proj'];
$sql1 = "Select * from `sms_projects` a inner join `sms_clients` b ON a.`CID`  = b.`CID` 
inner join `sms_levelno` c ON a.TYPEID = c.LVLID
inner join `sms_prod` d ON a.PRODID = d.prodid
WHERE a.PROJID ='$PROJ';"; 
$res = $conn->query($sql1);
while($fetch1=$res->fetch_assoc())
{
$PROJECT = $fetch1['PROJID'];	
$CLIENTS  = $fetch1['CID'];
$CSNAME = $fetch1['SURNAME'];
$CFNAME = $fetch1['FIRSTNAME'];
$NAME 	= $CSNAME .','. $CFNAME;
$PRODID	= $fetch1['PRODID'];
$PROD	= $fetch1['desc'];
$TYPEID	= $fetch1['TYPEID'];
$TYPE	= $fetch1['DESCRIPTION'];
$SITE	= $fetch1['PROPERTYADD'];
$PUR	= $fetch1['PURCHASINGID'];
$OPR	= $fetch1['OPERATIONSID'];
$AREA	= $fetch1['LANDAREA'];
$AMNT	= $fetch1['CONTRACTAMOUNT'];
}
?>

<center>
<form class="form-content" method = "POST" action="cc2.php">
<H3 style="text-align: left;" class="h2-style">Please fill in all the fields.</H3>
<div style="margin: 2%">
<div style="background: black; color: white;">

<table class="tbl_admin" >

<tr class="tbl_tr">
<td  class="tbl_td">CLIENT INFORMATION</td>
<td colspan=2><input type=text name="owner" class="tbl_td1" value="<?php echo $NAME; ?>" disabled	></td>	
<input type=hidden name="proj" value="<?php echo $PROJ; ?>">

</tr>

<tr class="tbl_tr">	
<td  class="tbl_td">HOUSE TYPE</td>
<!--PRODUCT-->
<td>
<Select name="product" class="tbl_td1">
<option value="<?php echo $PRODID;?>" selected><?php echo $PROD;?></option>
<?php
	$sql2 = "SELECT * From sms_prod WHERE prodid != $PRODID;";
	$res2 = $conn->query($sql2);

	while($row = $res2->fetch_assoc())
	{
	$prid 	= $row['prodid'];
	$prds   = $row['desc'];
	?>	
	<option value="<?php echo $prid;?>"><?php echo $prds;?></option>
	<?php 
	}
	?>			
</select>			
</td>
<!--HOUSE LEVEL-->
<td>
<Select name="level" class="tbl_td1">
<option value="<?php echo $TYPEID;?>" selected><?php echo $TYPE;?></option>
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
<td  class="tbl_td">SET ADMIN PRIVILEGES</td>
<!--PURCHASING-->
<td>
<Select name="pur" class="tbl_td1">
<?php 
if($PUR != 0)
{
$sql3 = "SELECT * from sms_admin WHERE EMPID = '$PUR';";
$res3 = $conn->query($sql3);
while($fet = $res3->fetch_assoc())
{ $EMP = $fet['EMPSURNAME'] .', '.$fet['EMPNAME'];
?>
<option value="<?php echo $PUR;?>" selected><?php echo $EMP;}?></option>
<?php
}else
{?><option value="0" selected><?php echo 'PLEASE SELECT A PURCHASER';}?></option>
<?php
	$sql4 = "SELECT * From sms_admin a INNER JOIN sms_admintype b ON a.ADMINID = b.ADMINID WHERE b.DESCRIPTION = 'PURCHASING' AND a.EMPID != '$PUR'ORDER BY a.EMPSURNAME;";
	$res4 = $conn->query($sql4);
	while($row4 = $res4->fetch_assoc())
	{
	$PURID = $row4['EMPID'];
	$NAME= $row4['EMPSURNAME'] .', '.$row4['EMPNAME'];
	?>	
	<option value="<?php echo $PURID;?>"><?php echo $NAME;?></option>
	<?php 
	}
	?>			
</select>			
</td>
<!--OPERATIONS-->
<td>
<Select name="engr" class="tbl_td1">
<?php 
if($OPR != 0)
{
$sql3 = "SELECT * from sms_admin WHERE EMPID = '$OPR';";
$res3 = $conn->query($sql3);
while($fet = $res3->fetch_assoc())
{ $EMP = $fet['EMPSURNAME'] .', '.$fet['EMPNAME'];
?>
<option value="<?php echo $OPR;?>" selected><?php echo $EMP;}?></option>
<?php
}else
{
?>
<option value="0" selected><?php echo 'PLEASE SELECT AN ENGINEER';}?></option>
<?php
	$sql4 = "SELECT * From sms_admin a INNER JOIN sms_admintype b ON a.ADMINID = b.ADMINID WHERE b.DESCRIPTION = 'OPERATIONS' and a.EMPID != '$OPR' ORDER BY a.EMPSURNAME;";
	$res4 = $conn->query($sql4);
	while($row4 = $res4->fetch_assoc())
	{
	$OPRID = $row4['EMPID'];
	$NAME= $row4['EMPSURNAME'] .', '.$row4['EMPNAME'];
	?>	
	<option value="<?php echo $OPRID;?>"><?php echo $NAME;?></option>
	<?php 
	}
	?>			
</select>			
</td>
</tr>

<tr class="tbl_tr">	
<td  class="tbl_td">CONSTRUCTION INFO</td>
<!---->
<input type=text name="amount" class="tbl_td1" value="<?php echo number_format($AMNT,2); ?>">
<td><input type=text name="amount" class="tbl_td1" placeholder="<?php echo number_format($AMNT,2); ?>"></td>	
<td><input type=text class="tbl_td1" name="area" value="<?php echo $AREA.' SQ. M.' ; ?>" disabled></td>
</tr>

</table>
</div>
<input style="width: 10%;float: left;" class="rc-button rc-button-submit" type="button" name="cmdback" value="< BACK" Onclick="window.location.href='projects.php'">
<input style="width: 20%;float: left;" class="rc-button rc-button-submit" type="submit" name="cmdadd" value="SAVE CHANGES">	
</div>
</form>
</center>


</html>