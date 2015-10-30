<?php
include("nav.php");
$proj = $_GET['proj'];

$query1 	= "SELECT * FROM `sms_projects` a inner join `sms_clients` b ON a.CID = b.CID 
				inner join `sms_prod` d ON a.PRODID = d.prodid
				inner join `sms_levelno` e ON a.TYPEID = e.LVLID
				 WHERE a.PROJID = '$proj' ;";
$result1 	= db_connect()->query($query1);
$count1 	= $result1->num_rows;
if($count1 != 0)
{
while($a1 = $result1->fetch_assOc())
{

$CLIENT = $a1['FIRSTNAME'].' '.$a1['SURNAME'];
$PROJECT = $a1['PROJID'];
$SITE = $a1['LOCATION'];
$date1= $a1['STARTDATE'];
$prod = $a1['desc'];
$type = $a1['DESCRIPTION'];
}

$query2 	= "SELECT * FROM `sms_subsubcat` WHERE PROJID = '$proj' ;";
$result2 	= db_connect()->query($query2);
?>

<link rel="stylesheet" href="../css/monitoring.css">
<body>


<form class="content">
<div class="clickable">
<label for="the-checkbox"><?PHP echo 'OWNER: '.$CLIENT;?></label>
<input type="checkbox" id="the-checkbox"> <p></p>
<div class="appear">
<div><?PHP echo 'PROJECT: Proposed '.$prod.' '.$type;?></div>
<div><?PHP echo 'LOCATION: '.$SITE;?></div>
<div><?PHP echo 'DATE: '.$date1	;?></div>
</div>
</div>


<table class="tbl1">	
<tr>
<td><br>
</td>
</tr>
<tr class="tbl1-tr-hdr">
<th width=2% >ID</th>
<th width=25% >SCOPE OF WORKS</th>
<th width=25%>DIGEST OF SPECIFICATIONS</th>
<th width=3%>AMOUNT</th>
<th width=8%>PO ID</th>
<th width=8%>STATUS</th>
</tr>








<?php
$sql1 = "SELECT CATID as cat,DESCRIPTION as cdesc FROM `sms_costcat` ;";
$res1 = $con->query($sql1);
while($fetch1=$res1->fetch_assoc())
{	
	$a = $fetch1['cat'];
	$b = $fetch1['cdesc'];

?>
<!--GENERAL CATEGORIES-->
<tr style="background: #f7faff;" class="tbl1-tr-hdr">
<td style="Text-align: Right;font-weight: bold;color:#788CAF;font-size:16px;"><?php echo $a;?></td>
<td style="Text-align: Left;font-weight: bold;color:#788CAF;font-size:16px;"><?php echo $b;?></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
</tr>
<?php 
$sql2 = "SELECT SUBCATID as scat, DESCRIPTION AS sdesc, ID as id FROM `sms_subcat` WHERE CATID = $a ;";
$res2 = $con->query($sql2);
while($fetch2=$res2->fetch_assoc())
{
	$c = $fetch2['scat'];
	$d = $fetch2['sdesc'];
	$id = $fetch2['id'];
	$sql3 = "SELECT * FROM `sms_subsubcat` WHERE cat1Id = '$a' AND cat2Id = '$c';";
	$res3 = $con->query($sql3);
	while($fetch3=$res3->fetch_assoc())
	{
	$amount =$fetch3['AMOUNT'];
	$specs  =$fetch3['DIGOFSPEC'];
	
?>
<!--SUBCAT-->
<tr class="tbl1-tr-hdr">
<td value="<?php echo $id;?>" style="text-align: right;"><?php echo $a.'.'.$c;?></td>
<td><?php echo $d;?></td>
<td><?php echo $specs;?></td>
<td style="text-align: right;"><?php echo number_format($amount,2);?></td>
<td>
<?php 
$queryme = "SELECT * FROM `sms_projpo` WHERE PROJID = '$proj' and CAT = '$id'";
$run	 = $con->query($queryme);
while($r = $run->fetch_assoc()){ $pos = $r['POID']; 
?>
<label Onclick="window.location.href='viewpo.php?poid=<?php echo $pos;?>'"><?php echo $pos.',';}?></label></td>
<td style="text-align:right;">
<?php
$query1 = "SELECT SUM(AMOUNT) as sum FROM `sms_projpo` WHERE PROJID = '$proj' and CAT = '$id'";
$run1	 = $con->query($query1);
while($b =$run1->fetch_assoc()){$total = floatval($b['sum']);}
$alloted = floatval($amount) - $total;
if($alloted >= 0)
{ $statcol = "positive";}else if($alloted < 0){$statcol = "negative";}
?>
<label class="<?php echo $statcol;?>"><?php echo number_format($alloted,2);?></label></td>
</tr>
<?php
}// END OF WHILE FOR content
}//END OF WHILE FOR SUBCATS
?>
<tr class="tbl1-tr-hdr">
<td colspan=6><input type="text" name=""></td>
</tr>
<?php
}//END OF WHILE FOR GENERAL CATEGORIES
}
?>


</table>

</form>
</body>