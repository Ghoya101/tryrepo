<?php 
include("pur-nav.php");
$con = db_connect();
$emp = $empid;
?>

<link rel="stylesheet" href="../css/pur.css">
<body>

<!--FORM FOR OPEN POs-->
<form class="po-form" Method="POST" action="func-po.php">
<div>

<table class="tblpo">
<input type="hidden" name="PROJID" value="<?php echo '$PROJ';?>">
<input type="hidden" name="EMPID" value="<?php echo '$EMPID';?>">
<tr class="trpo">
<td class="tdpo">PURCHASE ORDER ID</td>
<td class="tdpo"><input type="Text" class="inputpo" name="POID" value="<?php echo '$POID';?>" readonly></td>
<td class="tdpo">CLIENT/OWNER</td>
<td class="tdpo"><input type="Text" class="inputpo" value="<?php echo '$CLIENT';?>" readonly></td>
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


<!--TABLE FOR PO CONTENT-->
<table class="tbl_po2">		
<tr class="tr_content1">
<td width=6%	style="text-align: center;"><?php echo '$itemid';?></td>
<td width=40%	style="text-align: left;"><?php echo '$desc';?></td>
<td width=5%	><?php echo '';?></td>
<td width=5%	><?php echo '';?></td>
<td width=10%	><?php echo '';?></td>
<td width=10%	><?php echo '';?></td>
</tr>


<tr class="tr_content">
<td width=6%	><input type="text" name="ctr" style="text-align: center;"	value="<?php echo '$itemctr';?>" readonly> </td>
<td width=40%	><input type="text" name="desc" /> </td>
<td width=5%	><input type="text" name="qty" /> </td>
<td width=5%	><input type="text" name="unit" /> </td>
<td width=10%	><input type="text" name="unitprice" /> </td>
<td width=10%	><input style="width:100%;" name="cmdadd" type="submit" value="ADDITEM" class="rc-button rc-button-submit"/></td>
</tr>

<tr class="tr_content2">
<td colspan=5>TOTAL</td>
<td colspan=5><?php echo '$total';?></td>
</tr>
</table>

<table id="po_tbl" class="tbl_po2">		
<tr class="tr_content">
<td width=6%	><input type="text" name="ctr" style="text-align: center;"	value="<?php echo '$itemctr';?>" readonly> </td>
<td width=40%	><input type="text" name="desc" /> </td>
<td width=5%	><input type="text" name="qty" /> </td>
<td width=5%	><input type="text" name="unit" /> </td>
<td width=10%	><input type="text" name="unitprice" /> </td>
<td width=10%	><input style="width:100%;" name="cmdadd" type="submit" value="ADDITEM" class="rc-button rc-button-submit"/></td>
</tr>
</table>

<input style="width: 10%;" type="submit" value="SUBMIT" name="cmdsubmitpo" class="rc-button rc-button-submit"/>
</form>

<input style="width: 10%;" type="submit" value="SUBMIT" name="cmdsubmitpo" class="rc-button rc-button-submit"/>
</form>