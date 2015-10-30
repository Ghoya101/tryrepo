<?php
include("nav.php");
$con = db_connect();

$PO =$_GET['poid']; 
$USER = $empid;


$sql1 = "SELECT * from `sms_projpo` a inner join `sms_projects` b ON a.PROJID = b.PROJID 
		inner join `sms_clients` c ON b.CID = c.CID WHERE a.POID = '$PO' ;";
$res1 =$con->query($sql1);
$ctr1 = $res1->num_rows;
?>

<table class="po-action" width=100%>
<tr class="act">
<td  style="width:40%;height:50px;background:yellow;" colspan=2><textarea style="width:100%;height:100%;" type="TEXT AREA" name="note_content" placeholder="Comment Here For Revision1..."></textarea></td>
<?php
$sql5 = "SELECT * FROM `sms_costcat`;  ";
$res5 = $con->query($sql5);
?>

<td  style="width:40%;height:50px;background:blue;">
<select name="subcat" style="width:100%;">
<option value="" selected>-SELECT CATEGORY OF PO-</option>
<?PHP while($f5=$res5->fetch_assoc())
{
$cat = $f5['CATID']; 
$cdesc=$f5['DESCRIPTION'];  
?>
<option width='100px;' style="background:#dde7f7;font-weight:bold;padding:2px;" value="<?php echo '';?>"><?php echo $cat.'   '. $cdesc;?></option>
<?php
$sql6 = "SELECT * FROM `sms_subcat` WHERE CATID = '$cat';  ";
$res6 = $con->query($sql6);
while($f6=$res6->fetch_assoc())
{
$scat = $cat.'.'.$f6['SUBCATID']; 
$sdesc=$f6['DESCRIPTION']; 
$id = $f6['ID'];
?>
<option value="<?php echo $ID;?>"><?php echo $scat.' '. $sdesc;?></option>
<?php
}
}?>
</select>
</td>
<td width="20%"  rowspan=2><input class="act-rej" type="submit" name="cmd" value="REJECT"></td>
</tr>


<tr>
<td style="background:yellow;height:30px;" colspan=2><input height="100%" class="act-btn" type="submit" name="cmd" value="REVISE"></td>

<td style="background:yellow;"><input class="act-btn" type="submit" name="cmd" value="APPROVE"></td>
</tr>

<!--

<?php
$sql5 = "SELECT CATID as cat,DESCRIPTION as catdesc FROM `sms_costcat`;  ";
$sql6 = "SELECT CATID as cat ,SUBCATID as sub, DESCRIPTION as subdesc,ID as ID FROM `sms_subcat` ;";
$res5 = $con->query($sql5);
$res6 = $con->query($sql6);
?>
<tr>
<td>
<select name="subcat">
<option value="" selected>---SELECT SUBCATEGORY OF PO---</option>
<?PHP while($f6=$res6->fetch_assoc())
{
$cat = $f6['cat'];
$sub = $f6['sub'];
$desc=$f6['subdesc'];  
$catcat = $cat.'.'.$sub;$id=$f6['ID'];?>
<option value="<?php echo $id;?>"><?php echo $catcat.'   '. $desc;?></option>
<?php }?>
</select>
</td>
<td>
		<input type=hidden name="po-id" value="<?php echo $PO;?>">
		<input type="submit" name="cmd" value="REJECT">
		<input type="submit" name="cmd" value="REVISE">
	    <input type="submit" name="cmd" value="APPROVE">
</Td>
</tr>
-->

</table>