<?php
include("nav.php");
$con = db_connect();
if(isset($_POST['addnotes']))
{
$poid = $_POST['poid'];
$note = $_POST['note'];
$PROJ 	= $_POST['PROJ'];
echo "<script>
		window.location.href='notes.php?poid=$poid&&note=$note&&proj=$PROJ';
		</script>";

}

//
if(isset($_GET['additem']))
{
$PROJ 	= $_GET['projid'];
$POID 	= $_GET['po'];
$desc 	= $_GET['desc'];
$qty 	= $_GET['qty'];
$unit 	= $_GET['unit'];
$up 	= $_GET['up'];
$EMPID 	= $_GET['empid'];
date_default_timezone_set('America/Los_Angeles');			
$NOW = date('Y-m-d h:i:s', time());
//$NOW =  $_GET['now'];
$DDATE 	= $_GET['ddate'];
$DPLACE = $_GET['dplace'];
$RECEIVER = $_GET['receiver'];	
$PAYACC = $_GET['paccount'];	
$PAYEE	= $_GET['payee'];
$PBANK	= $_GET['pbank'];
$TERMS = $_GET['terms'];
$CONTACT = $_GET['contact'];
$CONTACTNO = $_GET['contactno'];
$STATUS = 1;
$READ = "UNREAD";



$query  = "SELECT * FROM sms_projpo WHERE POID = '$POID' ;";
$run	= $con->query($query);
$ctr	= $run->num_rows;
if($ctr	==0)
{
	$query1 = "INSERT INTO `sms_projpo`(`POID`, `PROJID`, `EMPID`,`DATECREATED`,`DELIVERYDATE`,`DELIVERYPLACE`, `RECEIVER`, 
		`PACCOUNT`, `PAYEE`, `BANK`, `CONTACT`, `CONTACTNO`, `TERMS`,`STATUS`,`READSTAT`, `datemodified`) 
		VALUES ('$POID','$PROJ','$EMPID','$NOW','$DDATE','$DPLACE','$RECEIVER',
		'$PAYACC', '$PAYEE','$PBANK','$CONTACT','$CONTACTNO','$TERMS','$STATUS','$READ','$NOW');";
	$run1	= $con->query($query1);
	if($run1)
	{
	$query2="update sms_projects set POCTR = POCTR+1 WHERE PROJID = '$PROJ' ;";
	$run2 = $con->query($query2);
		if($run2)
		{
			$sqladd = "INSERT INTO `sms_pocontent`(`POID`, `PODESC`, `POQTY`, `POUNIT`, `POUNITPRICE`) 
			VALUES ('$POID','$desc','$qty','$unit',$up)";
			$res1 = $con->query($sqladd);
			if($res1){
			echo "<script>
			alert('Item Added.');
			window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
			</script>";
			}else
			{
			echo "<script>
			alert('Item Failed to Add.');
			window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
			</script>";
			}	
		}//if POCTRFAILED TO UPDATE
		else
		{echo "<script>alert('POCTR Failed to update.');window.location.href='newpo.php?proj=$PROJ&&poid=$POID';</script>";}
		}
	else
	{
	echo "<script>
			alert('PO failed to register.');
			window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
			</script>";
	}
}
else
{
$query1  = "UPDATE sms_projpo set `DELIVERYDATE`='$DDATE',`DELIVERYPLACE`='$DPLACE',`RECEIVER`='$RECEIVER',
	`PAYEE`='$PAYEE',`BANK`='$PBANK',`CONTACT`='$CONTACT',`CONTACTNO`='$CONTACTNO',`TERMS`='$TERMS',`datemodified` = '$NOW' WHERE POID = '$POID'; ";
	$run1	= $con->query($query1);
	if($run1)
	{
	
		$sqladd = "INSERT INTO `sms_pocontent`(`POID`, `PODESC`, `POQTY`, `POUNIT`, `POUNITPRICE`) 
		VALUES ('$POID','$desc','$qty','$unit',$up)";
		$res1 = $con->query($sqladd);
		if($res1){
		echo "<script>
		alert('Item Added.');
		window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
		</script>";
		}else
		{
		echo "<script>
		alert('Item Failed to Add.');
		window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
		</script>";
		}	
	}//run1
	else
	{
	echo "<script>
			alert('PO failed to register.');
			window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
			</script>";
	}


}//isset additem
}



