<?php 
include("connection/config.php");
require_once('PU/functions.php');
$con=db_connect();

if(ISSET($_POST['cmd']))
{

$h=$_POST['headline'];
$d = htmlspecialchars($h, ENT_QUOTES, "UTF-8");
$sql="INSERT INTO tbl_testing (a) VALUES('$d')";
$res=$con->query($sql);
if($res)
{echo $d .'SAVING SUCCEED.';

$sql1 = "SELECT * FROM tbl_testing";
$res1 = $con->query($sql1);
while($fetch=$res1->fetch_assoc())
{
	$a = $fetch['a'];
	$print = stripslashes($a);
	echo $print;
?>
<br>	
<?php
}

}
else{ echo $d .'  '. 'SAVING FAILED.';}

}else
{
	
	echo "Enter String";	
}
?>

<form Method="POST" action="testingpage.php">

<input type="text" name="headline" />
<input type=submit name="cmd">


</form>


<input type="text" name="desc" id="desc"/> 
<input style="width: 10%;" type="button" value="SEND" name="cmdsendpo" onclick="sendpo()" class="rc-button rc-button-submit"/>


<script>
function sendpo()
{

var desc = htmlspecialchars(document.getElementById("desc").value);
var a = "test1.php?cmdsendpo=Yes&&desc="+desc;
//document.getElementById('showme').innerHTML = a;
window.location.href=a;
}

function htmlspecialchars(string, quote_style, charset, double_encode) {
  //       discuss at: http://phpjs.org/functions/htmlspecialchars/
  //      original by: Mirek Slugen
  //      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      bugfixed by: Nathan
  //      bugfixed by: Arno
  //      bugfixed by: Brett Zamir (http://brett-zamir.me)
  //      bugfixed by: Brett Zamir (http://brett-zamir.me)
  //       revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //         input by: Ratheous
  //         input by: Mailfaker (http://www.weedem.fr/)
  //         input by: felix
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  //             note: charset argument not supported
  //        example 1: htmlspecialchars("<a href='test'>Test</a>", 'ENT_QUOTES');
  //        returns 1: '&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;'
  //        example 2: htmlspecialchars("ab\"c'd", ['ENT_NOQUOTES', 'ENT_QUOTES']);
  //        returns 2: 'ab"c&#039;d'
  //        example 3: htmlspecialchars('my "&entity;" is still here', null, null, false);
  //        returns 3: 'my &quot;&entity;&quot; is still here'

  var optTemp = 0,
    i = 0,
    noquotes = false;
  if (typeof quote_style === 'undefined' || quote_style === null) {
    quote_style = 2;
  }
  string = string.toString();
  if (double_encode !== false) { // Put this first to avoid double-encoding
    string = string.replace(/&/g, '&amp;');
  }
  string = string.replace(/</g, '&lt;')
    .replace(/>/g, '&gt;');

  var OPTS = {
    'ENT_NOQUOTES': 0,
    'ENT_HTML_QUOTE_SINGLE': 1,
    'ENT_HTML_QUOTE_DOUBLE': 2,
    'ENT_COMPAT': 2,
    'ENT_QUOTES': 3,
    'ENT_IGNORE': 4
  };
  if (quote_style === 0) {
    noquotes = true;
  }
  if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
    quote_style = [].concat(quote_style);
    for (i = 0; i < quote_style.length; i++) {
      // Resolve string input to bitwise e.g. 'ENT_IGNORE' becomes 4
      if (OPTS[quote_style[i]] === 0) {
        noquotes = true;
      } else if (OPTS[quote_style[i]]) {
        optTemp = optTemp | OPTS[quote_style[i]];
      }
    }
    quote_style = optTemp;
  }
  if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
    string = string.replace(/'/g, '&#039;');
  }
  if (!noquotes) {
    string = string.replace(/"/g, '&quot;');
  }

  return string;
}
</script>






<?php 
$POID = '1 - 1';
$sql4 = "SELECT * FROM `sms_projpo` a inner join `sms_projects` b ON a.PROJID = b.PROJID inner join `sms_admin` c ON b.PURCHASINGID = c.EMPID WHERE POID = '$POID' ";
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


