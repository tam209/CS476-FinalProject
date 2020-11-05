<?php
session_start();
// if the user is logged in, get the book id passed over the URL and show save option
if(isset($_SESSION["username"]) &&isset($_GET['id']))
{
	$username = $_SESSION["username"];
	$book_id = $_GET['id'];

	//create a variable to store the Save button display
	$button = "Save";

	// Open a new connection to mysql database and check that it connected properly 
	$db = new mysqli("localhost", "ADD MySQL Database name here", "ADD MySQL Password here", "ADD MySQL Username here");
	if ($db->connect_error)
	{
		die ("Connection failed: " . $db->connect_error);
	}
	
	// Retrive the current book's information from the database
	$q1 = "SELECT title, author, genre, pic, link FROM Books WHERE book_id = '$book_id'";
	$r1 = $db->query($q1);
	$row = $r1->fetch_assoc();
	
	// Store the book's information in variables
	$title = $row["title"];
	$author = $row["author"];
	$genre = $row["genre"];
	$pic = $row["pic"];
	$link = $row["link"];
	
	// get the current user's id to store in SavedBooks table
	$q2 = "SELECT user_id FROM Users WHERE username = '$username'";
	$r2 = $db->query($q2);
	$row = $r2->fetch_assoc();		
	$user_id = $row["user_id"];

	// check if the user has already saved this book
	$q3 = "SELECT * FROM SavedBooks WHERE (book_id = '$book_id') AND (user_id = '$user_id')";
	$r3 = $db->query($q3);
	if($r3->num_rows > 0)
	{
		$button = "Saved!";
	}
	
	// if the user presses the save button, save the book to the SavedBooks database
	if(isset($_POST["save"]))
	{

		if($r3->num_rows == 0)
		{
			// Insert the user_id and book_id into the SavedBooks database
			$q4 = "INSERT INTO SavedBooks (user_id, book_id) VALUES ('$user_id', '$book_id')";
			$r4 = $db->query($q4);
			$button = "Saved!";
			if($r4 == false)
			{
				echo "An error occured with saving the book.";
			}
		}
	}

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

	<ul>
  		<li><a class="active" href="homepage.php">Home</a></li>
  		<li><a href="profile.php">Profile</a></li>
  		<li><a href="contact.php">Contact</a></li>
  		<li style="float:right"><!--<button class="logout-button" action="logout.php">Log out</button>--><a href="logout.php"> Log out</a></li>
	</ul>

	<div class="book-info-placement">
		<h2>Book Information</h2>

		<div class="book-grid">
		<!-- Code for displaying the book information-->
		<?php
			// if the user is logged in, allow them to save the book
			// NOTE: still need to add the php for the save and email buttons
			echo "<div class=\"bookcover\"> <img src=\"$pic\" alt=\"HarryPotter\" width = \"90%\"> </div>";
			echo "<div class=\"bookinfo\">";
				echo "<h3>$title</h3>
				<h4>Author: $author</h4>
				<h4>Genre: $genre</h4>
				<p class=\"button-msg\"><b>Find out more about this book by clicking <a href=\"$link\" target=\"_blank\">here</a>.</b></p><br>";
				echo "<form method=\"post\">
					<input type=\"submit\" class=\"button\" name=\"save\" value=\"$button\"/>
					<input type=\"submit\" class=\"button\" name=\"share\" value=\"Share\"/>
				</form>";
				if(isset($_POST["share"]))
				{
					// NOTE: change the link according to who's server is being used
					echo "<div class=\"button-msg\"><br>Copy the link below to share!</div>
					<div class=\"share-link\">www2.cs.uregina.ca/~tls665/BookExplorer/bookinfo.php?id=$book_id</div>";
				}
			echo"</div>";
		?>
		</div>
	</div>
</body>
</html>

<?php
}
// if the user is not logged in, just get book info over the URL
else if(isset($_GET['id']))
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

	<ul>
  		<li><a class="active" href="homepage.php">Home</a></li>
  		<!--<li><a href="profile.html">Profile</a></li>-->
  		<li><a href="contact.php">Contact</a></li>
  		<!--<li style="float:right"><button class="logout-button">Log out</button></li>-->
  		<li style="float:right"><a href="createAccount.php">Sign up</a></li>
  		<li style="float:right"><a href="login.php">Login</a></li>
	</ul>

	<div class="book-info-placement">
		<h2>Book Information</h2>

		<div class="book-grid">
		<!-- Code for displaying the book information-->
		<?php
			// if the user is not logged in, prompt them to log in to save a book
			echo "<div class=\"bookcover\"> <img src=\"$pic\" alt=\"HarryPotter\" width = \"90%\"> </div>";			
			echo "<div class=\"bookinfo\">";
				echo "<h3>$title</h3>
				<h4>Author: $author</h4>
				<h4>Genre: $genre</h4>
				<p class=\"button-msg\"><b>Find out more about this book by clicking <a href=\"$link\" target=\"_blank\">here</a>.</b></p><br>";
				echo "<form method=\"post\">
					<input type=\"submit\" class=\"button\" name=\"share\" value=\"Share\"/>";
					echo "<div class=\"button-msg\">Want to save this book to view later? Please
					<a href = \"login.php\">Login<a> or <a href=\"createAccount.php\">Create an account</a>.</div>";
				echo "</form>";

				if(isset($_POST["share"]))
				{
					// NOTE: change the link according to who's server is being used
					echo "<div class=\"button-msg\"><br>Copy the link below to share!</div>
					<div class=\"share-link\">www2.cs.uregina.ca/~tls665/BookExplorer/bookinfo.php?id=$book_id</div>";
				}
			echo"</div>";
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