if(isset($_GET['cmdsavepo']))
{
//echo "THIS IS SAVING";
$PROJ 	= $_GET['projid'];
$POID 	= $_GET['po'];
date_default_timezone_set('America/Los_Angeles');			
$NOW = date('Y-m-d h:i:s', time());
$DDATE 	= $_GET['ddate'];
$DPLACE = $_GET['dplace'];
$RECEIVER = $_GET['receiver'];	
$PAYACC = $_GET['paccount'];	
$PAYEE	= $_GET['payee'];
$PBANK	= $_GET['pbank'];
$TERMS = $_GET['terms'];
$CONTACT = $_GET['contact'];
$CONTACTNO = $_GET['contactno'];

$query1  = "UPDATE sms_projpo set `DELIVERYDATE`='$DDATE',`DELIVERYPLACE`='$DPLACE',`RECEIVER`='$RECEIVER',
`PAYEE`='$PAYEE',`PACCOUNT`='$PAYACC',`BANK`='$PBANK',`CONTACT`='$CONTACT',`CONTACTNO`='$CONTACTNO',`TERMS`='$TERMS',`datemodified` = '$NOW' WHERE POID = '$POID'; ";
	
$run1	= $con->query($query1);
if($run1)
{
		echo "<script>
		alert('Changes have been saved.');
		window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
		</script>";		
}
else
{
echo "<script>
		alert('Saving failed.');
		window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
		</script>";
}



}







//FUNCTION FOR DELETING ITEM
if(isset($_GET['delitem']))
{
$PROJ 	= $_GET['projid'];
$POID 	= $_GET['po'];
$coid	= $_GET['coid'];
$cd		= $_GET['cd'];
$query 	= "DELETE FROM `sms_pocontent` WHERE `ID` = '$coid' ;";
$run	= $con->query($query);
	if($run)
	{
			echo "<script>alert('Item deleted.');
			window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
			</script>";	
	}else
	{
			echo "<script>alert('Error deleting.');
			window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
			</script>";	
	}
}



//saving item changes
if(isset($_GET['saveitem']))
{
$PROJ 	= $_GET['projid'];
$POID 	= $_GET['po'];
$coid	= $_GET['coid'];
$cd		= $_GET['newcd'];
$qty	= $_GET['newqty'];
$unit	= $_GET['newunit'];
$price	= $_GET['newprice'];
$query 	= "Update `sms_pocontent` set PODESC = '$cd', POQTY = '$qty', POUNIT = '$unit', POUNITPRICE = '$price' WHERE `ID` = '$coid' ;";
$run	= $con->query($query);
	if($run)
	{
			echo "<script>alert('Changes in the item has been saved.');
			window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
			</script>";	
	}else
	{
			echo "<script>alert('Error saving.');
			window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
			</script>";	
	}
}




//sending po
if(isset($_GET['send']))
{
$PROJ 	= $_GET['projid'];
$POID 	= $_GET['po'];
date_default_timezone_set('America/Los_Angeles');			
$NOW = date('Y-m-d h:i:s', time());
$SENT = '2';
$STAT = 'UNREAD';
$query 	= "Update `sms_projpo` set `STATUS` = '$SENT' , `PODATE` = '$NOW',`READSTAT` = 'UNREAD' WHERE `POID` = '$POID' ;";
$run	= $con->query($query);
	if($run)
	{ //echo $NOW;
			echo "<script>alert('PO HAS BEEN SENT FOR CHECKING.');
			window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
			</script>";	
	}else
	{
			echo "<script>alert('PO FAILED TO SEND.');
			window.location.href='newpo.php?proj=$PROJ&&poid=$POID';
			</script>";	
	}
}
?>
