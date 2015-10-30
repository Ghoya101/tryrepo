<?php
include("../connection/config.php");
$con = db_connect();
$poid = $_GET['poid'];
$sql = "SELECT * FROM `sms_projpo` WHERE POID = '$poid' ;";
$res = $con->query($sql);
while($A = $res->fetch_assoc()){ 
$AMOUNT = $A['AMOUNT']; 
$CVNO = $A['CVNO'];
$CHECKNO = $A['CHECKNO'];
$CHECKDATE = $A['CHECKDATE'];
$PODATE = $A['PODATE'];
$CVDATE = $A['CVDATE'];
$DELIVERYDATE = $A['DELIVERYDATE'];
$DELIVERYPLACE = $A['DELIVERYPLACE'];
$RECEIVER = $A['RECEIVER'];
$RECEIVEDATE = $A['RECEIVEDDATE'];
$PACCOUNT = $A['PACCOUNT'];
$PAYEE = $A['PAYEE'];
$BANK = $A['BANK'];
$CONTACT = $A['CONTACT'];
$CONTACTNO = $A['CONTACTNO'];
$APPROVEDATE = $A['APPROVEDATE'];
}

$sql1 = "SELECT * FROM `sms_pocontent` WHERE POID = '$poid' ;";
$res1 = $con->query($sql1);
$ctr1 = $res1->num_rows;
?>
<link rel="stylesheet" href="../css/poreport.css" media="print">

<form name="">

<table class="tbl">
<tr>
<th>ITEM ID</td>
<th>DESCRIPTION</td>
<th>QTY</td>
<th>UOM</td>
<th>UNIT PRICE</td>
<th>AMOUNT</td>
</tr>



<?php while($B= $res1->fetch_assoc()){ 
//PO ITEM CONTENT
for($i=1;$i<$ctr1;$i++)
?>
<tr>
<td><?php echo '';?></td>
</tr>

<?php }?>
</table>

</form>
