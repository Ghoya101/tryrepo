<?php
include("nav.php");
$con = db_connect();
$USER = $empid;

if(isset($_POST['cmd']))
{
date_default_timezone_set('America/Los_Angeles');			
$NOW = date('Y-m-d h:i:s a', time());
$note	=$_POST['note_content'];
$id 	=$_POST['subcat'];
$PO 	=$_POST['po-id']; 
//$CAT 	=$_POST[];
$ACTION =$_POST['cmd'];
if($ACTION == 'APPROVE')
{
$el = $_POST['valme'];
	if($el == '')
	{
		echo "<script>
		alert('Please choose a category before approving.');
		window.location.href='approvepo.php?poid=$PO';
		</script>";
	}else
	{
	$sql = "Update `sms_projpo` set APPROVEDATE = '$NOW' , CHECKER = '$USER',STATUS = '3', READSTAT = 'READ', CAT = '$el' WHERE POID = '$PO' ";
	$res = $con->query($sql);
	if($res){echo "<script>alert('PO Approved.');window.location.href='index.php';</script>";}else{echo "<script>alert('PO Approval failed to update.');window.location.href='index.php';</script>";}
	}
}else if($ACTION == 'REJECT')
{	
	$sql = "Update `sms_projpo` set APPROVEDATE = '$NOW' , CHECKER = '$USER',PO_STATUS = 'REJECTED' WHERE POID = '$PO' ";
	$res = $con->query($sql);
	if($res){echo "<script>alert('PO Rejected.');window.location.href='index.php';</script>";}else{echo "<script>alert('PO STATUS REJECT failed to update.');window.location.href='index.php';</script>";}
}
else if($ACTION == 'REVISE')
{
	if($note == '')
	{
		echo "<script>
		alert('Please comment what needs to be revised.');
		window.location.href='approvepo.php?poid=$PO';
		</script>";
	}else
	{
	$sql = "Update `sms_projpo` set FORREVISIONDATE = '$NOW' , PO_STATUS = 'FOR REVISION' WHERE POID = '$PO' ";
	$res = $con->query($sql);
	if($res)
	{
		$sql1 = "INSERT into `sms_pocomments` (POID,COMMENT,EMPID,DATECREATED) VALUES('$PO','$note',$USER,'$NOW')";
		$res1 = $con->query($sql1);
		if($res1){echo "<script>alert('PO subjected for revision.');window.location.href='index.php';</script>";}else{echo "<script>alert('PO revision command failed to execute.');window.location.href='index.php';</script>";}

	}else{echo "<script>alert('Revision Update failed top execute.Please contact the administrator for assitance.');window.location.href='index.php';</script>";}
	
	
	
	//if($res){echo "<script>alert('PO subjected for revision.');window.location.href='po.php';</script>";}else{echo "<script>alert('PO revision command failed to execute.');window.location.href='viewpo.php?poid=$PO';</script>";}
	}
}


}//if isset cmd
?>