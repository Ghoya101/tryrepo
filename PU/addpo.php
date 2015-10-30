<?php 
include("nav.php");
$con = db_connect();

if(isset($_GET['proj']))
{
$PROJ = $_GET['proj'];
$EMPID = $empid;

//SQL FOR FETCHING 
$sql1 = "SELECT a.SURNAME AS SURNAME, a.FIRSTNAME AS FIRSTNAME,b.PROJID as PROJID, b.POCTR as POCTR	
from sms_clients a 
INNER JOIN sms_projects b ON a.CID = b.CID
WHERE b.PROJID = '$PROJ';";
$res1 = $con->query($sql1);
$ctr1 = $res1->num_rows;
if($ctr1)
{
	while($fet1=$res1->fetch_assoc())
	{
		$PROJID 	= $fet1['PROJID'];
		$POCTR 		= $fet1['POCTR'];
		$CLIENT 	=$fet1['FIRSTNAME'].' '.$fet1['SURNAME'];
			
		
	}
}
		
		?>
<link rel="stylesheet" href="../css/pur.css">
<body>
<?php
$sql2 = "SELECT * FROM `sms_projpo` WHERE PROJID = '$PROJ' AND STATUS = '1';"; //STATUS = 1 means OPEN PO
		$res2 = $con->query($sql2);
		$ctr2 = $res2->num_rows;
if($ctr2 >= 1) //if there is an open po
{
			while($fet2=$res2->fetch_assoc())
			{
				$POID = $fet2['POID'];
				$itemctr = $fet2['ITEMCTR'];
				$itemctr = intval($itemctr)+1;
			}
}else //new PO AND no PO to finalize
{
			$PCTR = intval($POCTR)+1;
			$POID = $PROJID." - ".$PCTR;
			$itemctr = 1;
}			
?>
<!--FORM FOR OPEN POs-->
<form name="PO FORM" class="po-form" Method="POST" action="func-po.php">
<div>

<table class="tblpo">
<input type="hidden" name="PROJID" value="<?php echo $PROJ;?>">
<input type="hidden" name="EMPID" value="<?php echo $EMPID;?>">
<tr class="trpo">
<td class="tdpo">PURCHASE ORDER ID</td>
<td class="tdpo"><input type="Text" class="inputpo" name="POID" value="<?php echo $POID;?>" readonly></td>
<td class="tdpo">CLIENT/OWNER</td>
<td class="tdpo"><input type="Text" class="inputpo" value="<?php echo $CLIENT;?>" readonly></td>
</tr> 
</table>



<table class="tbl_po1">		
<tr class="tbl_trpo">
<th colspan=7 style="text-align:center;">PARTICULARS</th>
</tr>
<tr class="tbl_trpo">
<th class="tbl_thpo" width=6%>ITEM NO</th>
<th class="tbl_thpo" width=40%>DESCRIPTION</th>
<th class="tbl_thpo" width=5%>QTY</th>
<th class="tbl_thpo" width=5%>UNIT</th>
<th class="tbl_thpo" width=10%>UNIT PRICE</th>
<th class="tbl_thpo" width=10%>AMOUNT</th>
</tr>
</table>


<?php
if($ctr2 >= 1)
{
?>
<!--TABLE FOR PO CONTENT-->
<table class="tbl_po2">		
<?php
$sqlall = "SELECT * from sms_pocontent WHERE POID = '$POID';";
$resall	= $con->query($sqlall);
$ctrall = $resall->num_rows;
if($ctrall >= 1)
{
	while($fetall=$resall->fetch_assoc())
	{
	$itemid = $fetall['ITEMID'];
	$desc	= $fetall['PODESC'];
	$qty 	= number_format($fetall['POQTY']);
	$unit	= $fetall['POUNIT'];
	$price 	= number_format( $fetall['POUNITPRICE'],2);
	$amount	= number_format($fetall['PCOTOTAL'],2);
?>
<tr class="tbl-po2-tr">
<td width=6%	style="text-align: center;"><?php echo $itemid;?></td>
<td width=40%	style="text-align: left;"><?php echo $desc;?></td>
<td width=5%	><?php echo $qty;?></td>
<td width=5%	><?php echo $unit;?></td>
<td width=10%	><?php echo $price;?></td>
<td width=10%	><?php echo $amount;?></td>
</tr>
<?php
	}
}
$sqlsum = "SELECT SUM(PCOTOTAL) as AMOUNT FROM `sms_pocontent` WHERE POID = '$POID';";
$ressum = $con->query($sqlsum);
while($fetsum = $ressum->fetch_assoc())
{
	$total = number_format($fetsum['AMOUNT'],2);
}
?>

<tr class="tr_content">
<td width=6%	><input type="text" name="ctr" style="text-align: center;"	value="<?php echo $itemctr;?>" readonly> </td>
<td width=40%	><input type="text" name="desc" /> </td>
<td width=5%	><input type="text" name="qty" /> </td>
<td width=5%	><input type="text" name="unit" /> </td>
<td width=10%	><input type="text" name="unitprice" /> </td>
<td width=10%	><input style="width:100%;font-size:20px;" name="cmdadd" type="submit" value="ADDITEM" class="rc-button rc-button-submit"/></td>
</tr>

<tr class="tr_content" style="background:#44749d;color:white;font-weight:bold;">
<td colspan=5>TOTAL</td>
<td colspan=5><?php echo $total;?></td>
</tr>
</table>
<?php
}
else
{
?>

<table id="po_tbl" class="tbl_po2">		
<tr class="tr_content">
<td width=6%	><input type="text" name="ctr" style="text-align: center;"	value="<?php echo $itemctr;?>" readonly> </td>
<td width=40%	><input type="text" name="desc" /> </td>
<td width=5%	><input type="text" name="qty" /> </td>
<td width=5%	><input type="text" name="unit" /> </td>
<td width=10%	><input type="text" name="unitprice" /> </td>
<td width=10%	><input style="width:100%;" name="cmdadd" type="submit" value="ADDITEM" class="rc-button rc-button-submit"/></td>
</tr>
</table>
<?php
}
?>
<input style="width: 10%;" type="submit" value="SUBMIT" name="cmdsubmitpo" class="rc-button rc-button-submit"/>
</form>
<?php
}//END IF PROJID ISSET
else
{
header("Location:index.php");
}
?>
</form>