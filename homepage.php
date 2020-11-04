<?php
session_start();

if (isset($_GET["submitted"]) && $_GET["submitted"])	
{
	$search = $_GET["search"];
	
	// Open a new connection to mysql database and check that it connected properly 
	$db = new mysqli("localhost", "ADD MySQL Database name here", "ADD MySQL Password here", "ADD MySQL Username here");
	if ($db->connect_error)
	{
		die ("Connection failed: " . $db->connect_error);
	}

	// Retrive the book's book_id, title, author, and picture from the database based on the search
	$q = "SELECT book_id, title, author, pic FROM Books WHERE (title LIKE '%$search%') OR (author LIKE '%$search%') OR (genre LIKE '%$search%')";

	$r = $db->query($q);

	$db->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>BookExplorer: Search & Save Books</title>
	<link rel="stylesheet" type="text/css" href="WebApp.css" />

	<meta charset="UTF-8">

</head>

<body>
	<div class="header-img">
		<h1> BookExplorer </h1>
	</div>

	<!--Moved the php for the nav bar here to remove the html code duplication-->
	<?php
	if (isset($_SESSION["username"]))
	{
	?>

	<ul>
  		<li><a class="active" href="#home">Home</a></li>
  		<li><a href="profile.php">Profile</a></li>
  		<li><a href="contact.php">Contact</a></li>
  		<li style="float:right"><!--<button class="logout-button" action="logout.php">Log out</button>--><a href="logout.php"> Log out</a></li>
	</ul>

	<?php
	}
	else
	{
	?>

	<ul>
  		<li><a class="active" href="#home">Home</a></li>
  		<!--<li><a href="profile.html">Profile</a></li>-->
  		<li><a href="contact.php">Contact</a></li>
  		<!--<li style="float:right"><button class="logout-button">Log out</button></li>-->
  		<li style="float:right"><a href="createAccount.php">Sign up</a></li>
  		<li style="float:right"><a href="login.php">Login</a></li>
	</ul>

	<?php
	}
	?>

	<div class="grid-container">
		<div class="empty">  </div> <!-- this is here to create the space between the search bar and the nav bar --> 
		<div class="inner-search-row">  
			<div class="empty"></div>   <!-- this is here to create space and try to center the search box --> 
			<div class="search">
				<form class="search-field">
					<input type="hidden" name="submitted" value="1" />
  					<input type="text" placeholder="Search.." name="search">
  					<input type="submit" value="Search">
				</form>
			</div>
		</div>
	    

		<div class="inner-grid-container"> 			
			<!-- The following code will display book results -->
			<?php 
			while($row = $r->fetch_object())
			{	
				// Decreased the size of the title and author to avoid results overlapping
				echo "<div class=\"book-search-result\">
					<h4 class=\"book-listing-spacing\">$row->title<br></h4>
					<h5 class=\"book-listing-spacing\">$row->author<br></h5>
					<a href=\"bookinfo.php?id=$row->book_id\"><img class=\"book-listing-spacing\" src=\"$row->pic\" alt=\"$row->title\" style=\"width:100px\"></a><br>
					<a class=\"book-listing-spacing\" href=\"bookinfo.php?id=$row->book_id\"> More Info </a><br>";
				echo "</div>";
			}
			$result -> free_result();
			?>
		</div> 
	</div>

</body>

</html>