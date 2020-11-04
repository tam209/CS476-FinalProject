<?php
	session_start();
	
	// get the book id passed over the URL
	if (isset($_GET['id']))
	{
		$book_id = $_GET['id'];
	
		// Open a new connection to mysql database and check that it connected properly 
		$db = new mysqli("localhost", "ADD MySQL Database name here", "ADD MySQL Password here", "ADD MySQL Username here");
		if ($db->connect_error)
		{
			die ("Connection failed: " . $db->connect_error);
		}
		
		// Retrive the current book's information from the database
		$q = "SELECT title, author, genre, pic, link FROM Books WHERE book_id = '$book_id'";

		$r = $db->query($q);
		$row = $r->fetch_assoc();
		
		// Store the book's information in variables
		$title = $row["title"];
		$author = $row["author"];
		$genre = $row["genre"];
		$pic = $row["pic"];
		$link = $row["link"];

		$db->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>BookExplorer: Book Information</title>
	<link rel="stylesheet" type="text/css" href="WebApp.css" />

	<meta charset="UTF-8">

</head>

<body>
	<div class="header-img">
		<h1> BookExplorer </h1>
	</div>

	<?php
	if (isset($_SESSION["username"]))
	{
	?>
	<ul>
  		<li><a class="active" href="homepage.php">Home</a></li>
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
  		<li><a class="active" href="homepage.php">Home</a></li>
  		<!--<li><a href="profile.html">Profile</a></li>-->
  		<li><a href="contact.php">Contact</a></li>
  		<!--<li style="float:right"><button class="logout-button">Log out</button></li>-->
  		<li style="float:right"><a href="createAccount.php">Sign up</a></li>
  		<li style="float:right"><a href="login.php">Login</a></li>
	</ul>

	<?php
	}
	?>

	<div class="book-info-placement">
		<h2>Book Info Page</h2>

		<div class="book-grid">
		<!-- Code for displaying the book information-->
		<?php
		// if the user is logged in, allow them to save the book. Otherwise tell them to log in
		if (isset($_SESSION["username"]))
		{
			// NOTE: still need to add the php for the save and email buttons
			echo "<div class=\"bookcover\"> <img src=\"$pic\" alt=\"HarryPotter\"> </div>";
			echo "<div class=\"bookinfo\">";
				echo "<h3>$title</h3><br>
				<h4>$author</h3><br>
				<p>Find out more at <a href=\"$link\" target=\"_blank\">GoodReads.com</a></p>
				<button class=\"button\">Save</button>
				<button class=\"button\">Email</button>";
			echo"</div>";
		}
		else
		{
			// if the user is not logged in, prompt them to log in to save a book
			echo "<div class=\"bookcover\"> <img src=\"$pic\" alt=\"HarryPotter\"> </div>";
			echo "<div class=\"bookinfo\">";
				echo "<h3>$title</h3>
				<h4>Author: $author</h4>
				<h4>Genre: $genre</h4>
				<p>Find out more at <a href=\"$link\" target=\"_blank\">GoodReads.com</a></p><br>
				<p>Want to save this book to view later? Please
				<a href = \"login.php\">Login<a> or <a href=\"createAccount.php\">Create an account</a>.</p>
				<button class=\"button\">Email</button>";
			echo"</div>";

		}
		?>
		</div>
	</div>

</body>

</html>

<?php
}
else
{
	echo "Error Opening Book Information Page.";
}
?>
