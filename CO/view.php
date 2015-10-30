<?php
include("cost-nav.php");
$conn = db_connect();
$PROJ = $_GET['proj']; 
$sql1 = "SELECT SURNAME, FIRSTNAME, pr.desc AS desc1, p.LOCATION AS site, lvl.DESCRIPTION AS desc2
FROM  `sms_clients` c
INNER JOIN  `sms_projects` p ON c.CID = p.CID
INNER JOIN  `sms_prod` pr ON p.PRODID = pr.prodid
INNER JOIN  `sms_levelno` lvl ON p.TYPEID = lvl.LVLID
WHERE p.PROJID =  '".$PROJ."' ";
$result1 = $conn->query($sql1);
$row_ctr = $result1->num_rows;
if($row_ctr >=1)
{
while($fetch1 = $result1->fetch_assoc())
	{
		$sname = $fetch1['SURNAME'];
		$fname = $fetch1['FIRSTNAME'];
		$name = $sname .','. $fname;	
		$prod = $fetch1['desc1'];
		$site = $fetch1['site'];
		$lvl = $fetch1['desc2'];
	
		


?>
<link rel="stylesheet" href="../css/costing.css">


<body>

<form name="cost estimate" class="form-content" Method="POST" action="">
<div name="division for New Opened Projects" style="background:#F0F0F0 ;overflow-x: scroll; ">
<label>PROJECT: Proposed <?php echo $prod .' '. $lvl;?>  </label>
<br>
<label>OWNER: <?php echo $name;?>  </label>
<br>
<label>LOCATION: <?php echo $site;?>  </label>
<?php
	}
}
else
{
	echo "SQL1 returned a false or zero result";
	
}?>

<table class="tr_cat">

<tr>
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
<th class="th1">F</th>
<th class="th1">AMOUNT</th>
</tr>

<tr>
<th width=2% style="Text-align: Right;">1</th>
<th width=25% style="Text-align: Left;">GENERAL REQUIREMENTS</th>
<th width=25%></th>
<th width=5%></th>
<th width=3%></th>
<th width=8%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%><input type="text" name=""></th>
<th width=30%></th>
</tr>

</tr>
<?php
$sql2 = "SELECT * FROM sms_subcat WHERE CATID = 1;";
$result2 =$conn->query($sql2);
while($fetch2 = $result2->fetch_assoc())
{
	$c = $fetch2['CATID'];
	$sc = $fetch2['SUBCATID'];
	$d  = $fetch2['DESCRIPTION'];
?>
<tr>
<td value="<?php echo $sc;?>" style="text-align: right;"><?php echo $c.'.'.$sc;?></td>
<td> <?php echo $d;?></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td></td>
<td><input type="text" name=""></td>

</tr>
<?php
}?>

<tr>
<th width=2% style="Text-align: Right;">2</th>
<th width=25% style="Text-align: Left;">SITEWORKS AND EARTHWORKS</th>
<th width=25%></th>
<th width=5%></th>
<th width=3%></th>
<th width=8%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%><input type="text" name=""></th>
<th width=30%></th>
</tr>

</tr>
<?php
$sql3 = "SELECT * FROM sms_subcat WHERE CATID = 2;";
$result3 =$conn->query($sql3);
while($fetch3 = $result3->fetch_assoc())
{
	$c = $fetch3['CATID'];
	$sc = $fetch3['SUBCATID'];
	$d  = $fetch3['DESCRIPTION'];
?>
<tr>
<td value="<?php echo $sc;?>" style="text-align: right;"><?php echo $c.'.'.$sc;?></td>
<td> <?php echo $d;?></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td></td>
<td><input type="text" name=""></td>

</tr>
<?php
}?>


<tr>
<th width=2% style="Text-align: Right;">3</th>
<th width=25% style="Text-align: Left;">CONCRETE WORKS</th>
<th width=25%></th>
<th width=5%></th>
<th width=3%></th>
<th width=8%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%><input type="text" name=""></th>
<th width=30%></th>
</tr>

</tr>
<?php
$sql4 = "SELECT * FROM sms_subcat WHERE CATID = 3;";
$result4 =$conn->query($sql4);
while($fetch4 = $result4->fetch_assoc())
{
	$c = $fetch4['CATID'];
	$sc = $fetch4['SUBCATID'];
	$d  = $fetch4['DESCRIPTION'];
?>
<tr>
<td value="<?php echo $sc;?>" style="text-align: right;"><?php echo $c.'.'.$sc;?></td>
<td> <?php echo $d;?></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td></td>
<td><input type="text" name=""></td>

</tr>
<?php
}?>


<tr>
<th width=2% style="Text-align: Right;">4</th>
<th width=25% style="Text-align: Left;">REINFORCEMENT</th>
<th width=25%></th>
<th width=5%></th>
<th width=3%></th>
<th width=8%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%></th>
<th width=10%><input type="text" name=""></th>
<th width=30%></th>
</tr>

</tr>
<?php
$sql5 = "SELECT * FROM sms_subcat WHERE CATID = 4;";
$result5 =$conn->query($sql5);
while($fetch5 = $result5->fetch_assoc())
{
	$c = $fetch5['CATID'];
	$sc = $fetch5['SUBCATID'];
	$d  = $fetch5['DESCRIPTION'];
?>
<tr>
<td value="<?php echo $sc;?>" style="text-align: right;"><?php echo $c.'.'.$sc;?></td>
<td> <?php echo $d;?></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td><input type="text" name=""></td>
<td></td>
<td><input type="text" name=""></td>

</tr>
<?php
}?>
</table>

</div>
</form>