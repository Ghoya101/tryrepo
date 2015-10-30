<?php
include("pur-nav.php");
$con = db_connect();

$PO =$_GET['poid']; 
$USER = $empid;


$sql1 = "SELECT * from `sms_projpo` a inner join `sms_projects` b ON a.PROJID = b.PROJID inner join `sms_clients` c ON b.CID = c.CID WHERE a.POID = '$PO' ;";
$res1 =$con->query($sql1);
$ctr1 = $res1->num_rows;
?>
<link rel="stylesheet" href="../css/po.css">
<link rel="stylesheet" href="../css/costing.css">
<form class="po-form" Method="POST" action="approve-reject-revise.php">








<!--PO INFO TABLE-->
<br	>
<table class="po-info">
<?php if($ctr1 == 0 ){?>
<tr>
<td><?php echo "NO ITEM FOUND UNDER THIS PO ID.";?></td>
</tr>
<?php }else{
while($A = $res1->fetch_assoc()){
$CLIENT 		= $A['SURNAME']; 	
$AMOUNT 		= $A['AMOUNT']; 
$CVNO 			= $A['CVNO'];
$CHECKNO 		= $A['CHECKNO'];
$CHECKDATE 		= $A['CHECKDATE'];
$PODATE 		= date('m/d/Y',strtotime($A['PODATE']));
$CVDATE 		= $A['CVDATE'];
$DELIVERYDATE 	= date('m/d/Y',strtotime($A['DELIVERYDATE']));
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

if($CHECKDATE == '0000-00-00'){ $out = 'For admin use only';$CHECKDATE = $out;}else{$CHECKDATE = date('m/d/Y',strtotime($A['CHECKDATE']));}
if($CVDATE == '0000-00-00'){	$out='For accounting use only';$CVDATE = $out ; }else{$CVDATE = date('m/d/Y',strtotime($A['CVDATE']));}
if($APPROVEDATE == '0000-00-00'){	$out='';$CVDATE = $out ; }else{$APPROVEDATE = date('m/d/Y',strtotime($A['APPROVEDATE']));}
if($CVNO == '0'){$CVNO ='For accounting use only';} if($CHECKNO =='0'){ $CHECKNO = 'For admin use only';}
}	?>


<tr class="outputs">
<td><?PHP echo $PO;?></td>
<td><?PHP echo $PODATE;?></td>
<td><?PHP echo $CVNO;?></td>
<td><?PHP echo $CVDATE;?></td>
<td><?PHP echo $CHECKNO;?></td>
<td><?PHP echo $CHECKDATE;?></td>
<td><?PHP echo $CLIENT;?></td>
</tr>

<tr style="border-top:1px solid black;" class="labels" >
<td>PO ID</td>
<td>PO DATE</td>
<td>CV NO</td>
<td>CV DATE</td>
<td>CHECK NO</td>
<td>CHECK DATE</td>
<td>PROJECT</td>
</tr>

<tr style="border-top:1px solid #C1C1C1;" class="outputs">
<td><?PHP echo $PAYEE;?></td>
<td><?PHP echo number_format($AMOUNT,2);?></td>
<td><?PHP echo $PACCOUNT;?></td>
<td><?PHP echo $BANK;?></td>
<td><?PHP echo $CONTACT;?></td>
<td><?PHP echo $CONTACTNO;?></td>
<td rowspan=3><?PHP echo $TERMS;?></td>
</tr>

<tr style="border-top:1px solid black;" class="labels" >
<td>PAYEE NAME</td>
<td>AMOUNT</td>
<td>ACCOUNT</td>
<td>BANK</td>
<td>CONTACT</td>
<td>CONTACT NO</td>
</tr>


<tr style="border-top:1px solid #C1C1C1;" class="outputs">
<td colspan=2><?PHP echo $DELIVERYDATE;?></td>
<td colspan=2><?PHP echo $DELIVERYPLACE;?></td>
<td colspan=2><?PHP echo $RECEIVER;?></td>
</tr>

<tr style="border-top:1px solid black;" class="labels" >
<td COLSPAN=2>DELIVERY/PICK UP DATE</td>
<td COLSPAN=2>DELIVERY/PICK UP PLACE</td>
<td colspan=2>AUTHORIZED RECEIVER</td>
<td >TERMS</td>

</tr>
<?php }?>
</table>






<br>




<!--PO CONTENT-->



