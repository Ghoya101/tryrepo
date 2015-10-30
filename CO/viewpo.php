<?php
include("nav.php");
$con = db_connect();

$PO =$_GET['poid']; 
$USER = $empid;
$proj = $PO[0];

$sql1 = "SELECT * from `sms_projpo` a inner join `sms_projects` b ON a.PROJID = b.PROJID 
		inner join `sms_clients` c ON b.CID = c.CID WHERE a.POID = '$PO' ;";
$res1 =$con->query($sql1);
$ctr1 = $res1->num_rows;
?>
<?php
$PO =$_GET['poid'];
$q1	="SELECT * FROM `sms_projpo` WHERE POID = '$PO';"; 
$r1 =$con->query($q1);
while($f1=$r1->fetch_assoc())
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
{
$ch = 'Pending';
$chdate = 'Pending';
}else
{
$q2 ="SELECT * FROM `sms_admin` WHERE EMPID = '$checker';";
$r2 =$con->query($q2);
while($a = $r2->fetch_assoc())
{$ch = ($a['EMPNAME'][0]).''.($a['EMPMID'][0]).''.($a['EMPSURNAME'][0]);}
$chdate = date('m/d/Y',strtotime($cdate));
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
?>
<link rel="stylesheet" href="../css/po-form.css">
<form class="po-form" Method="POST" action="approve-reject-revise.php">
<input class="back" type=button value="BACK" Onclick="window.location.href='po.php?proj=<?php echo $proj;?>&&stat=APPROVE'">

<!--PO INFO TABLE-->
<br	>
<table class="po-info">
<?php if($ctr1 == 0 ){?>
<tr>
<td><?php echo "NO ITEM FOUND UNDER THIS PO ID.";?></td>
</tr>
<?php }else
{
while($A = $res1->fetch_assoc()){
$CAT 			= $A['CAT']; 
$CLIENT 		= $A['SURNAME']; 	
$AMOUNT 		= $A['AMOUNT']; 
$CVNO 			= $A['CVNO'];
$CHECKNO 		= $A['CHECKNO'];
$CHECKDATE 		= $A['CHECKDATE'];
$PODATE 		= date('m/d/Y',strtotime($A['PODATE']));
$CVDATE 		= $A['CVDATE'];
$DELIVERYDATE 	= $A['DELIVERYDATE'];
$DELIVERYPLACE 	= $A['DELIVERYPLACE'];
$RECEIVER 		= $A['RECEIVER'];
$RECEIVEDATE 	= date('m/d/Y',strtotime($A['RECEIVEDDATE']));
$PACCOUNT 		= $A['PACCOUNT'];
$PAYEE 			= $A['PAYEE'];
$BANK 			= $A['BANK'];
$CONTACT 		= $A['CONTACT'];
$CONTACTNO 		= $A['CONTACTNO'];
$TERMS 			= $A['TERMS'];
$APPROVEDATE 	= $A['APPROVEDATE'];	

//CHECKDATE VALIDATION
if($CHECKDATE == '0000-00-00')
{ 
$CHECKDATE = 'System generated.';
}else
{
$CHECKDATE = date('m/d/Y',strtotime($A['CHECKDATE']));
}
//CVDATE VALIDATION
if($CVDATE == '0000-00-00')
{
$CVDATE = 'System generated.';
}else
{
$CVDATE = date('m/d/Y',strtotime($A['CVDATE']));
}
//APPROVEDATE VALIDATION
if($APPROVEDATE == '0000-00-00')
{	
$out='';$CVDATE = $out ; 
}else
{$APPROVEDATE = date('m/d/Y',strtotime($A['APPROVEDATE']));
}
//DELIVERY DATE VALIDATION
if($DELIVERYDATE == '0000-00-00')
{	
$DELIVERYDATE = '';
}else
{$DELIVERYDATE = date('m/d/Y',strtotime($A['DELIVERYDATE']));
}
//CVNO VALIDATION
if($CVNO == '0')
{
$CVNO ='For accounting use only';
} 
//CHECKNO VALIDATION
if($CHECKNO =='0')
{ 
$CHECKNO = 'For admin use only';
}


}	
?>
<!--LINE 0-->
<tr>
<td><?php echo $CAT;?></td>
</tr>

<!--LINE 1-->
<tr>
<td class="po-info-label">PO NO:</td>
<td><?php ECHO $PO;?></td>
<td class="po-info-label">CV NO:</td>
<td><?php ECHO $CVNO;?></td>
<td class="po-info-label">CHECK NO:</td>
<td><?php ECHO $CHECKNO;?></td>
<td><?PHP echo $CLIENT;?></td>
</tr>
<!--LINE 2-->
<tr>
<td class="po-info-label">PO DATE:</td>
<td><?php ECHO $PODATE;?></td>
<td class="po-info-label">CV DATE:</td>
<td><?php ECHO $CVDATE;?></td>
<td class="po-info-label">CHECK DATE:</td>
<td><?php ECHO $CHECKDATE;?></td>
<td class="po-info-label">PROJECT</td>
</tr>

<!--LINE 3-->
<tr>
<td class="po-info-label">PAYEE:</td>
<td><?php ECHO $PAYEE;?></td>
<td class="po-info-label">AMOUNT:</td>
<td><?php ECHO $AMOUNT;?></td>
<td class="po-info-label">ACCOUNT NO:</td>
<td><?php ECHO $PACCOUNT;?></td>
<td ROWSPAN=2>TERMS</td>
</tr>

<!--LINE 4-->
<tr>
<td class="po-info-label">CONTACT PERSON:</td>
<td><?php ECHO $CONTACT;?></td>
<td class="po-info-label">CONTACT NO:</td>
<td><?php ECHO $CONTACTNO;?></td>
<td class="po-info-label">BANK:</td>
<td><?php ECHO $BANK;?></td>
</tr>

<!--LINE 5-->
<tr>
<td class="po-info-label">DELIVERY/PICK UP DATE:</td>
<td><?php ECHO $DELIVERYDATE ;?></td>
<td class="po-info-label">DELIVERY/PICK UP PLACE:</td>
<td><?php ECHO $CONTACTNO;?></td>
<td class="po-info-label">AUTHORIZED RECEIVER:</td>
<td><?php ECHO $RECEIVER;?></td>
<td class="po-info-label">TERMS</td>
</tr>




<?PHP
}//end of else
?>
</table>






<br>




<!--PO CONTENT-->



<table class="tbl-po-content">
<tr><th colspan=6>PARTICULARS</th></tr>

<tr class="hd">
<td style="width:5%;">ITEM</td>
<td style="width:50%;">DESCRIPTION</td>
<td style="width:10%;">QTY</td>
<td style="width:10%;">UNIT</td>
<td style="width:15%;">UNIT PRICE</td>
<td style="width:15%;">AMOUNT</td>
</tr>
<?php
$sql1 = "SELECT * FROM `sms_pocontent` WHERE POID = '$PO' ;";
$res1 = $con->query($sql1);
$ctr1 = $res1->num_rows;
$i;	
for($i=1;$i<=$ctr1;$i++)
while($row= $res1->fetch_assoc())
{	
//PO ITEM CONTENT
$id= $row['ID'];
$desc = $row['PODESC'];
$qty = $row['POQTY'];
$unit = $row['POUNIT'];
$price =  number_format($row['POUNITPRICE'],2);
$pototal = number_format($row['PCOTOTAL'],2);

?>
<tr class="items">
<input type=hidden name="itemid" value="<?php echo $id;?>">
<td style="width:5%;text-align:center;"><?php echo $i;?></td>
<td style="width:50%;text-align:left;"><?php echo $desc;?></td>
<td style="width:10%;"><?php echo $qty;?></td>
<td style="width:10%;"><?php echo $unit;?></td>
<td style="width:15%;"><?php echo $price;?></td>
<td style="width:15%;"><?php echo $pototal;?></td>
</tr>


<?php
$i++;
}
?>


<tr class="tbl-po-content-total">
<td colspan=5 style="text-align:right;" >TOTAL AMOUNT</td>
<td style="text-align:center;"><?php echo number_format($AMOUNT,2);?></td>
</tr>

<!--PO NOTES-->
<?php
$sql3="SELECT * FROM `sms_ponotes` a inner join `sms_admin` b ON a.EMPID = b.EMPID WHERE POID = '$PO' order by DATECREATED	;";
$res3=$con->query($sql3);
$ctr3=$res3->num_rows;
 ?>
<tr class="tbl-po-note-th">
<td colspan=6 style="text-align:left;" >NOTES:</td>
</tr>
<?php
if($ctr3 == 0)
{	
 ?>
<tr class="tbl-po-note">
<td colspan=6>No notes for this PO.</td>
</tr>
<?php
}
else
{while($b =$res3->fetch_assoc())
	{
	$NOTEID 	= $b['ID'];	
	$CONTENT 	= $b['CONTENT'];
	$DATE 		= $b['DATECREATED'];
	$EMP1		= $b['EMPNAME'];
	$EMP2		= $b['EMPMID'];
	$EMP3		= $b['EMPSURNAME'];
	$a = $EMP1[0];
	$b = $EMP2[0];
	$c = $EMP3[0]; 
 ?>
<tr class="tbl-po-note">
<td colspan=1><?php echo $a.''.$b.''.$c;?></td>
<td colspan=4><?php echo $CONTENT;?></td>
<td colspan=1 style="font-size:12px;"><?php echo date("M j, Y h:ia", strtotime($DATE));?></td>
</tr>
<?php
	} //END WHILE NOTE FETCHING
}	
?>
</table>

<!--ACCOUNTING TABLE-->
<?php 
$sql4 = "SELECT * FROM `sms_projpo` a inner join `sms_projects` b ON a.PROJID = b.PROJID inner join `sms_admin` c ON b.PURCHASINGID = c.EMPID WHERE POID = '$PO' ";
$res4 = $con->query($sql4);
while($c=$res4->fetch_assoc()){
	$EM1= $c['EMPNAME'];
	$EM2= $c['EMPMID']; 
	$EM3= $c['EMPSURNAME'];	
	$aa = $EM1[0];
	$ab = $EM2[0];
	$ac = $EM3[0]; 
	$PODATE=$c['PODATE'];
	$CHECKER = $c['CHECKER'];
	$APPROVEDATE = $c['APPROVEDATE'];
	 if($APPROVEDATE == '0000-00-00'){	$out='';$APPROVEDATE = $out ; }else{$APPROVEDATE = date('m/d/Y',strtotime($c['APPROVEDATE']));}
	}
?>

<table class="po-acctg" STYLE="border:1px solid #FFB608;">
<tr>
<th colspan=8>PLEASE DO NOT FILL UP ACCOUNTING USE ONLY</th>
</tr>
<?php

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



<?php
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' ';
    $separator   = ' ';
    $negative    = 'negative ';
    $decimal     = ' AND ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

	$string = strtoupper($string);
    return $string;
}?>



</form>
