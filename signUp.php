<?php 
session_start();
// error_reporting("-1");
// ini_set('display_errors',"On");
// $link = new mysqli('localhost','root','AARYAN1235','PasteBin');
// if($link->connect_errno)
// 	die ("Connection attempt unsuccesfull");
require("mysql.php");
if(isset($_POST['sign_up']))
{
	$username = $_POST[username];
	$password = $_POST[password];
	$result = mysqli_query($link,"SELECT * FROM UserCredentials WHERE Username = '$username' LIMIT 1");
	if($result->num_rows != 1)
	{
		$link->query("INSERT INTO UserCredentials (Username,Password) VALUES ('$username','$password') ");
		$_SESSION["username"] = $username;
		header('location: profile.php');
	}
	else
		print_r("Please select a different username.");
}
$link->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
		<h3>Sign Up</h3>
		<form action="signUp.php" method="post">
			Username:<input type="text" name="username">
			<br/>
			Password:<input type="password" name="password">
			<br/>
			<input type="submit" name="sign_up" value="Sign Up">
		</form>
	</div>
	<div>
		Already have an account
		<a href="/PasteBin/signIn.php"><button>Sign in</button></a>
	</div>
</body>
</html>