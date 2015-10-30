<script>
// Validating Empty Field
function check_empty() {
if (document.getElementById('name').value == "" || document.getElementById('email').value == "" || document.getElementById('msg').value == "") {
alert("Fill All Fields !");
} else {
document.getElementById('form').submit();
alert("Form Submitted Successfully...");
}
}
//Function To Display Popup
function div_show() {
document.getElementById('abc').style.display = "block";
}
//Function to Hide Popup
function div_hide(){
document.getElementById('abc').style.display = "none";
}

function div_show() {
document.getElementById('abc').style.display = "block";
}
</script>

<!DOCTYPE html>
<html>
<head>
<title>Popup contact form</title>
<link href="../css/elements.css" rel="stylesheet">

</head>
<!-- Body Starts Here -->

<div id="abc">
	<!-- Popup Div Starts Here -->
	<div class="popupContact">
	<!-- Contact Us Form -->
	<form action="#" class="form" method="post" name="form">
	<input type=button class="close" value="X" onclick ="div_hide()">

	<h2>Contact Us</h2>
	<hr>
	<input id="name" name="name" placeholder="Name" type="text">
<br>
<br>
	<a href="javascript:%20check_empty()" class="submit">Send</a>
	</form>
	</div>
	<!-- Popup Div Ends Here -->
</div>
<!-- Display Popup Button -->
<h1>Click Button To Popup Form Using Javascript</h1>
<button id="popup" onclick="div_show()">Popup</button>
</body>
<!-- Body Ends Here -->
</html>