<?php  
session_start();
// error_reporting("-1");
// ini_set('display_errors',"On");
// $link = new mysqli('localhost','root','AARYAN1235','PasteBin');
// if($link->connect_errno)
// 	die ("Connection attempt unsuccesfull");
require("mysql.php");
if(isset($_POST['sign_in']))
{
	print_r($_SERVER['REQUEST_METHOD'] == 'POST');
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = mysqli_real_escape_string($link,$_POST['username']);
		$password = mysqli_real_escape_string($link,$_POST['password']);
		$result = mysqli_query($link,"SELECT * FROM UserCredentials WHERE Username = '$username' and Password = '$password' LIMIT 1");
		$_SESSION["username"] = $username;
		echo '<br/>' ;
		if($result->num_rows == 1)
		{
			header('location: profile.php');
		}
	}
	else
	{
		echo "Please use the post method to request.";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
		<h3>Sign In</h3>
		<form action="signIn.php" method="post">
			Username:<input type="text" name="username">
			<br/>
			Password:<input type="password" name="password">
			<br/>
			<input type="submit" name="sign_in" value="Sign In">
		</form>
	</div>
	<div>
		Don't have an account Yet! <a href="/PasteBin/signUp.php"><button>Sign Up</button></a>
	</div>
</body>
</html>