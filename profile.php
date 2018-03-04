<?php
session_start();
if($_SESSION["username"] == null)
	die(header('location: signIn.php'));
require("mysql.php");

$username = $_SESSION['username'];
print_r("<br>");
if(isset($_POST['logout']))
{
	session_destroy();
	header('location: signIn.php');
}
if(isset($_POST['paste']))
{
	$text = $_POST['text'];
	if(empty($_POST['Switch']))
		$private = 0;
	else 
		$private = 1;
	if($_POST['text'] == null)
	{
		print_r("You might want to write some text before pasting it.");
	}
	else
	{
		$count = mysqli_fetch_assoc($link->query ("SELECT * FROM currentIndex"))["count"];
		$link->query ("DELETE FROM currentIndex WHERE count = '$count'");
		$link->query ("INSERT INTO Paste (Id, Username, Paste, Private) VALUES ('$count', '$username', '$text', '$private')");
		print_r('<br>' . 'Use this link to access this paste:' . '<br>' . 'localhost/PasteBin/paste.php?id=' . "$count");
		$count = $count + 1;
		$link->query ("INSERT INTO currentIndex (count) VALUES ($count)");
	}
}
$result1 = mysqli_query($link, "SELECT * FROM Paste WHERE Username = '$username'");
$temp = mysqli_fetch_assoc($result1);
while($temp != null){
	if(isset($_POST["Update$temp[Id]"]))
	{
		if(empty($_POST["Switch$temp[Id]"]) and $temp["Private"] == 1)
		{
			$link->query("DELETE FROM Paste WHERE Id = $temp[Id]");
			$link->query("INSERT INTO Paste (Id, Username, Paste, Private) VALUES ('$temp[Id]','$temp[Username]','$temp[Paste]', 0)");
		}
		else if(!empty($_POST["Switch$temp[Id]"]) and $temp["Private"] == 0)
		{
			$link->query("DELETE FROM Paste WHERE Id = $temp[Id]");
			$link->query("INSERT INTO Paste (Id, Username, Paste, Private) VALUES ('$temp[Id]','$temp[Username]','$temp[Paste]', 1)");
		}
		break;
	}
	else if(isset($_POST["Delete$temp[Id]"]))
	{
		$link->query("DELETE FROM Paste WHERE Id = $temp[Id]");
		break;
	}
	$temp = mysqli_fetch_assoc($result1);
}
$link->close();
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
	#textarea{
		width: 500;
		height: 500;
	}
</style>
<title>Dashboard</title>
</head>
<body>
	<div>
		<form action="profile.php" method="post">
			<?php print_r("Welcome " . $_SESSION["username"]); ?>
			<input type="submit" name="logout" value="logout">
		</form>
	</div>
	<form action="profile.php" method="post">
		<textarea id="textarea" name="text"></textarea>
		Private:<input type="checkbox" name="Switch" >
		<input type="submit" name="paste" value="paste">
	</form>
	<br>
	<div>
		DASHBOARD
		<form action="profile.php" method="post">
			<?php 
			error_reporting("-1");
			ini_set('display_errors',"On");
			require("mysql.php");
			$username = $_SESSION["username"];
			$result = mysqli_query($link, "SELECT * FROM Paste WHERE Username = '$username'");
			$temp = mysqli_fetch_assoc($result);
			$temp2 = 0;
			if($temp == null)
				$temp2 = 1;
			while($temp != null)
			{
				if($temp["Private"] == 1)
					echo "<hr>Id: $temp[Id] <br> $temp[Paste] <br> private:<input type='checkbox' name='Switch$temp[Id]' checked='True' value='Switch'> <input type='submit' name='Update$temp[Id]' value='Update'><br><input type='submit' name='Delete$temp[Id]' value='Delete'> ";
				else
					echo "<hr>Id: $temp[Id] <br> $temp[Paste] <br> private:<input type='checkbox' name='Switch$temp[Id]' value='Switch'> <input type='submit' name='Update$temp[Id]' value='Update'><br><input type='submit' name='Delete$temp[Id]' value='Delete'>";
				$temp = mysqli_fetch_assoc($result);
			}
			if($temp2 != 1)
				print_r("<hr>");
			else
			{
				print_r("You do not have any pastes yet.");
			}
			$link->close();
			?>
		</form>
	</div>
</body>
</html>