<table class="tbl-po-content">
<tr><th colspan=6>PARTICULARS</th></tr>

<tr class="tbl-po-th2">
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
<tr class="tbl-po-content2">
<input type=hidden name="itemid" value="<?php echo $id;?>">
<td style="width:5%;"><?php echo $i;?></td>
<td style="width:50%;"><?php echo $desc;?></td>
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
<td colspan=6 style="text-align:left;" >NOTES</td>
</tr>
<?php
if($ctr3 == 0)
{	
 ?>
<tr class="tbl-po-note">
<td colspan=6>NO NOTES FOR THIS PURCHASE ORDER.</td>
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

<!--STATUS TABLE-->
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
	 if($APPROVEDATE == '0000-00-00'){	$out='';$APPROVEDATE = $out ; }else{$APPROVEDATE = date('m/d/Y',strtotime($A['APPROVEDATE']));}
	}
?>

<table class="tbl-po-status">
<tr class="status-label">
<td colspan=8>PLEASE DO NOT FILL UP ACCOUNTING USE ONLY</td>
</tr>

<tr class="words">
<td colspan=8><?php $words = convert_number_to_words($AMOUNT)." PESOS ONLY"; echo "***".$words."***";?></td>
</tr>
<tr class="status-label">
<td colspan=8>AMOUNT IN WORDS</td>
</tr>
<tr class="">
<td	colspan=2	>CHARGED TO</td>
<td	width="10%"			>DEBIT</td>
<td	width="10%"				>CREDIT</td>
<td	width="10%"				></td>
<td	width="10%"				></td>
<td	width="10%"				></td>
<td	width="10%"				></td>
</tr>
<tr class="">
<td	colspan=2	></td>
<td				></td>
<td				></td>
<td				>PREPARED BY</td>
<td				><?php echo $aa.''.$ab.''.$ac;?></td>
<td				>DATE</td>
<td				><?php echo date('m/d/Y',strtotime($PODATE));?></td>
</tr>

<td	colspan=2	></td>
<td				></td>
<td				></td>
<td				>PREPARED BY</td>
<td				><?php echo $aa.''.$ab.''.$ac;?></td>
<td				>DATE</td>
<td				><?php echo date('m/d/Y',strtotime($PODATE));?></td>
</tr>

<td	colspan=2	></td>
<td				></td>
<td				></td>
<td				>CHECKED BY</td>
<td				><?php ?></td>
<td				>DATE</td>
<td				><?php   ECHO $APPROVEDATE;?></td>
</tr>

<td	colspan=1	>RECEIVED BY</td>
<td				>CIB</td>
<td				></td>
<td				></td>
<td				></td>
<td				></td>
<td				></td>
<td				></td>
</tr>

<td	colspan=1	>DATE RECEIVED</td>
<td				>TOTAL</td>
<td				>-</td>
<td				>-</td>
<td				>APPROVED BY</td>
<td				><?PHP ?></td>
<td				>DATE</td>
<td				><?php?></td>
</tr>



</table>



<?php
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
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



<table class="act">
<tr class="tbl-po-note-th">
<td colspan=6 style="text-align:left;" >COMMENTS</td>
</tr>
<?php
$sql5 = "SELECT * from `sms_pocomments` a inner join `sms_admin` b ON a.EMPID = b.EMPID WHERE POID = '$PO' ;";
$res5 = $con->query($sql5);
$ctr6 = $res5->num_rows;
if($ctr6 == 0)
{
?>
<tr class="tbl-po-note">
<td colspan=6>NO COMMENTS FOR THIS PURCHASE ORDER.</td>
</tr>


<?php	
}else
{	
while($d=$res5->fetch_assoc()){
	$EMP1		= $d['EMPNAME'];
	$EMP2		= $d['EMPMID'];
	$EMP3		= $d['EMPSURNAME'];
	$aa = $EMP1[0];
	$ba = $EMP2[0];
	$ca = $EMP3[0]; 
	$COMMENT = $d['COMMENT'];
	$DATE = $d['DATECREATED'];
?>
<tr class="tbl-po-note">
<td colspan=1><?php echo $aa.''.$ba.''.$ca;?></td>
<td colspan=4><?php echo $COMMENT;?></td>
<td colspan=1 style="font-size:12px;"><?php echo date("M j, Y h:ia", strtotime($DATE));?></td>
</tr>

<?php }}?>

</table>

</form>
