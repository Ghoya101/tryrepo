<?php 
include("nav.php");
require_once('functions.php');
$con = db_connect();
date_default_timezone_set('America/Los_Angeles');			
$NOW = date('Y-m-d h:i:s', time());

if(isset($_GET['proj']) AND ($_GET['poid']))
{
$PROJ = $_GET['proj'];
$POID = $_GET['poid'];
$EMPID = $empid;




//SQL FOR FETCHING 
$sql1 = "SELECT a.SURNAME AS SURNAME, a.FIRSTNAME AS FIRSTNAME,b.PROJID as PROJID, b.POCTR as POCTR	from sms_clients a 
INNER JOIN sms_projects b ON a.CID = b.CID
WHERE b.PROJID = '$PROJ';";
$res1 = $con->query($sql1);
	while($fet1=$res1->fetch_assoc())
	{
		$PROJID 	= $fet1['PROJID'];
		$POCTR 		= $fet1['POCTR'];
		$CLIENT 	=$fet1['FIRSTNAME'].' '.$fet1['SURNAME'];
	}
?>
<?php
$query  = "SELECT * FROM sms_projpo a inner join sms_projects b ON a.PROJID = b.PROJID WHERE POID = '$POID';";
$run	= $con->query($query);
$ctr	= $run->num_rows;
if($ctr!=0)
{
//query for fetching existing po info
while($A=$run->fetch_assoc())
{
$DELIVERYDATE 	= $A['DELIVERYDATE'];
$DELIVERYPLACE 	= $A['DELIVERYPLACE'];
$RECEIVER 		= $A['RECEIVER'];
$PACCOUNT 		= $A['PACCOUNT'];
$PAYEE 			= $A['PAYEE'];
$BANK 			= $A['BANK'];
$CONTACT 		= $A['CONTACT'];
$CONTACTNO 		= $A['CONTACTNO'];
$TERMS 			= $A['TERMS'];
$pr  			= $A['PURCHASINGID'];
$podate  		= $A['PODATE'];
$checker 		= $A['CHECKER'];
$cdate	 		= $A['APPROVEDATE'];
$acct	 		= $A['RECOMMENDEDBY'];
$adate   		= $A['RECDATE'];
$approve 		= $A['APPROVEDBY'];
$apdate  		= $A['APPDATE'];
$disburst		= $A['DISBURSTBY'];
$ddate   		= $A['DISDATE'];
}
//prepared by
if($pr == 0)
{$pr = 'Pending';$podate = 'Pending';
}else
{	$q1 ="SELECT * FROM `sms_admin` WHERE EMPID = $pr	 ;";$r1=$con->query($q1);
	while($a = $r1->fetch_assoc())
	{$pr = $a['EMPNAME'][0].''.$a['EMPMID'][0].''.$a['EMPSURNAME'][0];}$podate = date('m/d/Y',strtotime($podate));
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


}	else
{
$EMPTY = '';	
$DELIVERYDATE 	= $EMPTY;
$DELIVERYPLACE 	= $EMPTY;
$RECEIVER 		= $EMPTY;
$PACCOUNT 		= $EMPTY;
$PAYEE 			= $EMPTY;
$BANK 			= $EMPTY;
$CONTACT 		= $EMPTY;
$CONTACTNO 		= $EMPTY;
$TERMS 			= $EMPTY;
$pr  			= $EMPTY;
$podate  		= $EMPTY;
$ch 			= $EMPTY;
$chdate	 		= $EMPTY;
$acctg	 		= $EMPTY;
$acdate   		= $EMPTY;
$app	 		= $EMPTY;
$apdate  		= $EMPTY;
$dis			= $EMPTY;
$disdate   		= $EMPTY;
}

?>


<link rel="stylesheet" href="../css/pur.css">
<link rel="stylesheet" href="../css/po-form.css">	

<body>
<!--<div id="showme">hey</div>-->
<div id="showme">hey</div>
<input style="margin-top:0;width:10%;font-size:20px;" type="button" value="BACK" class="rc-button rc-button-submit" onclick="window.location.href='po.php?proj=<?php echo $PROJ;?>&&stat=ALL'"/>
<!--PO FORM-->
<form name="PO FORM" class="po-form" Method="POST" action="">
<div>

<!--TABLE FOR PO INFO-->
<table class="tbl_po1">
<input type="hidden" name="PROJID" value="<?php echo $PROJ;?>">
<input type="hidden" name="curdate" value="<?php echo $NOW;?>" id="curnow">
<input type="hidden" name="EMPID" value="<?php echo $EMPID;?>" id="empid">
<input type="hidden" name="POID" value="<?php echo $POID;?>">
 

<tr>
<td class="td1">PURCHASE ORDER ID</td>
<td class="td1" colspan=2><?php echo $POID;?></td>
<td class="td1">CLIENT/OWNER</td>
<td class="td1" colspan=2><?php echo $CLIENT;?></td>
</tr> 

<tr>
<td class="td1" >*PAYEE NAME</td>
<td class="td1" ><input type="TEXT" class="inp_po" value="<?php echo $PAYEE;?>" name="payee" id="payee"></td>
<td class="td1">PAYEE ACCOUNT NO</td>
<td class="td1" ><input type="TEXT" class="inp_po" name="paccount" id="paccount" VALUE="<?php echo $PACCOUNT ;?>"></td>
<td class="td1">BANK</td>
<td class="td1" ><input type="TEXT" class="inp_po" name="pbank" id="pbank" VALUE="<?php echo $BANK ;?>"></td>
</tr>

<tr>
<td class="td1" >CONTACT PERSON</td>
<td class="td1" ><input type="TEXT" class="inp_po" name="contact" id="contact" VALUE="<?php echo $CONTACT ;?>"></td>
<td class="td1" >CONTACT NO</td>
<td class="td1" ><input type="TEXT" class="inp_po" name="contactno" id="contactno" VALUE="<?php echo $CONTACTNO ;?>"></td>
<td class="td1" >TERMS</td>
<td class="td1" ><input type="TEXT" class="inp_po" name="terms" placeholder="# of Days" id="terms" VALUE="<?php echo $TERMS ;?>"></td>
</tr>

<tr>
<td class="td1">DELIVERY DATE</td>
<td class="td1"><input type="DATE" class="inp_po" name="ddate" id="ddate" VALUE="<?php echo $DELIVERYDATE  ;?>"></td>
<td class="td1">DELIVERY PLACE</td>
<td class="td1"><input type="TEXT" class="inp_po" name="dplace" id="dplace" VALUE="<?php echo$DELIVERYPLACE ;?>"></td>
<td class="td1">AUTHORIZE RECEIVER</td>
<td class="td1"><input type="TEXT" class="inp_po" name="receiver" id="receiver" VALUE="<?php echo $RECEIVER ;?>"></td>
</tr>
</table>








<!--TABLE FOR CONTENT-->

<table class="tbl_po1">		
<tr class="tbl_trpo">
<th colspan=9 style="text-align:center;">PARTICULARS</th>
</tr>
<tr class="tbl_trpo">
<th class="tbl_thpo" width=6% colspan=2>ACTIONS</th>
<th class="tbl_thpo" width=6%>ITEM NO</th>
<th class="tbl_thpo" width=40%>DESCRIPTION</th>
<th class="tbl_thpo" width=5%>QTY</th>
<th class="tbl_thpo" width=5%>UNIT</th>
<th class="tbl_thpo" width=10%>UNIT PRICE</th>
<th class="tbl_thpo" width=10%>AMOUNT</th>

</tr>

<?php 
If(!isset($_GET['edititem']))
{?>
<?php
$sql2 = "SELECT * FROM `sms_pocontent` WHERE `POID` = '$POID';";
$res2 = $con->query($sql2);
$ctr2 = $res2->num_rows;
$TOTAL = 0;
$i=1;	
$x;	
for($x=1;$x<=$ctr2;$x++)
for($i=1;$i<=$ctr2;$i++)

while($fet2=$res2->fetch_assoc())
{
$COID 	= $fet2['ID'];
$DESC 	= $fet2['PODESC'];
$QTY 	= $fet2['POQTY'];
$UNIT 	= $fet2['POUNIT'];
$PRICE 	= number_format($fet2['POUNITPRICE'],2);
$t = ($fet2['POQTY'])* ($fet2['POUNITPRICE']);
$TPRICE = number_format($t,2);
$TOTAL 	+= $t;
?>
<tr class="editcon" style="">
<input type=hidden name="co" id="coid" value="<?php echo $COID;?>"/>
<td width=6%	class="tdc" style="font-size:14px;"><input type=button value="DEL" CLASS="btn-delitem" onclick="delitem('<?php echo $COID;?>','<?php echo $DESC;?>')"></td>
<td width=6%	class="tdc" style="font-size:14px;"><input type=button value="EDIT" CLASS="btn-delitem" ></td>
<td width=6%	class="tdc" style="font-size:14px;" id="ids"><?php echo $x;?></td>
<td width=40%	class="tdl" style="font-size:14px;" id="codesc"><?php echo $DESC;?></td>
<td width=5%	class="tdr" style="font-size:14px;"><?php echo $QTY;?></td>
<td width=5%	class="tdr" style="font-size:14px;"><?php echo $UNIT;?></td>
<td width=10%	class="tdr" style="font-size:14px;"><?php echo $PRICE;?></td>
<td width=10%	class="tdr" style="font-size:14px;"><?php echo $TPRICE;?></td>
</tr>
<?PHP
$x++;
}

?>

<tr class="tr_content">
<input type=hidden name="po" id="po" value="<?php echo $POID;?>"/>
<input type=hidden name="pr" id="projid" value="<?php echo $PROJ;?>"/>
<td width=6%	COLSPAN=2>-</td>
<td width=6%	><input type="text" name="ctr" style="text-align: center;"	value="<?php echo $i;?>" readonly> </td>
<td width=40%	><input type="text" name="desc" id="desc"/> </td>
<td width=5%	><input type="text" name="qty" id="qty"/> </td>
<td width=5%	><input type="text" name="unit" id="unit"/> </td>
<td width=10%	><input type="text" name="unitprice" id="unitprice"/> </td>
<td width=10%	><input style="width:100%;font-size:20px;" name="cmdadd" type="button" value="ADDITEM" class="rc-button rc-button-submit" onclick="additem()"/></td>

</tr>
<?PHP
$i++;
?>

<?php  
}//no isset edititem
else
{


}?>
















<tr>
<td style="text-align:left;" colspan=6>NOTES
</td>
</tr>
<?php
$que = "SELECT * FROM `sms_ponotes` WHERE `POID` = '$POID';";
$res = $con->query($que);
$row = $res->num_rows;
$TOTAL = 0;
while($aaa=$res->fetch_assoc())
{
$notes = $aaa['CONTENT'];
?>
<tr>
<td style="border-bottom:none;border-top:none;text-align:left;" colspan=6><?php echo $notes;?>
</td>
</tr>
<?php }?>
<tr>
<td colspan=6>
<div class="clickable">
<label for="the-checkbox" style="float:left;"><?PHP echo '+ NOTES';?></label>
<input type="checkbox" id="the-checkbox"> <p></p>
<div class="appear">
<div>
<?php?>
<input type="hidden" name="poid" value="<?php echo $POID;?>">
<input type="hidden" name="PROJ" value="<?php echo $PROJ;?>">
<input style="display: block;" type="text" name="note" placeholder="Type notes here">
<input style="display: block;background:#4D90FE;color:#fff;" type="submit" name="addnotes" value="ADD">
</div>
</div>
</div>

</td>
</tr>
<?php
$q2 = "SELECT * FROM `sms_pocontent` WHERE POID = '$POID'";
$r2 = db_connect()->query($q2);	
$ctr = $r2->num_rows;
$AMOUNT = 0;
WHILE($re=$r2->fetch_assoc())
{
$t = ($re['POQTY'])* ($re['POUNITPRICE']);
$AMOUNT += $t;
}
?>

<tr class="tr-co" style="background:#44749d;color:white;font-weight:bold;font-size:14px;">
<td colspan=5 style="font-size:16px; padding:2px;">TOTAL</td>
<td colspan=5 style="font-size:16px;"><?php echo number_format($AMOUNT,2) ;?></td>
</tr>
</table>

<!--ACCOUNTING TABLE: existing poid-->
<table class="po-acctg" STYLE="width: 100%;margin-left:0;border:1px solid #FFB608;">
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
<td	width="5%"													><?php echo $pr;?></td>
<td	width="5%"	STYLE="text-align:left;"						>DATE</td>
<td	width="15%"													><?php echo $podate;?></td>
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
<td				STYLE="text-align:left;"						>DISBURSED BY</td>
<td				><?php echo $dis; ?></td>
<td				STYLE="text-align:left;"						>DATE</td>
<td				><?php echo $disdate; ?></td>
</tr>



</table>



<input style="width: 10%;" type="button" value="SAVE" name="cmdsavepo"  onclick="savepo()" class="rc-button rc-button-submit"/>
<input style="width: 10%;" type="button" value="SEND" name="cmdsendpo" onclick="sendpo()" class="rc-button rc-button-submit"/>
</form>

<?php

}//END IF PROJID ISSET
else
{
header("Location:index.php");
}
?>
</form>


