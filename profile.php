<?php
session_start();

require 'factory.php';

// Check if the session variable is still set, otherwise print error message
if (isset($_SESSION["username"]))
{
	$username = $_SESSION["username"];
	$validate = false;

	// Implement the DB factory method
	$factory = DBFactory::makeDB("localhost", "ADD MySQL Database Here", "Add MySQL Password Here", "ADD MySQL Username Here");
	$db = $factory->connect();

	//Implement the User factory method
	$user = QueryFactory::build($db, "User");
	$user->setUser();


	$user_id = $user->getId();
	$fname = $user->getFirst();
	$lname = $user->getLast();
	$email = $user->getEmail();
	$avatar = $user->getAvatar();

	// Retrieve user's saved books
	$q2 = "SELECT Books.book_id, Books.title, Books.author, Books.pic 
		FROM Books RIGHT JOIN SavedBooks ON Books.book_id = SavedBooks.book_id
		LEFT JOIN Users ON SavedBooks.user_id = Users.user_id
		WHERE Users.user_id = '$user_id'
		ORDER BY Books.title ASC";
	$r2 = $db->query($q2);	

	// get all the book_id's and check if one of them was pressed
	$q3 = "Select book_id FROM SavedBooks WHERE user_id = '$user_id'";
	$r3 = $db->query($q3);
	while($row3 = $r3->fetch_object())
	{
		// if the book matching the book_id is the one that is supposed to be removed
		if(isset($_POST["$row3->book_id"]))
		{
			$q4 = "DELETE FROM SavedBooks WHERE book_id = '$row3->book_id'";
			$r4 = $db->query($q4);
			$validate = true;	
			break;
		}
	}
	$r3 -> free_result();
	
	
	if($validate == true)
	{
		header("Location: profile.php");
		exit();
	}
	
	$db->close();

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
			<img src="<?php echo $avatar; ?>" alt="User's Avatar" style="width:200px">
			
		</div>
		<div class="user-info">
			<!-- using php to output the users information -->
			<?php
			echo "<h3> Welcome, ".$username."! </h3>
			<p3>".$fname." ".$lname."</p3> <br>
			<p3>".$email."</p3><br>";
			?>
		</div>
	</div>

	<h2 class="Saved-books-header"> Your Saved Books </h2>

	<div class="inner-grid-container"> 			
		<!-- The following code will display book results -->
		<?php 
		while($row2 = $r2->fetch_object())
		{	
			// Decreased the size of the title and author to avoid results overlapping
			echo "<div class=\"book-search-result\">
				<h4 class=\"book-listing-spacing\">$row2->title<br></h4>
				<h5 class=\"book-listing-spacing\">$row2->author<br></h5>
				<a href=\"bookinfo.php?id=$row2->book_id\"><img class=\"book-listing-spacing\" src=\"$row2->pic\" alt=\"$row2->title\" style=\"width:80px\"></a><br>
				<a class=\"book-listing-spacing\" href=\"bookinfo.php?id=$row2->book_id\"> More Info </a><br>";
			echo "<form method=\"post\">
				<input type=\"submit\" class=\"remove-button\" name=\"$row2->book_id\" value=\"Remove Book\"/>
			</form>";
			echo "</div>";
		}
		$r2 -> free_result();
		
		?>

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
