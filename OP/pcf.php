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
<link rel="stylesheet" href="../css/pcf.css">

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
<th class="po-th" colspan=4 style="float:left;border:1px solid black;">PROJECT PCF REPLENISHMENTS</th>
<th class="po-th" colspan=2 style="float:left;">
<input class="" type=button name="nav-po" value="+ PCF" 		    Onclick="window.location.href='new_pcf.php?proj=<?php echo $proj;?>'">
</th>
</tr>

<tr class="">
<th class="po-th" style="background:red;" colspan=6>
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

<div class="divcost">
<tr class="inbox-po-tr" Onclick="window.location.href='viewpo.php?poid=<?php echo $POID;?>'">
<td><?php echo '';?></td>
<td><?php echo '';?></td>
<!--<td><?php '';?></td>-->
<td><?php echo '';?></td>
<td class="right"><?php echo '';?></td>
<td class="right"><?php echo '';?></td>
</tr>
</div>

<tr><td>NO PCF FOR APPROVAL.</td></tr>


<tr><td><br></td></tr>
<tr><td><br></td></tr>
<tr><td><br></td></tr>


</table>
</form>
</body>
</html>
