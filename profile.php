<?php
session_start();

if (isset($_SESSION["username"]))
{

	$username = $_SESSION["username"];

	$db = new mysqli("localhost", "ADD MySQL Database name here", "ADD MySQL Password here", "ADD MySQL Username here");
	if ($db->connect_error)
	{
		die ("Connection failed: " . $db->connect_error);
	}

	$q = "SELECT first_name, last_name, email FROM Users WHERE username = '$username'";

	$r = $db->query($q);
	$row = $r->fetch_assoc();
	
	$fname = $row["first_name"];
	$lname = $row["last_name"];
	$email = $row["email"];
?>



<!DOCTYPE html>
<html>
<head>
	<title>BookExplorer: Profile</title>
	<link rel="stylesheet" type="text/css" href="WebApp.css" />

	<meta charset="UTF-8">

</head>

<body>
	<div class="header-img">
		<h1> BookExplorer </h1>
	</div>

	<ul>
  		<li><a href="homepage.php">Home</a></li>
  		<li><a class="active" href="profile.php">Profile</a></li>
  		<li><a href="contact.php">Contact</a></li>
		<li style="float:right"><!--<button class="logout-button" action="logout.php">Log out</button>--><a href="logout.php"> Log out</a></li>	</ul>

	<div class="profile-info">
  		<div class="user-avatar"> 
  			<br> <!-- using <br> to give the space between nav bar and the image -->
			<img src="sunflower.jpg" alt="sunflower" style="width:200px">
		</div>
		<div class="user-info">
			<?php
			echo "<h3> Welcome, ".$username."! </h3>
			<p3>".$fname." ".$lname."</p3> <br>
			<p3>".$email."</p3><br>";
			?>
		</div>
	</div>

	<h2 class="Saved-books-header"> Your Saved Books </h2>

	<div class="inner-grid-container"> 
		<div class="item1"> 
			<h3 class="book-listing-spacing">Title1  <br></h3>
			<h4 class="book-listing-spacing">Author <br></h4>
			<img class="book-listing-spacing" src="harrypotter.jpg" alt="HarryPotter" style="width:80px"> <br>
			<a class="book-listing-spacing" href="bookinfo.html"> More Info </a><br>
		<button class="remove-button">Remove book</button>
		</div>
		<div class="item2"> Book2 </div>
		<div class="item3"> Book3 </div>
		<div class="item4"> Book4 </div>
		<div class="item5"> Book5 </div>
	</div> 

</body>

</html>

<?php
}
else
{
	echo "Error Opening Profile Page";
}
?>
