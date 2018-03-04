<?php 
session_start();
if($_SESSION["username"] == null)
 header('location: signUp.php');
else
	header('location: profile.php');
 ?>