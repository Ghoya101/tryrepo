<?php
include("nav.php");
$con = db_connect();
$EMP = $empid;

$query1 = "SELECT * FROM `sms_pcfcat` ;";
$run1	= $con->query($query1);
$count	= $run1->num_rows;

?>
<link rel="stylesheet" href="../css/new_pcf.css">
<form>
<table class="pcf-tbl1">
<tr class="pcf-tr1">
<td>~</td>
<td>DATE</td>
<td>SUPPLIER</td>
<td>ADDRESS</td>
<td>TIN</td>
<td>NONVAT</td>
<td>OR NO</td>
<td>PARTICULARS</td>
<td>AMOUNT</td>
</tr>

<?php 
if($count == 0)
{?>
<tr>
<td colspan=9>NO PCF CATEGORIES.</td>
</tr>

<?php
}
else{
$i;	
for($i=1;$i<=$count;$i++)
while($a = $run1->fetch_assoc())
{
$id	 = $a['ID'];
$cat = $a['CATEGORY'];
?>
<tr class="pcf-tr2">
<td COLSPAN=9><?php echo $i.' '.$cat;?><input style="float:right;" class="" type=button name="" value="+"></td>
</tr>

<?php
$i++;
}
}
?>
</table>

</form>