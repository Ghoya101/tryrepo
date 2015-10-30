<?php
session_start();
unset($_SESSION['curuser']);
session_destroy();
header("Location:index.php");
?>