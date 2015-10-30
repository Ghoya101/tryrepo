<?php
	require_once("idiorm.php");
    date_default_timezone_set("Asia/Manila");
    ORM::configure("mysql:host=localhost;dbname=db_sms10");
    ORM::configure("username", "root");
    ORM::configure("password", "");
    ORM::configure("logging", false);
    ORM::configure("return_result_sets", true);
    
	function db_connect() 
	{
		$user='root';
	    $pass='';
		$server='localhost';
	    $database='db_sms10';

	    $result = new mysqli($server,$user,$pass,$database);
		if (!$result) return false;
		return $result;
	}

?>