<?php
session_start();

if (isset($_SESSION["username"]))
{
?>

<!DOCTYPE html>
<html>
<head>
	<title>BookExplorer: Contact</title>
	<link rel="stylesheet" type="text/css" href="WebApp.css" />

	<meta charset="UTF-8">
	
	<script type="text/javascript" src="contactForm_validate.js"></script>
	
	<style>

	.err_msg {
		color:red;
		font-size: 13px;
	}

	</style>

</head>

<body>
	<div class="header-img">
		<h1> BookExplorer </h1>
	</div>

	<ul>
  		<li><a href="homepage.php">Home</a></li>
  		<li><a href="profile.php">Profile</a></li>
  		<li><a class="active" href="contact.php">Contact</a></li>
        <li style="float:right"><!--<button class="logout-button" action="logout.php">Log out</button>--><a href="logout.php"> Log out</a></li>
	</ul>

	<div class="contact-grid">
		<div class="empty-contact-grid"></div>
		<div class="contact-info">
			<h2>Contact us </h2>

			<form action="mail.php" class="contact-form" id="contactForm" method="post">
				<p><label id="e_msg" class="err_msg"></label></p>
				<input type="text" id="email" placeholder="Enter email" name="email">
				<p><label id="sub_msg" class="err_msg"></label></p>
				<input type="text" id="subject" placeholder="Enter subject" name="subject">
				<p><label id="body_msg" class="err_msg"></label></p>
				<textarea id="email-body" placeholder="Enter text" name="email-body" style="height:200px"></textarea>
				<p><label id="charleft_msg" class="err_msg"></label></p>
				<button class="contact-submit"> Submit </button>	
			</form>
		</div>
	</div>

<script type="text/javascript" src="contactForm_validate_r.js"></script>	
	
</body>

</html>

<?php
}

else
{
?>

<!DOCTYPE html>
<html>
<head>
	<title>BookExplorer: Contact</title>
	<link rel="stylesheet" type="text/css" href="WebApp.css" />

	<meta charset="UTF-8">
	
	<script type="text/javascript" src="contactForm_validate.js"></script>
	
	<style>

	.err_msg {
		color:red;
		font-size: 13px;
	}

	</style>

</head>

<body>
	<div class="header-img">
		<h1> BookExplorer </h1>
	</div>

	<ul>
  		<li><a href="homepage.php">Home</a></li>
        <li><a class="active" href="contact.php">Contact</a></li>
        <!--<li style="float:right"><button class="logout-button">Log out</button></li>-->
  		<li style="float:right"><a href="createAccount.php">Sign up</a></li>
  		<li style="float:right"><a href="login.php">Login</a></li>
	</ul>

	<div class="contact-grid">
		<div class="empty-contact-grid"></div>
		<div class="contact-info">
			<h2>Contact us </h2>

			<form action="mail.php" class="contact-form" id="contactForm" method="post">
				<p><label id="e_msg" class="err_msg"></label></p>
				<input type="text" id="email" placeholder="Enter email" name="email">
				<p><label id="sub_msg" class="err_msg"></label></p>
				<input type="text" id="subject" placeholder="Enter subject" name="subject">
				<p><label id="body_msg" class="err_msg"></label></p>
				<textarea id="email-body" placeholder="Enter text" name="email-body" style="height:200px"></textarea>
				<p><label id="charleft_msg" class="err_msg"></label></p>
				<button class="contact-submit"> Submit </button>	
			</form>
		</div>
	</div>

<script type="text/javascript" src="contactForm_validate_r.js"></script>	
	
</body>

</html>

<?php
}
?>