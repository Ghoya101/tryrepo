<?php
include("nav.php");
require_once('functions.php');
$con = db_connect();
$EMP = $empid;
$query1 = "SELECT * FROM sms_projpo a inner join sms_projects b ON a.PROJID = b.PROJID
			inner join sms_clients c ON b.CID = c.CID WHERE a.EMPID = $empid AND STATUS > 1 order by a.PODATE DESC;";
$run1	= $con->query($query1);
$ctr1	= $run1->num_rows;

$query3 = "SELECT * FROM sms_projects a inner join sms_clients b ON a.CID = b.CID WHERE PURCHASINGID = $empid AND ENDDATE ='0000-00-00' ;";
$run3	= $con->query($query3);
$ctr3	= $run3->num_rows;

$query123 = "SELECT * FROM sms_projpo a inner join sms_projects b ON a.PROJID = b.PROJID
			inner join sms_clients c ON b.CID = c.CID WHERE a.EMPID = $empid AND STATUS = 1 order by a.datemodified DESC;";
$run123	= $con->query($query123);
$ctr123	= $run123->num_rows;
?>
<link rel="stylesheet" href="../css/projects.css">	

<form class="side"	>
<input type=button STYLE="WIDTH:100%;margin:0;" class="rc-button rc-button-submit" onclick="window.location.href='projects.php'" value="SENT PO">
<input type=button STYLE="WIDTH:100%;" class="rc-button rc-button-submit" onclick="window.location.href='projects.php?drafts=YES'" value="DRAFTS(<?PHP echo $ctr123;?>)">
<input type=text  STYLE="WIDTH:100%;BACKGROUND:None;  -webkit-box-shadow:none; text-shadow:none;outline:none;font-weight:bold;padding:2px;" value="-PROJECTS-" DISABLED>
<?php 
if($ctr3 = 0)//4
{
?>
NO ASSIGNED PROJECTS.
<?php
} //4
else
{	//5
	while($get3=$run3->fetch_assoc())
	{ //6
	$projclient = $get3['FIRSTNAME'][0].'.'.$get3['SURNAME'];
	$cid = $get3['PROJID'];
	?>
	<input type=button id="proj" STYLE="WIDTH:100%;" class="rc-button rc-button-submit" onclick="getproj('<?php echo $cid;?>')" value="<?php echo strtoupper($projclient);?>">
	<?php
	}//6
} //5
?>
</form>




