
<?php 
// include("cost-nav.php");
// $con=db_connect();
include("../connection/config.php");
$con = db_connect();

$PROJ = $_GET['proj']; 
$sql1 = "SELECT SURNAME, FIRSTNAME, pr.desc AS desc1, p.LOCATION AS site, lvl.DESCRIPTION AS desc2, p.F as ef
FROM  `sms_clients` c
INNER JOIN  `sms_projects` p ON c.CID = p.CID
INNER JOIN  `sms_prod` pr ON p.PRODID = pr.prodid
INNER JOIN  `sms_levelno` lvl ON p.TYPEID = lvl.LVLID
WHERE p.PROJID =  '".$PROJ."' ";
$result1 = $con->query($sql1);
$row_ctr = $result1->num_rows;
if($row_ctr >=1)
{
while($fetch01 = $result1->fetch_assoc())
	{
		$sname = $fetch01['SURNAME'];
		$fname = $fetch01['FIRSTNAME'];
		$name = $sname .','. $fname;	
		$prod = $fetch01['desc1'];
		$site = utf8_decode($fetch01['site']);
		$lvl = $fetch01['desc2'];
		$ef = $fetch01['ef'];

		$query = ("UPDATE sms_subsubcat SET M=REPLACE(QTY, ',', '')*REPLACE(UM, ',', '')");
	    $query1 = ("UPDATE sms_subsubcat SET L=REPLACE(QTY, ',', '')*REPLACE(UL, ',', '')");
	    $query2 = ("UPDATE sms_subsubcat SET AMOUNT=REPLACE(M, ',', '')+REPLACE(L, ',', '')");
	    $query3 = ("UPDATE sms_subsubcat SET PROFIT_AMOUNT=REPLACE(AMOUNT, ',', '')*$ef");
		$queryy = $con->query($query);
		$queryy1 = $con->query($query1);
		$queryy2 = $con->query($query2);
		$queryy3 = $con->query($query3);

?>
<head>
	<link rel="stylesheet" href="../css/costing.css">
</head>


<body>

<form name="cost estimate" class="form-content" Method="POST" action="">
<div name="division for New Opened Projects" style="background:#F0F0F0 ;overflow-x: scroll; ">
<div id="dateMod" class="keme"></div>

<label>PROJECT: Proposed <?php echo $prod .' '. $lvl;?>  </label>
<br>
<label>OWNER: <?php echo $name;?>  </label>
<br>
<label>LOCATION: <?php echo $site;?>  </label><br><br>
<?php
	}
}
else
{
	echo "SQL1 returned a false or zero result";
	
}?>


