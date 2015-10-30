<?php
include("nav.php");
$con = db_connect();

if(isset($_GET['cid']))
{
$cid = $_GET['cid'];

$sql1 = "SELECT * FROM `sms_clients` WHERE `CID` = '$cid';";
$res1 = $con->query($sql1);
$ctr1 = $res1->num_rows;
if($ctr1 > 0)
{ 
while($fetch1 = $res1->fetch_assoc() )
{
$FN = $fetch1['FIRSTNAME'];
$SN = $fetch1['SURNAME'];
$MN = $fetch1['MIDDLENAME'];
$B = $fetch1['BIRTHDATE'];
$TN = $fetch1['TIN'];
$CZ = $fetch1['CITIZENSHIP'];
$HA = $fetch1['HOMEADD'];
$EM = $fetch1['EMAIL'];
$CN = $fetch1['CELLNO'];
$PA = $fetch1['PROPERTYADD'];
$LA = $fetch1['LANDAREA'];
$SS = $fetch1['QUERY'];
$RA = $fetch1['REFERRALAGENT'];
$D = $fetch1['dateofvisit'];
$SPN = $fetch1['S_NAME'];
$SPC = $fetch1['S_CONTACT'];

if($B != '0000-00-00'){$BD = strtotime($fetch1['BIRTHDATE']);}else{$BD = $B;}
if($D != '0000-00-00'){$DV = strtotime($fetch1['dateofvisit']);}else{$DV = $D;}
}

?>
<link rel="stylesheet" href="css/sms.css">
<link rel="stylesheet" href="../css/cis.css">
<center>	
<form class="client-form1" method = "POST" action="editclient.php">
<br>


<table class="table1">
<tr><td colspan=6><div class="head-div">CLIENT PERSONAL DATA</div></td></tr>
<input class="" type=hidden					name="CID" 		value="<?php echo $cid;?>">
<tr class="table1-tr">
<td><label class="table1-label">*NAME</label></td>
<td><input class="" type="text"					name="SURNAME" 		value="<?php echo $SN;?>"></td>
<td><input class="" type="text" 				name="FIRSTNAME"	value="<?php echo $FN;?>"></td>
<td><input class="" type="text" 				name="MIDINI" 		value="<?php echo $MN;?>"></td>
<td><label class="table1-label">BIRTHDAY</label></td>
<td><input class="div1-input" type="date" 		name="BIRTHDATE"	value="<?php echo $BD;?>"></td>
</tr>



<tr>
<td colspan=2><label 	class="table1-label">TIN #</label></td>
<td colspan=2><input 	class="div2-input" type="text" name="TIN" value="<?php echo $TN;?>"></td>
<td><label 				class="table1-label" >CITIZENSHIP</label></td>
<td><input				 type="text" name="CITIZENSHIP" value="<?php echo $CZ;?>"></td>
</tr>



<tr>
<td colspan=2><label class="table1-label">*ADDRESS</label></td>
<td colspan=4><input PLACEHOLDER="PRESENT HOME ADDRESS" type="text" name="HOMEADD" value="<?php echo $HA;?>"></td>
</tr>


<tr class="table1-tr">
<td colspan=2><label class="table1-label">*CONTACT INFORMATION</label></td>
<td colspan=2><input PLACEHOLDER="EMAIL" 					type="text" name="EMAIL" value="<?php echo $EM;?>"></td>
<td colspan=2><input PLACEHOLDER="CELLPHONE NO/ LANDLINE NO"			type="text" name="CELLNO" value="<?php echo $CN;?>"></td>
</tr>


<tr class="table1-tr">
<td colspan=2><label class="table1-label">SPOUSE INFORMATION</label></td>
<td colspan=2><input PLACEHOLDER="NAME" 			type="text" name="SPNAME" value="<?php echo $SPN;?>"></td>
<td colspan=2><input PLACEHOLDER="EMAIL"			type="text" name="SPCONTACT" value="<?php echo $SPC;?>"></td>
</tr>

<tr><td colspan=6><div class="head-div">PROPERTY INFORMATION</div></td></tr>

<tr class="table1-tr">
<td colspan=2><label class="table1-label">*PROPERTY LOCATION</label></td>
<td colspan=2><input type="text" name="PROPERTYADD" value="<?php echo $PA;?>"></td>
<td colspan=1><label class="table1-label">*LAND AREA</label></td>
<td colspan=1><input type="text"		name="LANDAREA" value="<?php echo $LA;?>"></td>
</tr>

<tr class="table1-tr">
<td colspan=2><label class="table1-label">How did you learn of Solidcon?</label></td>
<td colspan=2><input PLACEHOLDER="(e.g. internet,referral,newspapers,tv,etc.)" type="text" name="KnowService" value="<?php echo $SS;?>"></td>
<td><label class="table1-label">Referral Agent</label></td>
<td><input PLACEHOLDER="" type="text" name="ReferralAgent" value="<?php echo $RA;?>"></td>
</tr>


<tr class="table1-tr">
<td colspan=2><label class="table1-label">DATE OF VISIT</label></td>
<td colspan=4><input type="date" name="dateofvisit" value="<?php echo date('Y-m-d', $DV);?>"></td>
</tr>


</table>

<br>
<div style="background:white;">
<label for="add"></label>
<input style="width:248px;float:right;" class="rc-button rc-button-submit" name="save" type="submit" value="SAVE CHANGES">
</div>

</form>
<?PHP 
}else
{
?>
<form class="client-form1" method = "GET">
<DIV style="font-family: arial; font-size:24px;">NO RECORDS FOUND.</div>
</form>
<?php
}

}//isset cid
?>


