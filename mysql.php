<?php 
// error_reporting("-1");
// ini_set('display_errors',"On");
$host = "localhost";
$username = "";
$password = "";
$database = "";
$link = new mysqli($host, $username, $password, $database);
if($link->connect_errno)
	die ("Connection attempt unsuccesfull");
 ?>