<table id="datatables" class="display">
<thead>
<th class="th1">COST ID</th>
<th class="th1">SCOPE OF WORKS</th>
<th class="th1">DIGEST OF SPECIFICATIONS</th>
<th class="th1">QTY</th>
<th class="th1">UNIT</th>
<th class="th1">UM</th>
<th class="th1">M</th>
<th class="th1">UL</th>
<th class="th1">L</th>
<th class="th1">AMOUNT</th>
<th class="th1"><input type="text" id="forF" style = "width: 30px; float: left" data-index='<?php echo $PROJ; ?>' value='<?php echo $ef;?>'/>F</th>
<th class="th1">AMOUNT</th>
</thead>
<tbody>
<?php
$sql1 = "SELECT CATID as cat,DESCRIPTION as cdesc FROM `sms_costcat` ;";
$res1 = $con->query($sql1);
while($fetch1=$res1->fetch_assoc())
{	
	$a = $fetch1['cat'];
	$b = $fetch1['cdesc'];

	$calc = "SELECT SUM(PROFIT_AMOUNT) as tot FROM sms_subsubcat WHERE PROJID = $a";
	$resCalc = $con->query($calc);
	while($fetchCalc=$resCalc->fetch_assoc())
	{
		$result =number_format(floatval($fetchCalc['tot']), 2);
?>
<tr>
<th width=2% style="Text-align: right;"><button id='btnMains' style="float: left;" class="btn btn-default btn-xs" data-index='<?php echo $a;?>' data-toggle="modal" data-target="#modalMain">+</button><?php echo $a;?></th>
<th width=25% style="Text-align: Left;"><?php echo $b;?></th>
<th width=20%></th>
<th width=5%></th>
<th width=3%></th>
<th width=8%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%></th>
<th width=30%><?php echo $result;?></th>
</tr>

<?php 
}
$sql2 = "SELECT * FROM `sms_subsubcat` WHERE PROJID = $a AND cat2Id != 0 AND cat3Id = 0;";

$res2 = $con->query($sql2);
while($fetch2=$res2->fetch_assoc())
{
	$c = $fetch2['cat2Id'];
	$d = $fetch2['DESCRIPTION'];
	$id1 = $fetch2['SUBSUBCATID'];
	$DIGOFSPEC1 = $fetch2['DIGOFSPEC'];
	$QTY1 = $fetch2['QTY'];
	$UNIT1 = $fetch2['UNIT'];
	$UM1 = number_format(floatval($fetch2['UM']), 2);
	$M1 = number_format($fetch2['M'], 2);
	$UL1 = $fetch2['UL'];
	$L1 = number_format($fetch2['L'], 2);
	$AMOUNT1 = number_format($fetch2['AMOUNT'], 2);
	$F1 = $fetch2['F'];
	$PROFIT_AMOUNT1 = number_format($fetch2['PROFIT_AMOUNT'], 2);
?>
<tr>
	<td style="text-align: right;"><button id='btnCat3' style="float: left;" class="btn btn-default btn-xs" data-index='<?php echo $a.'.'.$c;?>' data-toggle="modal" data-target="#modalcat3">+</button><?php echo $a.'.'.$c;?></td>
	<td data-index=<?php echo $id1;?> name="DESCRIPTION"><?php echo $d;?></td>
	<td data-index=<?php echo $id1;?> name="DIGOFSPEC"><?php echo $DIGOFSPEC1;?></td>
	<td data-index=<?php echo $id1;?> name="QTY"><?php echo $QTY1;?></td>
	<td data-index=<?php echo $id1;?> name="UNIT"><?php echo $UNIT1;?></td>
	<td data-index=<?php echo $id1;?> name="UM"><?php echo $UM1;?></td>
	<td data-index=<?php echo $id1;?>><?php echo $M1;?></td>
	<td data-index=<?php echo $id1;?> name="UL"><?php echo $UL1;?></td>
	<td data-index=<?php echo $id1;?>><?php echo $L1;?></td>
	<td data-index=<?php echo $id1;?>><?php echo $AMOUNT1;?></td>
	<td></td>
	<td data-index=<?php echo $id1;?>><?php echo $PROFIT_AMOUNT1;?></td>
</tr>

<?php
$sql3 = "SELECT * FROM `sms_subsubcat` WHERE PROJID = $a AND cat2Id = $c AND cat3Id != 0 AND cat4Id = 0;";
$res3 = $con->query($sql3);
while($fetch3=$res3->fetch_assoc())
{
	$e = $fetch3['cat3Id'];
	$f = $fetch3['DESCRIPTION'];
	$id2 = $fetch3['SUBSUBCATID'];
	$DIGOFSPEC2 = $fetch3['DIGOFSPEC'];
	$QTY2 = $fetch3['QTY'];
	$UNIT2 = $fetch3['UNIT'];
	$UM2 = number_format(floatval($fetch3['UM']), 2);
	$M2 = number_format($fetch3['M'], 2);
	$UL2 = $fetch3['UL'];
	$L2 = number_format($fetch3['L'], 2);
	$AMOUNT2 = number_format($fetch3['AMOUNT'], 2);
	$F2 = $fetch3['F'];
	$PROFIT_AMOUNT2 = number_format($fetch3['PROFIT_AMOUNT'], 2);
?>
<tr>
	<td style="text-align: right;"><button id='btnCat4' style="float: left;" class="btn btn-default btn-xs" data-index='<?php echo $a.'.'.$c.'.'.$e;?>' data-toggle="modal" data-target="#modalcat4">+</button><?php echo $a.'.'.$c.'.'.$e;?></td>
	<td data-index=<?php echo $id2;?> name="DESCRIPTION"><?php echo $f;?></td>
	<td data-index=<?php echo $id2;?> name="DIGOFSPEC"><?php echo $DIGOFSPEC2;?></td>
	<td data-index=<?php echo $id2;?> name="QTY"><?php echo $QTY2;?></td>
	<td data-index=<?php echo $id2;?> name="UNIT"><?php echo $UNIT2;?></td>
	<td data-index=<?php echo $id2;?> name="UM"><?php echo $UM2;?></td>
	<td data-index=<?php echo $id2;?>><?php echo $M2;?></td>
	<td data-index=<?php echo $id2;?> name="UL"><?php echo $UL2;?></td>
	<td data-index=<?php echo $id2;?>><?php echo $L2;?></td>
	<td data-index=<?php echo $id2;?>><?php echo $AMOUNT2;?></td>
	<td></td>
	<td data-index=<?php echo $id2;?>><?php echo $PROFIT_AMOUNT2;?></td>
</tr>
<?php
$sql4 = "SELECT * FROM `sms_subsubcat` WHERE PROJID = $a AND cat2Id = $c AND cat3Id = $e AND cat4Id != 0 AND cat5Id = 0;";
$res4 = $con->query($sql4);
while($fetch4=$res4->fetch_assoc())
{
	$g = $fetch4['cat4Id'];
	$h = $fetch4['DESCRIPTION'];
	$id3 = $fetch4['SUBSUBCATID'];
	$DIGOFSPEC3 = $fetch4['DIGOFSPEC'];
	$QTY3 = $fetch4['QTY'];
	$UNIT3 = $fetch4['UNIT'];
	$UM3 = number_format(floatval($fetch4['UM']), 2);
	$M3 = number_format($fetch4['M'], 2);
	$UL3 = $fetch4['UL'];
	$L3 = number_format($fetch4['L'], 2);
	$AMOUNT3 = number_format($fetch4['AMOUNT'], 2);
	$F3 = $fetch4['F'];
	$PROFIT_AMOUNT3 = number_format($fetch4['PROFIT_AMOUNT'], 2);
?>
<tr>
	<td style="text-align: right;"><button id='btnCat5' style="float: left;" class="btn btn-default btn-xs" data-index='<?php echo $a.'.'.$c.'.'.$e.'.'.$g;?>' data-toggle="modal" data-target="#modalcat5">+</button><?php echo $a.'.'.$c.'.'.$e.'.'.$g;?></td>
	<td data-index=<?php echo $id3;?> name="DESCRIPTION"><?php echo $h;?></td>
	<td data-index=<?php echo $id3;?> name="DIGOFSPEC"><?php echo $DIGOFSPEC3;?></td>
	<td data-index=<?php echo $id3;?> name="QTY"><?php echo $QTY3;?></td>
	<td data-index=<?php echo $id3;?> name="UNIT"><?php echo $UNIT3;?></td>
	<td data-index=<?php echo $id3;?> name="UM"><?php echo $UM3;?></td>
	<td data-index=<?php echo $id3;?>><?php echo $M3;?></td>
	<td data-index=<?php echo $id3;?> name="UL"><?php echo $UL3;?></td>
	<td data-index=<?php echo $id3;?>><?php echo $L3;?></td>
	<td data-index=<?php echo $id3;?>><?php echo $AMOUNT3;?></td>
	<td></td>
	<td data-index=<?php echo $id3;?>><?php echo $PROFIT_AMOUNT3;?></td>
</tr>
<?php
$sql5 = "SELECT * FROM `sms_subsubcat` WHERE PROJID = $a AND cat2Id = $c AND cat3Id = $e AND cat4Id = $g AND cat5Id != 0;";
$res5 = $con->query($sql5);
while($fetch5=$res5->fetch_assoc())
{
	$i = $fetch5['cat5Id'];
	$j = $fetch5['DESCRIPTION'];
	$id4 = $fetch5['SUBSUBCATID'];
	$DIGOFSPEC4 = $fetch5['DIGOFSPEC'];
	$QTY4 = $fetch5['QTY'];
	$UNIT4 = $fetch5['UNIT'];
	$UM4 = number_format(floatval($fetch5['UM']), 2);
	$M4 = number_format($fetch5['M'], 2);
	$UL4 = $fetch5['UL'];
	$L4 = number_format($fetch5['L'], 2);
	$AMOUNT4 = number_format($fetch5['AMOUNT'], 2);
	$F4 = $fetch5['F'];
	$PROFIT_AMOUNT4 = number_format($fetch4['PROFIT_AMOUNT'], 2);
?>
<tr>
	<td style="text-align: right;"><?php echo $a.'.'.$c.'.'.$e.'.'.$g.'.'.$i;?></td>
	<td data-index=<?php echo $id4;?> name="DESCRIPTION"><?php echo $j;?></td>
	<td data-index=<?php echo $id4;?> name="DIGOFSPEC"><?php echo $DIGOFSPEC4;?></td>
	<td data-index=<?php echo $id4;?> name="QTY"><?php echo $QTY4;?></td>
	<td data-index=<?php echo $id4;?> name="UNIT"><?php echo $UNIT4;?></td>
	<td data-index=<?php echo $id4;?> name="UM"><?php echo $UM4;?></td>
	<td data-index=<?php echo $id4;?>><?php echo $M4;?></td>
	<td data-index=<?php echo $id4;?> name="UL"><?php echo $UL4;?></td>
	<td data-index=<?php echo $id4;?>><?php echo $L4;?></td>
	<td data-index=<?php echo $id4;?>><?php echo $AMOUNT4;?></td>
	<td data-index=<?php echo $id4;?> ></td>
	<td data-index=<?php echo $id4;?>><?php echo $PROFIT_AMOUNT4;?></td>
</tr>
<?php
}
}
}
}
}
?>
</tbody>
<table>
</form>
<div class="form-group">
	<input type="button" class="form-control" id="addMain" value="Add Another Main Category" class="btn btn-default" data-toggle="modal" data-target="#addMain"/>
</div>