<?PHP
if(!isset($_GET['drafts']))
{
?>
<form style="width:78%;background:none;float:left; "	>
<?php 
if(isset($_GET['proj']))
{
$project = $_GET['proj'];
$query = "SELECT * FROM `sms_projects` a inner join `sms_clients` b ON a.CID = b.CID
			WHERE a.PROJID = '$project' ;";
$result =$con->query($query);
while($a = $result->fetch_assoc()){$client = $a['FIRSTNAME'].' '.$a['SURNAME']; $NEWPO = $a['PROJID'].' - '.($a['POCTR']+1);}
?>
<table class="setproj">

<tr STYLE="border:none;"class="setproj-tr">
<td colspan=5>
<input type=button id="proj" STYLE="WIDTH:25%;border-right:1px solid #4787ed;border-left:1px solid #4787ed;border-top:1px solid #4787ed;" class="rc-button rc-button-submit" Onclick="window.location.href='newpo.php?proj=<?php echo $project;?>&&poid=<?php echo $NEWPO;?>'"" value="+ PURCHASE ORDER">
<input type=button id="proj" STYLE="WIDTH:25%;border-right:1px solid #4787ed;border-left:1px solid #4787ed;border-top:1px solid #4787ed;" class="rc-button rc-button-submit" Onclick="window.location.href='new_monitoring.php?proj=<?php echo $project;?>'" value="PROJECT REQUIREMENTS">
</td>
</tr>

<tr class="setproj-tr1">
<td style="width:10%">PO #</td>
<td style="width:40%">PAYEE</td>
<td style="width:20%">AMOUNT</td>
<td style="width:10%">STATUS</td>
<td style="width:15%">DATE</td>
</tr>
<?php


$query4	= "SELECT * from sms_projpo WHERE PROJID = '$project' AND EMPID = $empid ORDER BY PODATE DESC;";
$run4	= $con->query($query4);
$ctr4	= $run4->num_rows;
if($ctr4 == 0) //7
{
?>
<tr class="setproj-tr2">
<td colspan=5>NO PO FOR THIS PROJECT.</td>
</tr>
<?php
}//7
else
{ //8
	while($get4=$run4->fetch_assoc())
	{ //9
		$poid	 = $get4['POID'];
		$payee	 = $get4['PAYEE'];
		$podate = $get4['PODATE'];
		$status = $get4['STATUS'];
		$query5 = "SELECT * FROM sms_pocontent WHERE POID = '$poid' ;";
		$run5	= $con->query($query5);
		if($status == '1'){$status = 'Drafts';}else if($status == '2'){$status='FOR CHECKING';}ELSE if($status==3){$status='FOR RECOMMENDATION';}ELSE IF($status==4){$status='FOR REVISION';}ELSE IF($status==5){$status='FOR APPROVAL';}ELSE IF($status==6){$status='FOR DISBURSEMENT';}ELSE IF($status==7){$status='FOR RELEASE';}
		IF($podate == '0000-00-00 00:00:00'){$podate='';}else{$podate = date("M j, Y h:ia", strtotime($podate));}
		$amount = 0;
		while($get5=$run5->fetch_assoc()){$t= $get5['POQTY']*$get5['POUNITPRICE'];$amount += $t;}

?>
<tr class="setproj-tr2" onclick="window.location.href='newpo.php?proj=<?php echo $project;?>&&poid=<?php echo $poid;?>'">
	<td ><?php echo $poid;?></td>
	<td ><?php echo $payee;?></td>
	<td ><?php echo number_format($amount,2);?></td>
	<td ><?php echo $status;?></td>
	<td ><?php echo $podate;?></td>
	</tr>
<?php
	}//9
}//8
?>
</table>












<?php
//if(!isset(proj))
}else
{
?>
<table class="nosetproj">

<tr class="nosetproj-tr">
<td colspan=6 style="font-weight:bold;padding:5px;text-align:center;">SENT PURCHASE ORDERS</td>
</td>
</tr>

<tr class="nosetproj-tr1">
<td style="width:15%">PROJECT</td>
<td style="width:5%">PO #</td>
<td style="width:40%">PAYEE</td>
<td style="width:10%">AMOUNT</td>
<td style="width:10%">STATUS</td>
<td style="width:15%">DATE</td>
</tr>

<?php
if($ctr1 == 0) //1
{
?>
<tr>
<td colspan=5>YOU HAVE NO PO RECORDS SENT.</td>
</tr>

<?php
} //1
ELSE
{ //2
	while($get1=$run1->fetch_assoc())
	{ //3
	$project = $get1['FIRSTNAME'][0].'.'.$get1['SURNAME'];
	$Proj = $get1['PROJID'];
	$poid	 = $get1['POID'];
	$payee	 = $get1['PAYEE'];
	$podate = $get1['PODATE'];
	$status = $get1['STATUS'];
	if($status == '1'){$status = 'Drafts';}else if($status == '2'){$status='FOR CHECKING';}ELSE if($status==3){$status='FOR RECOMMENDATION';}ELSE IF($status==4){$status='FOR REVISION';}ELSE IF($status==5){$status='FOR APPROVAL';}ELSE IF($status==6){$status='FOR DISBURSEMENT';}ELSE IF($status==7){$status='FOR RELEASE';}

	$query2 = "SELECT * FROM sms_pocontent WHERE POID = '$poid' ;";
	$run2	= $con->query($query2);
	$amount=0;
	while($get2=$run2->fetch_assoc()){$t = $get2['POQTY']*$get2['POUNITPRICE']; $amount += $t;}

	?>
	<tr class="nosetproj-tr2" onclick="window.location.href='newpo.php?proj=<?php echo $Proj;?>&&poid=<?php echo $poid;?>'">
	<td ><?php echo $project;?></td>
	<td ><?php echo $poid;?></td>
	<td ><?php echo $payee;?></td>
	<td ><?php echo number_format($amount,2);?></td>
	<td ><?php echo $status;?></td>
	<td ><?php echo date("M j, Y h:ia", strtotime($podate));?></td>
	</tr>
<?php
	} //3
} // 2
?>

</table>

<?php
}
?>
</form>


<?php
} 
ELSE
{

?>
<form style="width:78%;background:#B7FFDD;float:left; "	>
<table class="nosetproj">

<tr class="nosetproj-tr">
<td colspan=6 style="font-weight:bold;padding:5px;text-align:center;">SAVED DRAFTS</td>
</td>
</tr>

<tr class="nosetproj-tr1">
<td style="width:15%">PROJECT</td>
<td style="width:5%">PO #</td>
<td style="width:40%">PAYEE</td>
<td style="width:10%">AMOUNT</td>
<td style="width:10%">STATUS</td>
<td style="width:15%">DATE MODIFIED</td>
</tr>

<?php
if($ctr123 == 0) //1
{
?>
<tr>
<td colspan=5>YOU HAVE NO DRAFTS.</td>
</tr>

<?php
} //1
ELSE
{ //2
	while($get1=$run123->fetch_assoc())
	{ //3
	$project = $get1['FIRSTNAME'][0].'.'.$get1['SURNAME'];
	$Proj = $get1['PROJID'];
	$poid	 = $get1['POID'];
	$payee	 = $get1['PAYEE'];
	$datemodified = $get1['datemodified'];
	$status = $get1['STATUS'];
	if($status == '1'){$status = 'Drafts';}else if($status == '2'){$status='FOR CHECKING';}ELSE if($status==3){$status='FOR RECOMMENDATION';}ELSE IF($status==4){$status='FOR REVISION';}ELSE IF($status==5){$status='FOR APPROVAL';}ELSE IF($status==6){$status='FOR DISBURSEMENT';}ELSE IF($status==7){$status='FOR RELEASE';}

	$query2 = "SELECT * FROM sms_pocontent WHERE POID = '$poid' ;";
	$run2	= $con->query($query2);
	$amount=0;
	while($get2=$run2->fetch_assoc()){$t = $get2['POQTY']*$get2['POUNITPRICE']; $amount += $t;}

	?>
	<tr class="nosetproj-tr2" onclick="window.location.href='newpo.php?proj=<?php echo $Proj;?>&&poid=<?php echo $poid;?>'">
	<td ><?php echo $project;?></td>
	<td ><?php echo $poid;?></td>
	<td ><?php echo $payee;?></td>
	<td ><?php echo number_format($amount,2);?></td>
	<td ><?php echo $status;?></td>
	<td ><?php echo date("M j, Y h:ia", strtotime($datemodified));?></td>
	</tr>
<?php
	} //3
} // 2
?>

</table>
</form>
<?php
}?>




