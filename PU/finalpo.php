<?php
//http://localhost/sms10/PU/submit.php?proj=1&&poid=1%20-%201

include("nav.php");
$con = db_connect();

$PROJ = $_GET['proj'];
$POID = $_GET['poid'];

$sql1 = "SELECT a.SURNAME AS SURNAME, a.FIRSTNAME AS FIRSTNAME,b.PROJID as PROJID, b.POCTR as POCTR,
d.ITEMID as ITEMID, d.PODESC AS PODESC, d.POQTY AS POQTY, d.POUNIT AS UNIT, d.POUNITPRICE AS PRICE
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

<script>
function additem()
{
var proj = document.getElementById("projid").value;
var po	 = document.getElementById("po").value;
var desc = document.getElementById("desc").value;
var qty  = document.getElementById("qty").value;
var unit = document.getElementById("unit").value ;
var up	 = document.getElementById("unitprice").value ;
var total= qty * up;


var a = "po-final.php?additem=Yes&&projid="+proj+"&&po="+po+"&&desc="+desc+"&&qty="+qty+"&&unit="+unit+"&&up="+up;
//document.getElementById('showme').innerHTML = a;
window.location.href=a;



}
</script>

<link rel="stylesheet" href="../css/pur.css">
<br>

<div id="showme">hey</div>
<form name="PO FORM" class="po-form" Method="POST" action="po-final.php">
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
$i;	
$x;	
for($x=1;$x<=$ctr2;$x++)
for($i=1;$i<=$ctr2;$i++)

while($fet2=$res2->fetch_assoc())
{
$DESC 	= $fet2['PODESC'];
$QTY 	= $fet2['POQTY'];
$UNIT 	= $fet2['POUNIT'];
$PRICE 	= number_format($fet2['POUNITPRICE'],2);
$t = ($fet2['POQTY'])* ($fet2['POUNITPRICE']);
$TPRICE = number_format($t,2);
$TOTAL 	+= $t;
?>
<tr class="tr-co" style="font-size:14px;">
<td width=6%	class="tdc" style="font-size:14px;"><?php echo $x;?></td>
<td width=40%	class="tdl" style="font-size:14px;"><?php echo $DESC;?></td>
<td width=5%	class="tdr" style="font-size:14px;"><?php echo $QTY;?></td>
<td width=5%	class="tdr" style="font-size:14px;"><?php echo $UNIT;?></td>
<td width=10%	class="tdr" style="font-size:14px;"><?php echo $PRICE;?></td>
<td width=10%	class="tdr" style="font-size:14px;"><?php echo $TPRICE;?></td>
</tr>
<?PHP
$x++;
}

?>

<tr class="tr_content">
<input type=hidden name="po" id="po" value="<?php echo $POID;?>"/>
<input type=hidden name="pr" id="projid" value="<?php echo $PROJ;?>"/>
<td width=6%	><input type="text" name="ctr" style="text-align: center;"	value="<?php echo $i;?>" readonly> </td>
<td width=40%	><input type="text" name="desc" id="desc"/> </td>
<td width=5%	><input type="text" name="qty" id="qty"/> </td>
<td width=5%	><input type="text" name="unit" id="unit"/> </td>
<td width=10%	><input type="text" name="unitprice" id="unitprice"/> </td>
<td width=10%	><input style="width:100%;font-size:20px;" name="cmdadd" type="button" value="ADDITEM" class="rc-button rc-button-submit" onclick="additem()"/></td>
</tr>
<?PHP
$i++;
?>
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
$q2 = "SELECT * FROM `sms_pocontent` WHERE POID = '$POID'";
$r2 = db_connect()->query($q2);	
$ctr = $r2->num_rows;
$sum = 0;
WHILE($re=$r2->fetch_assoc())
{
$t = ($re['POQTY'])* ($re['POUNITPRICE']);
$sum += $t;
}
?>

<tr class="tr-co" style="background:#44749d;color:white;font-weight:bold;">
<td colspan=5>TOTAL</td>
<td colspan=5><?php echo number_format($sum,2) ;?></td>
</tr>
</table>
</div>

<input style="width: 10%;" type="submit" value="SUBMIT" name="finalize" class="rc-button rc-button-submit"/>
<input style="width: 10%;" class="rc-button rc-button-submit" type="button" value="BACK" Onclick="window.location.href='addpo.php?proj=<?php echo $PROJ;?>'">

</form>
<?php
}
?>

</BODY>
</HTML>