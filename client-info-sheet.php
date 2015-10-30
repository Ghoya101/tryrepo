<?php
include("connection/config.php");
$con = db_connect();
date_default_timezone_set('America/Los_Angeles');
$now = date("Y-m-d");
?>
<link rel="stylesheet" href="css/sms.css">
<link rel="stylesheet" href="css/cis.css">
<center>	
<form class="client-form" method = "GET" action="addclient.php">
<br>


<table class="table1">
<tr><td colspan=6><div class="head-div">CLIENT PERSONAL DATA</div></td></tr>

<tr class="table1-tr">
<td><label class="table1-label">*NAME</label></td>
<td><input PLACEHOLDER="SURNAME" 	class="" type="text"	name="SURNAME" 	></td>
<td><input PLACEHOLDER="FIRSTNAME" 	class="" type="text" 				name="FIRSTNAME"></td>
<td><input PLACEHOLDER="MIDDLENAME"	class="" type="text" 				name="MIDINI" 	></td>
<td><label class="table1-label">BIRTHDAY</label></td>
<td><input PLACEHOLDER="BIRTHDATE"	class="div1-input" type="date" 	name="BIRTHDATE"></td>
</tr>



<tr>
<td colspan=2><label class="table1-label">TIN #</label></td>
<td colspan=2><input PLACEHOLDER="TIN"		class="div2-input" type="text" name="TIN"></td>
<td><label class="table1-label">CITIZENSHIP</label></td>
<td><input PLACEHOLDER="CITIZENSHIP" type="text" name="CITIZENSHIP"></td>
</tr>



<tr>
<td colspan=2><label class="table1-label">*ADDRESS</label></td>
<td colspan=4><input PLACEHOLDER="PRESENT HOME ADDRESS" type="text" name="HOMEADD"></td>
</tr>


<tr class="table1-tr">
<td colspan=2><label class="table1-label">*CONTACT INFORMATION</label></td>
<td colspan=2><input PLACEHOLDER="EMAIL" 								type="text" name="EMAIL"></td>
<td colspan=2><input PLACEHOLDER="CELLPHONE NO/ LANDLINE NO"			type="text" name="CELLNO"></td>
</tr>


<tr><td colspan=6><div class="head-div">PROPERTY INFORMATION</div></td></tr>


<tr class="table1-tr">
<td colspan=2><label class="table1-label">*PROPERTY LOCATION</label></td>
<td colspan=2><input PLACEHOLDER="PROPERTY LOCATION / ADDRESS" type="text" name="PROPERTYADD"></td>
<td colspan=1><label class="table1-label">*LAND AREA</label></td>
<td colspan=1><input type="text"		name="LANDAREA"	placeholder="SQ.M."></td>
</tr>

<tr class="table1-tr">
<td colspan=2><label class="table1-label">How did you learn of Solidcon?</label></td>
<td colspan=2><input PLACEHOLDER="(e.g. internet,referral,newspapers,tv,etc.)" type="text" name="KnowService"></td>
<td><label class="table1-label">Referral Agent</label></td>
<td><input PLACEHOLDER="(if any)" type="text" name="ReferralAgent"></td>
</tr>


<input type=HIDDEN name="dateofvisit" value="<?php echo $now;?>" readonly>

</table>

<br>
<div style="background:white;">
<label for="add"></label>
<input style="width:248px;" class="rc-button rc-button-submit" name="add" type="submit" value="ADD CLIENT INFORMATION">
</div>

</form>
<BR><BR><BR><BR>
<?php
require_once'footer.html';
?>