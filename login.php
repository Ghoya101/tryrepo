<?php
include("connection/config.php");
$con = db_connect();
session_start(); 


//ON SUBMIT
if(isset($_POST['cmdlogin']))
{
	$username = $_POST['usr'];
	$password = $_POST['pwd'];
	// INPUT VALIDATION
	if($username == '' OR $password == '')
    {	
	 echo 	"<script>
			alert('PLEASE FILL IN REQUIRED FIELDS.');
			window.location.href='index.php';
			</script>";

		
	}else 
	{	
		$sql = "SELECT * FROM sms_admin a inner join `sms_admintype` b ON a.ADMINID = b.ADMINID
		WHERE a.USERNAME = '".$username."' AND a.TEMP = '".sha1($password)."' ;";
		$result = $con->query($sql);
		$row_num = $result->num_rows;
		//VALIDATION IF USER EXISTS
		if($row_num != 0)
		{  
			While($value = $result->fetch_assoc())
			{	$TYPE = $value['DESCRIPTION']; $EMP = $value['EMPID'];}
			$_SESSION['curuser']= $EMP;
			if($TYPE == 'SUPERADMIN')
			{
				header("Location:SA/");
			}
			else
			if($TYPE == 'COSTING')
			{
				header("Location:CO/");
			}
			else
			if($TYPE == 'OPERATIONS')
			{
				header("Location:OP/");
			}
			else
			if($TYPE == 'ACCOUNTING')
			{	
				header("Location:AC/");
			}
			else
			if($TYPE == 'PURCHASING')
			{
				header("Location:PU/");
			}
			else if($TYPE == 'WAREHOUSE')
			{
				header("Location:WA/");
			}
			else if($TYPE == 'FINANCE')
			{
				header("Location:FI/");
			}
			
		
		}
		else 
		{	
		echo 	"<script>
				alert('INVALID USERNAME OR PASSWORD');
				window.location.href='index.php';
				</script>";

		}

	
	
	}
	
	
		
}
?>