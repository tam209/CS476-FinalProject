<?php
session_start();

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$validate = true;
$error = "";
$reg_Fname = "/^[A-Z][a-z]*$/";
$reg_Lname = "/^[a-zA-Z ,.'-]+$/";
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/"; 
$reg_Bday = "/^([0-9]{4})-(0?[1-9]|1[0-2])-(0?[1-9]|1\d|2\d|3[0-1])$/";
$reg_Uname = "/^(\S*)[a-zA-Z0-9]+(\S*)$/";
$reg_Pword ="/^(\S*)?\d+(\S*)?$/";
$email = "";
$birth ="yyyy-mm-dd";

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
}

// Check if file already exists
if (file_exists($target_file)) {
	//echo "Sorry, file already exists.";
	$uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
	//echo "Sorry, your file is too large.";
	$uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
	//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	//echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}

if (isset($_POST["submitted"]) && $_POST["submitted"]) {
	$fName = trim($_POST["fname"]);
	$lName = trim($_POST["lname"]);
	$email = trim($_POST["email"]);
	$birth = trim($_POST["DoB"]);
	$username = trim($_POST["username"]);
	$password = trim($_POST["re-pwd"]);
	// Check if image file is a actual image or fake image
	
	$db = new mysqli("localhost", "ADD MySQL Database name here", "ADD MySQL Password here", "ADD MySQL Username here");
	if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
	}
	
	//Check if email address is already taken
	$q1 = "SELECT * FROM Users WHERE email = '$email';";
	$r1 = $db->query($q1);

	//Check if username is already taken
	$q2 = "SELECT * FROM Users WHERE username = '$username';";
	$r2 = $db->query($q2);
	
	// if the email address is already taken.
	if($r1->num_rows > 0) {
		$validate = false;
		$var = "Email is already taken. Please enter a different one.";
	}

	// if the username is already taken
	else if ($r2->num_rows > 0) {
		$validate = false;
		$var2 = "Username is already taken. Please enter a different one.";
	}

	else {
		$fNameMatch = preg_match($reg_Fname, $fName);
		if ($fName == null || $fName == "" || $fNameMatch == false) {
			$validate = false;
		}

		$lNameMatch = preg_match($reg_Lname, $lName);
		if ($lName == null || $lName == "" || $lNameMatch == false) {
			$validate = false;
		}

		$emailMatch = preg_match($reg_Email, $email);
		if($email == null || $email == "" || $emailMatch == false) {
			$validate = false;
		}

		$birthMatch = preg_match($reg_Bday, $birth);
		if ($birth == null || $birth == "" || $birthMatch == false) {
			$validate = false;
		}
		
		$usernameMatch = preg_match($reg_Uname, $username);
		if($username == null || $username == "" || $usernameMatch == false) {
			$validate = false;
		}
		
		$passwordLen = strlen($password);
		$passwordMatch = preg_match($reg_Pword, $password);
		if ($password == null || $password == "" || $passwordLen < 8 || $passwordMatch == false) {
			$validate = false;
		}
	}
	
	if ($validate == 1) {
		$birthFormat = date("Y-m-d", strtotime($birth));
		$q_insert = "INSERT INTO Users (first_name, last_name, email, username, password, dob, pic) VALUES ('$fName', '$lName', '$email','$username', '$password', '$birthFormat', '$target_file')";
		$r_insert = $db->query($q_insert);
		
		if ($r_insert === true) {
			header("Location: homepage.php");
			$db->close();
			exit();
		}
		else {
			$error = "email address is not avaliable. Signup failed.";
			$db->close();
		}
	}		
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>BookExplorer: Create an Account</title>
	<link rel="stylesheet" type="text/css" href="WebApp.css" />

	<meta charset="UTF-8">

	<script type="text/javascript" src="createAccount.js"></script>

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

	<div class="create-account-text">
		<h2>Create Account</h2>
	</div>

	<div class="create-account-form-box">
		<div class="child">
			<p><?=$var?></p>
			<p><?=$var2?></p>
			<form action="createAccount.php" id="createAccount" method="post" enctype="multipart/form-data">
				<input type="hidden" name="submitted" value="1" /> 
				<table>
					<tr><td></td><td><label id="fname_msg" class="err_msg"></label></td></tr>
					<tr><td><label for="fname">First name:</label></td>
					<td><input type="text" id="fname" name="fname" size="30"></td></tr>
					<tr><td></td><td><label id="lname_msg" class="err_msg"></label></td></tr>
					<tr><td><label for="lname">Last name:</label></td>
					<td><input type="text" id="lname" name="lname" size="30"></td></tr>
					<tr><td></td><td><label id="e_msg" class="err_msg"></label></td></tr>
					<tr><td><label for="email">Email:</label></td>
					<td><input type="text" id="email" name="email" size="30"></td></tr>
					<tr><td></td><td><label id="dob_msg" class="err_msg"></label></td></tr>
					<tr><td><label for="DoB">Date of birth: <br/> (yyyy-mm-dd) <br/></label></td>
					<td><input type="text" id="DoB" name="DoB" size="30"></td></tr>
					<tr><td></td><td><label id="avatar_msg" class="err_msg"></label></td></tr>
					<tr><td><label for="avatar">Avatar: </label></td>
					<td><input type="file" name="fileToUpload" id="fileToUpload"></td></tr>
					<tr><td></td><td><label id="u_msg" class="err_msg"></label></td></tr>
				    <tr><td><label for="username">Username:</label></td>
				    <td><input type="text" id="username" name="username" size="30"></td></tr>
				    <tr><td></td><td><label id="pwd_msg" class="err_msg"></label></td></tr>
					<tr><td><label for="pwd">Password:</label></td>
					<td><input type="text" id="pwd" name="pwd" size="30"></td></tr>
					<tr><td></td><td><label id="pwd2_msg" class="err_msg"></label></td></tr>
					<tr><td><label for="re-pwd">Re-enter Password:</label></td>
					<td><input type="text" id="re-pwd" name="re-pwd" size="30"></td></tr>
				</table>
				<input class="button-style" type="submit" name="createAccount" value="Create Account">
				<input class="button-style" type="reset" name="reset" value="Reset">
			</form>

			<p1> Go <a href="login.php">Back</a> <br>
			</p1>
		</div>
	</div>

<script type="text/javascript" src="createAccount_r.js"></script>

</body>

</html>
