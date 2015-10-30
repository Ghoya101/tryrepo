<?php 
include("nav.php");
$con = db_connect();
$proj = $_GET['proj'];
$stat = $_GET['stat'];

if($stat == 'APPROVE')
{
$app = 'nav-po-selected';
$rev = 'nav-po';
$rej = 'nav-po';
$stat= $stat;
}else
if($stat == 'REVISION')
{
$rev = 'nav-po-selected';
$app = 'nav-po';
$rej = 'nav-po';
$po_stat = 'FOR REVISION';
}else
if($stat == 'REJECTED'){
$rej = 'nav-po-selected';
$app = 'nav-po';
$rev = 'nav-po';
$stat= $stat;
}


?>
<link rel="stylesheet" href="../css/proj.css">

<form class="po-side">
<div width='100%'>
<input class="nav-po" type=button name="nav-po" value="BACK" 		    Onclick="window.location.href='proj-files.php?proj=<?php echo $proj;?>'">
<input class="<?php echo $app;?>" type=button name="nav-po" value="APPROVE" 		Onclick="window.location.href='po.php?proj=<?php echo $proj;?>&&stat=APPROVE'">
<input class="<?php echo $rev;?>" type=button name="nav-po" value="FOR REVISION" 	Onclick="window.location.href='po.php?proj=<?php echo $proj;?>&&stat=REVISION'">
<input class="<?php echo $rej;?>" type=button name="nav-po" value="REJECTED" 		Onclick="window.location.href='po.php?proj=<?php echo $proj;?>&&stat=REJECTED'">
</div>
</form>

<form class="po-content">
<table class="tbl1">
<tr class="po-tr-head">
<th class="po-th" colspan=6>
PROJECT PURCHASE ORDERS
</th>
</tr>
<tr class="">
<th class="po-th" colspan=6>
</th>
</tr>

<!--
<tr class="inbox-po-tr">
<th>SENDER</th> 
<th>P.O. ID</th>
<th>PROJECT</th>
<th>PAYEE</th>
<th>AMOUNT</th>
<th>DATE</th>
</tr>
-->

<?php
$sql1 ="SELECT * FROM `sms_projpo` a inner join `sms_admin` b ON a.EMPID = b.EMPID
		inner join `sms_projects` c ON a.PROJID = c.PROJID inner join `sms_clients` d ON c.CID = d.CID
		WHERE `PO_STATUS` = '$stat' and a.`PROJID` = '$proj' order by PODATE desc;";
$res1 =$con->query($sql1);
$ctr1 = $res1->num_rows;
if($ctr1 >=1)
{
	while($fet1=$res1->fetch_assoc())
	{
		$POID = $fet1['POID'];
		$EMP  = $fet1['EMPNAME']. ' ' .$fet1['EMPSURNAME'];
		$POD  = $fet1['PODATE'];
		$date = date("M j, Y h:ia", strtotime($POD));		
		$PAYE = $fet1['PAYEE'];
		$COST = number_format($fet1['AMOUNT'],2);
		$FNAME = $fet1['FIRSTNAME'];
		$f = $FNAME[0];
		$PROJ =  $f.'.'.  $fet1['SURNAME'];
?>
<div class="divcost">
<tr class="inbox-po-tr" Onclick="window.location.href='viewpo.php?poid=<?php echo $POID;?>'">
<td><?php echo $EMP;?></td>
<td><?php echo $POID;?></td>
<!--<td><?php echo strtoupper($PROJ);?></td>-->
<td><?php echo $PAYE;?></td>
<td class="right"><?php echo $COST;?></td>
<td class="right"><?php echo $date;?></td>
</tr>
</div>
<?php
}
}else
{?>
<tr><td>NO PURCHASE ORDER FOR APPROVAL.</td></tr>
<?php
}?>	

<tr><td><br></td></tr>
<tr><td><br></td></tr>
<tr><td><br></td></tr>


</table>
</form>
</body>
</html>
