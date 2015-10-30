<?php
include("connection/config.php");
?>
<html>
<link rel="stylesheet" href="css/sms.css">
<!--LOGIN FORM-->
<center>
<div class="logodiv">

</div>
<div class="img-div"><image class="img-logo" src="images/sms_logo.png"/></div>

<form class="loginform" action="login.php" method ="POST">
<div>
<br>
	<input class="logininput" type="text" 		name="usr" placeholder="USERNAME"><br	>
	<input class="logininput" type="password" 	name="pwd" placeholder="PASSWORD">
<br>
	<input style="width:100%;" class="rc-button rc-button-submit" type="submit" name="cmdlogin" value="LOGIN">

</center>		
</div>
</form>	
<!--END LOGIN FORM-->



<br><br><br><br>
<?php
require_once'footer.html';
?>