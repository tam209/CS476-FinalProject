<?php
session_start();

$validate = true;
$reg_Uname = "/^(\S*)[a-zA-Z0-9]+(\S*)$/";
$reg_Pword ="/^(\S*)?\d+(\S*)?$/";


$username = "";
$error = "";
if (isset($_POST["submitted"]) && $_POST["submitted"])
{
	$username = trim($_POST["username"]);
	$password = trim($_POST["pwd"]);

	$db = new mysqli("localhost", "ADD MySQL Database name here", "ADD MySQL Password here", "ADD MySQL Username here");
	if ($db->connect_error)
	{
		die ("Connection failed: " . $db->connect_error);
	}

	$q = "SELECT * FROM Users WHERE username = '$username' AND password = '$password'";

	$r = $db->query($q);
	$row = $r->fetch_assoc();
	
	//check to see if the username and password match what is in the database
	if ($username != $row["username"] && $password != $row["password"])
	{
		$validate = false;
	}
	else
	{
		$usernameMatch = preg_match($reg_Uname, $username);
		if ($username == null || $username == "" || $usernameMatch == false)
		{
			$validate = false;
		}

		$pswdLen = strlen($password);
		$passwordMatch = preg_match($reg_Pword, $password);
		if ($password == null || $password == "" || $pswdLen < 8 || $passwordMatch == false)
		{
			$validate = false;
		}
	}

	if ($validate == true)
	{
		session_start();
		$_SESSION["username"] = $row["username"];
		header("Location: homepage.php");
		$db->close();
		exit();
	}

	else
	{
		$error = "The username/password combination was incorrect. Login failed.";
		$db->close();
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>BookExplorer: Login</title>
	<link rel="stylesheet" type="text/css" href="WebApp.css" />

	<meta charset="UTF-8">

	<script type="text/javascript" src="login_validate.js"></script> 

	<!-- This style tag is for the background on the login.html page -->
	<style>

	body {
		background-image: url('loginpage.jpg');
		background-repeat: no-repeat;
		background-attachment: fixed; 
  		background-size: cover;
	}	

	.err_msg {
		color:red;
		font-size: 13px;
	}	

	</style>

</head>

<body>

	<div class="login-background-text">
		<h2>Welcome to BookExplorer</h2>
	</div>

	<div class="login-form-box">
		<div class="child">
			<form action="login.php" id="Login" method="post">
				<input type ="hidden" name="submitted" value="1"/>
				<table>
					<tr><?=$error?></tr>
					<tr><td></td><td><label id="u_msg" class="err_msg"></label></td></tr>
					<tr><td><label for="username">Username:</label></td>
					<td><input type="text" id="username" name="username"></td></tr>
					<tr><td></td><td><label id="pwd_msg" class="err_msg"></label></td></tr>
					<tr><td><label for="pwd">Password:</label></td>
					<td><input type="text" id="pwd" name="pwd"></td></tr>
				</table>
				<input type="submit" class="button-style"  name="login" value="Login">
			</form>

			<p1> Don't have an account? <a href="createAccount.php">Create Account</a> <br>
			Continue as a <a href="homepage.php">Guest</a><br>
			</p1>
		</div>
	</div>

<!--<div id="display_info"></div>-->

<script type = "text/javascript"  src = "login_validate_r.js" ></script>

</body>

</html>
