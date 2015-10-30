<?php 
include("connection/config.php");
require_once('PU/functions.php');
$con=db_connect();
$POID = '1 - 1';
$sql4 = "SELECT * FROM `sms_projpo` a inner join `sms_projects` b ON a.PROJID = b.PROJID inner join `sms_admin` c ON b.PURCHASINGID = c.EMPID WHERE POID = '$POID' ";
$res4 = $con->query($sql4);
	while($c=$res4->fetch_assoc())
	{
		$prepby = ($c['EMPNAME'][0]).''.($c['EMPMID'][0]).''.($c['EMPSURNAME'][0]); 
		$PODATE=$c['PODATE'];
	}


$query  = "SELECT * FROM sms_projpo WHERE POID = '$POID';";
$run	= $con->query($query);
$ctr	= $run->num_rows;
if($ctr!=0)
{

while($f1=$run->fetch_assoc())
{
$checker = $f1['CHECKER'];
$cdate	 = $f1['APPROVEDATE'];
$acct	 = $f1['RECOMMENDEDBY'];
$adate   = $f1['RECDATE'];
$approve = $f1['APPROVEDBY'];
$apdate  = $f1['APPDATE'];
$disburst= $f1['DISBURSTBY'];
$ddate   = $f1['DISDATE'];
}
//checked by
if($checker == 0)
{$ch = 'Pending';$chdate = 'Pending';
}else
{$q2 ="SELECT * FROM `sms_admin` WHERE EMPID = '$checker';";$r2 =$con->query($q2);
	while($a = $r2->fetch_assoc())
	{$ch = ($a['EMPNAME'][0]).''.($a['EMPMID'][0]).''.($a['EMPSURNAME'][0]);}$chdate = date('m/d/Y',strtotime($cdate));
}
//recommended by
if($acct == 0)
{
$acctg = 'Pending';
$acdate = 'Pending';
}else
{
$q3 ="SELECT * FROM `sms_admin` WHERE EMPID = '$acct';";
$r3 =$con->query($q3);
while($a = $r3->fetch_assoc())
{$acctg = ($a['EMPNAME'][0]).''.($a['EMPMID'][0]).''.($a['EMPSURNAME'][0]);}
$acdate = date('m/d/Y',strtotime($adate));
}
//approved by
if($approve == 0)
{
$app = 'Pending';
$apdate = 'Pending';
}else
{
$q4 ="SELECT * FROM `sms_admin` WHERE EMPID = '$approve';";
$r4 =$con->query($q4);
while($a = $r4->fetch_assoc())
{$app = ($a['EMPNAME'][0]).''.($a['EMPMID'][0]).''.($a['EMPSURNAME'][0]);}
$apdate = date('m/d/Y',strtotime($apdate));
}
//disburst by
if($disburst == 0)
{
$dis = 'Pending';
$disdate = 'Pending';
}else
{
$q5 ="SELECT * FROM `sms_admin` WHERE EMPID = '$disburst';";
$r5 =$con->query($q5);
while($a = $r5->fetch_assoc())
{$dis = ($a['EMPNAME'][0]).''.($a['EMPMID'][0]).''.($a['EMPSURNAME'][0]);}
$disdate = date('m/d/Y',strtotime($ddate));
}
}

?>
<table class="po-acctg" STYLE="width: 100%;margin-left:0;border:1px solid #FFB608;">
<tr>
<th colspan=8>PLEASE DO NOT FILL UP ACCOUNTING USE ONLY</th>
</tr>
<?php
$AMOUNT = '11600.25';
$amount = explode('.',$AMOUNT); 
$num_arr = count($amount);

if($num_arr == 2)
{
$AMOUNT = number_format($AMOUNT, 2, '.', '');
$amount = explode('.',$AMOUNT); 
$whole = $amount[0]; 
$dec = $amount[1];
$cents = $dec.'/100';
$words = convert_number_to_words($whole); 
$amountinwords = "***".$words." & ".$cents."***";
}else
{
$words = convert_number_to_words($AMOUNT); 
$amountinwords = "***".$words." PESOS ONLY***";
}

?>


<tr>
<td colspan=8><?php echo $amountinwords;?></td>
</tr>

<tr class="status-label">
<td colspan=8>AMOUNT IN WORDS</td>
</tr>
<tr class="">
<td	colspan=2	style="background:#C7D5EB;border:1px solid #000;">CHARGED TO</td>
<td	width="10%"	style="background:#C7D5EB;border:1px solid #000;">DEBIT</td>
<td	width="10%"	style="background:#C7D5EB;border:1px solid #000;">CREDIT</td>
<td	width="15%"	STYLE="text-align:left;"						>PREPARED BY</td>
<td	width="5%"													><?php echo $aa.''.$ab.''.$ac;?></td>
<td	width="5%"	STYLE="text-align:left;"						>DATE</td>
<td	width="15%"													><?php echo date('m/d/Y',strtotime($PODATE));?></td>
</tr>




<td	colspan=2	></td>
<td				></td>
<td				></td>
<td				STYLE="text-align:left;"						>CHECKED BY</td>
<td				><?php echo $ch; ?></td>
<td				STYLE="text-align:left;"						>DATE</td>
<td				><?php   ECHO $chdate;?></td>
</tr>

<tr class="">
<td	colspan=2	></td>
<td				></td>
<td				></td>
<td				STYLE="text-align:left;"						>RECOMMENDED BY</td>
<td				><?php echo $acctg; ?></td>
<td				STYLE="text-align:left;"						>DATE</td>
<td				><?php echo $acdate;?></td>
</tr>

<td	colspan=1	>RECEIVED BY</td>
<td				>CIB</td>
<td				></td>
<td				></td>
<td				STYLE="text-align:left;"						>APPROVED BY</td>
<td				><?php echo $app; ?></td>
<td				STYLE="text-align:left;"						>DATE</td>
<td				><?php echo $apdate; ?></td>
</tr>

<td	colspan=1	>DATE RECEIVED</td>
<td				>TOTAL</td>
<td				>-</td>
<td				>-</td>
<td				STYLE="text-align:left;"						>DISBURST BY</td>
<td				><?php echo $dis; ?></td>
<td				STYLE="text-align:left;"						>DATE</td>
<td				><?php echo $disdate; ?></td>
</tr>



</table>


