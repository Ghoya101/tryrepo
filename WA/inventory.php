<?php
include("nav.php");
$con = db_connect();
?>

<link rel="stylesheet" href="../css/inventory.css">
<form>
<table CLASS="tbl1">
<tr class="tr1">
<td style="width:2%;">#</td>
<td style="width:8%;">REF #</td>
<td style="width:10%;">EQUIPMENT</td>
<td style="width:10%;">MANUFACTURER</td>
<td style="width:10%;">MODEL #</td>
<td style="width:2%;">QTY</td>
<td style="width:8%;">UOM</td>
<td style="width:10%;">CONDITION</td>
<td style="width:10%;">LOCATION</td>
<td style="width:10%;">IN-CHARGE</td>
<td style="width:10%;">IMAGE</td>
<td style="width:10%;">REMARKS</td>
</tr>

<tr class="tr2">
<td>1</td>
<td><textarea style="width:100%;"></textarea></td>
<td><textarea style="width:100%;"></textarea></td>
<td><textarea style="width:100%;"></textarea></td>
<td><textarea style="width:100%;"></textarea></td>
<td><textarea style="width:100%;"></textarea></td>
<td><textarea style="width:100%;"></textarea></td>
<td><textarea style="width:100%;"></textarea></td>
<td><textarea style="width:100%;"></textarea></td>
<td><textarea style="width:100%;"></textarea></td>
<td>  <input type="file" name="fileToUpload" id="fileToUpload"></td>
<td><textarea style="width:100%;"></textarea></td>

</tr>
<tr>
<td><input type="button" CLASS="" value="ADD ITEM"></td>
</tr>
</table>


</form>