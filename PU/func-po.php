<?php
include("nav.php");
$con = db_connect();

if(isset($_POST['cmdadd']))
{
$PROJ = $_POST['PROJID'];
$EMPID = $_POST['EMPID'];
$POID = $_POST['POID'];
$itemctr = $_POST['ctr'];
$desc = $_POST['desc'];
$qty = $_POST['qty'];
$unit = $_POST['unit'];
$price = $_POST['unitprice'];
//$amount = (floatval($qty)) * (floatval($price));
$amount = $qty * $price;
$amount = floatval($amount);
$sql1 = "INSERT INTO `sms_pocontent`(`ITEMID`, `POID`, `PODESC`, `POQTY`, `POUNIT`, `POUNITPRICE`, `PCOTOTAL`) 
 VALUES ('$itemctr','$POID','$desc','$qty','$unit',$price,'$amount')";
$res1 = $con->query($sql1);
if($res1)
{
	$sql2 = "SELECT * FROM `sms_projpo` WHERE POID = '$POID';";
	$res2 = $con->query($sql2);
	$ctr2 = $res2->num_rows;
	if($ctr2 >= 1)
	{
	$sql3 = "UPDATE `sms_projpo` set ITEMCTR = '$itemctr' WHERE POID = '$POID' ;";
	$res3 = $con->query($sql3);
	if($res3)
	{
		echo "<script>
		alert('ITEMCTR updated.');
		window.location.href='addpo.php?proj=$PROJ';
		</script>";
	}
	else
	{
		echo "<script>
		alert('ITEMCTR failed to update.');
		window.location.href='addpo.php?proj=$PROJ';
		</script>";
	}
		
		
	}else//IF IT IS THE FIRST ITEM
	{
	$STATUS = '1';
	$sql4 = "INSERT INTO `sms_projpo`(`POID`, `PROJID`, `EMPID`,`ITEMCTR`, `STATUS`) 
	VALUES('$POID','$PROJ','$EMPID','$itemctr','$STATUS');";
	$res4 = $con->query($sql4);
	if($res4)
	{
		echo "<script>
		alert('ITEM ADDED.');
		window.location.href='addpo.php?proj=$PROJ';
		</script>";
	}
	else //if inserting the first item of this PO failed
	{
		echo "<script>
		alert('SQL4 FAILED.');
		window.location.href='addpo.php?proj=$PROJ';
		</script>";
	}
	

	}//END OF else of SQL2
}
else//IF ITEM FAILED TO ADD
{
	echo "<script>
		alert('SQL1 failed to insert.');
		window.location.href='addpo.php?proj=$PROJ';
		</script>";
}

}//end of cmdadd for item adding button


if(isset($_POST['cmdsubmitpo']))
{
$PROJ = $_POST['PROJID'];
$POID = $_POST['POID'];
echo "<script>
window.location.href='submit.php?proj=$PROJ&&poid=$POID';
      </script>";
}


?>

