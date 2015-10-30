<?php 
include("nav.php");
$con = db_connect();

if(isset($_POST['genreport']))
{
	$poid=$_GET['poidrep'];
	//echo '<script type="text/javascript">>window.open("PRINTPO.php?poid");</script>'
	$filepath = '../fpdf/PRINTPO.php?poid='.$poid;
	$handle = fopen("$filepath", "r");
}else
{
$PROJ = $_GET['proj']; 

?>

<link rel="stylesheet" href="../css/pur.css">
<form class="po-form" Method="POST" action="listpo.php">


<input style="width: 20%;float: left; margin-left: 0.5%;" class="rc-button rc-button-submit" 
type="button" value="+ PURCHASE ORDER" Onclick="window.location.href='addpo.php?proj=<?php echo $PROJ;?>'">
<br>

<?php
$sql1 ="SELECT * FROM `sms_projpo` WHERE PROJID = '$PROJ' AND STATUS = '0' order by PODATE desc;";
$res1 =$con->query($sql1);
$row1 = $res1->num_rows;
?>

<table class="PO">
<?php 
if($row1 == 0)
{
?>
<tr><td>NO PURCHASE RECORDS FOUND.</td></tr><table>
<?php		  
}
else
{?>
<tr class="POTH" >
<th>P.O. ID</th>
<th>PAYEE</th>
<th>AMOUNT</th>
<th>DATE CREATED</th>
<th>ACTION</th>
</tr>
<?PHP
while($fet1=$res1->fetch_assoc())
{
		$POID = $fet1['POID'];
		$POD  = $fet1['PODATE'];
		$date = date("M j, Y h:ia", strtotime($POD));		
		$PAYE = $fet1['PAYEE'];
		$COST = number_format($fet1['AMOUNT'],2);
?>
<tr class="POTR" >
<!--<input type=text name="pOrder" id="b" value="<?php echo $POID;?>"></td>-->
<td Onclick="window.location.href='viewpo.php?poid=<?php echo $POID;?>'"><?php echo $POID;?></td>
<td><?php echo $PAYE;?></td>
<td><?php echo $COST;?></td>
<td><?php echo $date;?></td>
<!--<td><input type="submit" name="genreport" value="PRINT"/>-->
<!--<td><input type="button" name="genreport" value="PRINT" onclick="print()"/>-->
<script>
var a = "../fpdf/PO.php?poid="<?php echo $POID;?>

</script>
<!--<td><input type="button" name="genreport" value="PRINT <?PHP ECHO $POID;?>" onclick="window.open(<?php echo "../fpdf/PO.php?poid=".$POID;?>)"/>-->
<td><a href='<?php echo "../fpdf/PO.php?poid=".$POID;?>' target="_blank">PRINT</a></td>
</tr>

<?php				
}//END OF WHILE
}//END OF ELSE
}//END OF ELSE
?>
</table>
</form>
