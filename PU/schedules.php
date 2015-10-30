<?php
include("nav.php");
$EMP = $empid;
$query1 	= "SELECT * FROM `sms_projects` a inner join `sms_clients` b ON a.CID = b.CID
				inner join `sms_admin` c ON a.PURCHASINGID = c.EMPID WHERE PURCHASINGID = '$EMP';";
$result1 	= db_connect()->query($query1);
$count1 	= $result1->num_rows;


?>
<link rel="stylesheet" href="../css/sched.css">

<center>
<form class="schedules">
<table class="tbl1">
<tr>
<td colspan=10><input class="btn" type="button" style="width:20%;" value="+  DELIVERY/ PICK UP SCHEDULE"/></td>
</tr>
<tr >
<td>Delivery Place</td>
<td><textarea style="width:100%;"></textarea ></td>
<td>Delivery Date</td>
<td><input type=date></td>
<td>Authorize Receiver</td>
<td><input type=text></td>
</tr>

<tr class="tr">
<td>Payee</td>
<td><input type=text></td>
<td>Contact Number</td>
<td><input type=text></td>
<td>Contact Number</td>
<td><input type=text></td>
</tr>

</table>


<table class="tbl2">
<tr>
<td style="WIDTH:10%';">ITEM #</td>
<td style="width:60%;">PARTICULARS</td>
<td>QUANTITY</td>
<td>ACTION</td>

</tr>

<tr>
<td>1</td>
<td><textarea style="width:100%;"></textarea></td>
<td><input type=text></td>
<td><input class="btn" type="button" style="width:100%;" value="+ ADD SCHEDULE"/></td>

</tr>

</table>



</form>
</center>