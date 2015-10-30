<?php
include("nav.php");
$con = db_connect();

$PROJ = $_GET['proj'];
$POID = $_GET['poid'];

$sql1 = "SELECT a.SURNAME AS SURNAME, a.FIRSTNAME AS FIRSTNAME,b.PROJID as PROJID, b.POCTR as POCTR,
d.ITEMID as ITEMID, d.PODESC AS PODESC, d.POQTY AS POQTY, d.POUNIT AS UNIT, d.POUNITPRICE AS PRICE, d.PCOTOTAL AS TOTALPRICE, sum(PCOTOTAL) AS AMOUNT
from sms_clients a 
INNER JOIN sms_projects b ON a.CID = b.CID
INNER JOIN sms_projpo c ON b.PROJID = c.PROJID
INNER JOIN sms_pocontent d ON c.POID = d.POID
WHERE b.PROJID = '$PROJ' AND c.POID= '$POID';";
$res1 = $con->query($sql1);
$ctr1 = $res1->num_rows;
if($ctr1)
{
	while($fet1=$res1->fetch_assoc())
	{
		$PROJID 	= $fet1['PROJID'];
		$POCTR 		= $fet1['POCTR'];
		$CSNAME   	= $fet1['SURNAME'];
		$CFNAME   	= $fet1['FIRSTNAME'];
		$CLIENT 	= $CFNAME.' '.$CSNAME;
	}
?>
<link rel="stylesheet" href="../css/pur.css">
<br>
<form name="PO FORM" class="po-form" Method="POST" action="finalize.php">
<div>
<table class="tbl_po1">
<input type="hidden" name="PROJID" value="<?php echo $PROJ;?>">
<input type="hidden" name="EMPID" value="<?php echo $EMPID;?>">
<input type="hidden" name="POID" value="<?php echo $POID;?>">
 

<tr>
<td class="td1">PURCHASE ORDER ID</td>
<td class="td1" colspan=2><?php echo $POID;?></td>
<td class="td1">CLIENT/OWNER</td>
<td class="td1" colspan=2><?php echo $CLIENT;?></td>
</tr> 

<tr>
<td class="td1" >PAYEE NAME</td>
<td class="td1" ><input type="TEXT" class="inp_po" name="payee"></td>
<td class="td1">PAYEE ACCOUNT NO</td>
<td class="td1" ><input type="TEXT" class="inp_po" name="paccount"></td>
<td class="td1">BANK</td>
<td class="td1" ><input type="TEXT" class="inp_po" name="pbank"></td>
</tr>

<tr>
<td class="td1" >CONTACT PERSON</td>
<td class="td1" ><input type="TEXT" class="inp_po" name="contact"></td>
<td class="td1" >CONTACT NO</td>
<td class="td1" ><input type="TEXT" class="inp_po" name="contactno"></td>
<td class="td1" >TERMS</td>
<td class="td1" ><input type="TEXT" class="inp_po" name="terms" placeholder="# of Days"></td>
</tr>

<tr>
<td class="td1">DELIVERY DATE</td>
<td class="td1"><input type="DATE" class="inp_po" name="ddate"></td>
<td class="td1">DELIVERY PLACE</td>
<td class="td1"><input type="TEXT" class="inp_po" name="dplace"></td>
<td class="td1">AUTHORIZE RECEIVER</td>
<td class="td1"><input type="TEXT" class="inp_po" name="receiver"></td>
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


<?php
$sql2 = "SELECT * FROM `sms_pocontent` WHERE `POID` = '$POID';";
$res2 = $con->query($sql2);
$ctr2 = $res2->num_rows;
$TOTAL = 0;
while($fet2=$res2->fetch_assoc())
{
$ITEM 	= $fet2['ITEMID'];
$DESC 	= $fet2['PODESC'];
$QTY 	= $fet2['POQTY'];
$UNIT 	= $fet2['POUNIT'];
$PRICE 	= number_format($fet2['POUNITPRICE'],2);
$TPRICE = number_format($fet2['PCOTOTAL'],2);
$TOTAL 	+= $fet2['PCOTOTAL'];
?>
<tr class="tr-co">
<td width=6%	class="tdc"><?php echo $ITEM;?></td>
<td width=40%	class="tdl"><?php echo $DESC;?></td>
<td width=5%	class="tdr"><?php echo $QTY;?></td>
<td width=5%	class="tdr"><?php echo $UNIT;?></td>
<td width=10%	class="tdr"><?php echo $PRICE;?></td>
<td width=10%	class="tdr"><?php echo $TPRICE;?></td>
</tr>
<?PHP
}?>


<tr>
<td style="text-align:left;" colspan=6>NOTES
</td>
</tr>
<?php
$que = "SELECT * FROM `sms_ponotes` WHERE `POID` = '$POID';";
$res = $con->query($que);
$row = $res->num_rows;
$TOTAL = 0;
while($aaa=$res->fetch_assoc())
{
$notes = $aaa['CONTENT'];
?>
<tr>
<td style="border-bottom:none;border-top:none;text-align:left;" colspan=6><?php echo $notes;?>
</td>
</tr>
<?php }?>
<tr>
<td colspan=6>
<div class="clickable">
<label for="the-checkbox"><?PHP echo 'ADD NOTES';?></label>
<input type="checkbox" id="the-checkbox"> <p></p>
<div class="appear">
<div>
<?php?>
<input type="hidden" name="poid" value="<?php echo $POID;?>">
<input type="hidden" name="PROJ" value="<?php echo $PROJ;?>">
<input style="display: block;" type="text" name="note" placeholder="Type notes here">
<input style="display: block;background:#4D90FE;color:#fff;" type="submit" name="addnotes" value="ADD">
</div>
</div>
</div>

</td>
</tr>
<?php
$q2 = "SELECT sum(PCOTOTAL) as ey FROM `sms_pocontent` WHERE POID = '$POID'";
$r2 = db_connect()->query($q2);	 
WHILE($re=$r2->fetch_assoc())
$sum = $re['ey'];
?>

<tr class="tr-co" style="background:#44749d;color:white;font-weight:bold;">
<td colspan=5>TOTAL</td>
<td colspan=5><?php echo number_format($sum,2) ;?></td>
</tr>
</table>
</div>

<input style="width: 10%;" type="submit" value="SUBMIT" name="finalize" class="rc-button rc-button-submit"/>
<input style="width: 10%;float: left; margin-left: 0.5%;" class="rc-button rc-button-submit" type="button" value="BACK" Onclick="window.location.href='addpo.php?proj=<?php echo $PROJ;?>'">

</form>
<?php
}
?>

</BODY>
</HTML>