<?php
//saving changes
if(isset($_POST['save']))
{
if($_POST['save'] == "SAVE CHANGES")
{
$CID = $_POST['CID'];
$SN = $_POST['SURNAME'];
$FN = $_POST['FIRSTNAME'];
$MI = $_POST['MIDINI'];
$BD = $_POST['BIRTHDATE'];
$TN = $_POST['TIN'];
$CZ = $_POST['CITIZENSHIP'];
$HA = $_POST['HOMEADD'];
$CN = $_POST['CELLNO'];
$EM = $_POST['EMAIL'];

$SPN = $_POST['SPNAME'];
$SPC = $_POST['SPCONTACT'];

$LA = $_POST['LANDAREA'];
$PA = $_POST['PROPERTYADD'];

$SS  = $_POST['KnowService'];
$RA  = $_POST['ReferralAgent'];
$DT  = $_POST['dateofvisit'];

if($SN!='' && $FN!='' && $HA!='' && $CN!='' && $PA!='' && $LA!='')
{
 $sqlsave = "update `sms_clients` set `SURNAME` = '$SN',`FIRSTNAME`= '$FN', `MIDDLENAME` ='$MI' ,`CITIZENSHIP`='$CZ', `TIN`='$TN', 
 `BIRTHDATE`='$BD',`HOMEADD`='$HA',`CELLNO`='$CN', `EMAIL`='$EM', `S_NAME` = '$SPN', `S_CONTACT` = '$SPC',
`LANDAREA`='$LA',`PROPERTYADD`='$PA',`QUERY`='$SS',`REFERRALAGENT`='$RA',`dateofvisit`='$DT' WHERE `CID` = '$CID';";

	$result = $con->query($sqlsave);
	if($result)
	{
		    echo
        "<script type=\"text/javascript\">".
        "window.alert('Changes successfully saved.');".
         'window.location.href="editclient.php?cid='.$CID.'";'.
        "</script>";
 
	}
	else
	{
	    echo
        "<script type=\"text/javascript\">".
        "window.alert('Client update error.');".
        'window.location.href="clientlist.php";'.
        "</script>";
	}
 
 }
 else
 { 
	    echo
        "<script type=\"text/javascript\">".
        "window.alert('Please do not leave required fields empty.');".
        'window.location.href="editclient.php?cid='.$CID.'";'.
        "</script>";
}

}//post'save' value
}//isset save
?>
