<?php
include("nav.php");
$con = db_connect();
$clientsql = "SELECT * FROM `sms_clients`;";
$clientres = $con->query($clientsql);
$clientctr = $clientres->num_rows;

if($clientctr > 0)
{
?>

<html>


<center>
<form class="form-content" method = "GET" action="clientlist.php">
<div style="margin: 2%">
<table class='tbl-search'>
<tr>
<td>
			<Select name="searchby" class="searchcat">
				<option value="all">All matched info</option>
				<option value="HOMEADD">Address</option>
				<option value="CITIZENSHIP">Citizenship</option>
				<option value="SURNAME">Surname</option>
				<option value="MIDDLENAME">Middle name</option>
				<option value="FIRSTNAME">First name</option>	
			</select>
</td>			
<td width='60%'><input style=""				type="text" name="s" class="searchbox"></td>
<td><input style="width: 100%;float: left; margin-left: 0.5%;" class="rc-button rc-button-submit" type="submit" name="cmdSearch" value="SEARCH"></td>
</tr>
</table>	

<?php
if(isset($_GET['cmdSearch']))
{
	$a = $_GET['searchby'];
	$b = $_GET['s'];

if($a = 'all' && $b != '')
{
$sql2 = "SELECT * FROM `sms_clients` 
WHERE CONCAT_WS(' ', `SURNAME`, `FIRSTNAME`, `MIDDLENAME`,`CITIZENSHIP`,`TIN`,`BIRTHDATE`,
`HOMEADD`,`CELLNO`,`EMAIL`,`LANDAREA`,`PROPERTYADD`) LIKE '%$b%' ;";
}
else if($a != 'all' && $b != '')
{
$sql2 = "SELECT * FROM `sms_clients` WHERE '$a' LIKE '%$b%' ORDER BY SURNAME; ";	
}

$res2 = $con->query($sql2);
$ctr2 = $res2->num_rows;
if($ctr2 == 0)
{
?>
<br><br><br><br>
<div class="no">
NO ITEMS MATCHED.
</div>
<?php
}else
if($ctr2 >= 1)	
{	
?>

<div>
<table class="tbl_admin">

<tr class="tbl_tr">
<th class="tbl_th1" style="width:5px;">-</th>
<th class="tbl_th1">NAME</th>
<th class="tbl_th1">EMAIL</th>
<th class="tbl_th1">CONTACT NO</th>
<th class="tbl_th1">ADDRESS</th>
</tr>
<?php
$i;	
for($i=1;$i<=$ctr2;$i++)
while($fet2 = $res2->fetch_assoc())
{
	$a = $fet2['SURNAME'].', '.$fet2['FIRSTNAME'];
	$b = $fet2['EMAIL'];
	$c = $fet2['CELLNO'];
	$d = $fet2['HOMEADD'];
	$e = $fet2['CID'];
?>
<tr class="tbl-hv" Onclick="window.location.href='editclient.php?cid=<?php echo $e;?>'">
<td class="tbl_td"><?php echo $i; ?></td>
<td class="tbl_td"><?php echo $a; ?></td>
<td class="tbl_td"><?php echo $b; ?></td>
<td class="tbl_td"><?php echo $c; ?></td>
<td class="tbl_td"><?php echo $d; ?></td>
</tr>
<?php
$i++;
}

}
?>
</table>
</div>

<?php
}
else
{?>
<!--HOME-->
<div>
<table class="tbl_admin">

<tr class="tbl_tr" >
<th class="tbl_th1"  style="width:5px;">#</th>
<th class="tbl_th1">NAME</th>
<th class="tbl_th1">EMAIL</th>
<th class="tbl_th1">CONTACT NO</th>
<th class="tbl_th1">ADDRESS</th>
</tr>
<?php
$sql3 = "SELECT * FROM `sms_clients` ORDER BY SURNAME;";
$res3 = $con->query($sql3);	
$ctr3 = $res3->num_rows;
$i;	
for($i=1;$i<=$ctr3;$i++)
while($fet3 = $res3->fetch_assoc())
{
	$a = $fet3['SURNAME'].', '.$fet3['FIRSTNAME'];
	$b = $fet3['EMAIL'];
	$c = $fet3['CELLNO'];
	$d = $fet3['HOMEADD'];
	$e = $fet3['CID'];
?>
<tr class="tbl-hv" Onclick="window.location.href='editclient.php?cid=<?php echo $e;?>'">
<td class="tbl_td"><?php echo $i; ?></td>
<td class="tbl_td"><?php echo $a; ?></td>
<td class="tbl_td"><?php echo $b; ?></td>
<td class="tbl_td"><?php echo $c; ?></td>
<td class="tbl_td"><?php echo $d; ?></td>
</tr>
<?php
$i++;
}

?>
</table>
</div>
<?php
}?>


</div>
</form>
</center>

<?php }else
{?>
<center>
<form class="form-content" method = "GET" action="clientlist.php">
<div style="font-family:arial; font-size: 25px;">
NO CLIENT RECORD IN THE DATABASE.<br>
PLEASE CONTACT THE DATABASE ADMINISTRATOR FOR ASSISTANCE.
</div>
</form>
</center>
<?php
}?>
</html>