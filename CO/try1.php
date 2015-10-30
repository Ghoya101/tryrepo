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
$SQL = "SELECT * FROM `sms_projpo` WHERE POID = '$PO'";
$resme = $con->query($SQL);
while($abc = $resme->fetch_assoc()){$Am = $abc['AMOUNT'];}
//$AMOUNT = number_format($Am,2);
//echo $AMOUNT;
$am = '1212.5';

echo $me .'<br />';
$amount = explode('.',$am); 
$num_arr = count($amount);
echo $num_arr;
if($num_arr == 2)
{
$am = number_format($am, 2, '.', '');
$amount = explode('.',$am); 
$whole = $amount[0]; 
echo $whole; echo '<br />';
$dec = $amount[1];
echo $dec;
$cents = $dec.'/100';
$words = convert_number_to_words($whole); 
$amountinwords = "***".$words." & ".$cents."***";
}else
{
$words = convert_number_to_words($an); 
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