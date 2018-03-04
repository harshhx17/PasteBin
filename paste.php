<?php 
session_start();
require(mysql.php);
if($_SESSION["username"] == null)
	die(header('location: signIn.php'));

require("mysql.php");
$username = $_SESSION['username'];
$id = $_GET["id"];
$result = mysqli_query($link,"SELECT Username, Paste FROM Paste WHERE Id='$id' LIMIT 1");
if($result->num_rows == 1)
{
	$result1 = mysqli_fetch_assoc($result);
	$text = $result1["Paste"];
	$owner = $result1["Username"];
	if($owner == $username)
		print_r('<div>'.$text.'</div>');
	else
	{
		print_r("You do not have the permission to see this text. Please ensure you have logged in with the id of the owner of this paste.");
	}
}
else
{
	print_r("Error 404! Paste Not Found.");
}