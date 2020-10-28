<?php
session_start();

if (isset($_SESSION["username"]))
{
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

	<ul>
  		<li><a class="active" href="#home">Home</a></li>
  		<li><a href="profile.php">Profile</a></li>
  		<li><a href="contact.html">Contact</a></li>
  		<li style="float:right"><!--<button class="logout-button" action="logout.php">Log out</button>--><a href="logout.php"> Log out</a></li>
	</ul>

	<div class="grid-container">
		<div class="empty">  </div> <!-- this is here to create the space between the search bar and the nav bar --> 
		<div class="inner-search-row">  
			<div class="empty"></div>   <!-- this is here to create space and try to center the search box --> 
			<div class="search">
				<form class="search-field">
  					<input type="text" placeholder="Search.." name="search">
  					<input type="submit" value="Search">
				</form>
			</div>
		</div>
	    

		<div class="inner-grid-container"> 
			<div class="item1"> 
			<h3 class="book-listing-spacing">Title1  <br></h3>
			<h4 class="book-listing-spacing">Author <br></h4>
			<img class="book-listing-spacing" src="harrypotter.jpg" alt="HarryPotter" style="width:100px"> <br>
			<a class="book-listing-spacing" href="bookinfo.html"> More Info </a><br>
			</div>
			<div class="item2"> Book2 </div>
			<div class="item3"> Book3 </div>
			<div class="item4"> Book4 </div>
			<div class="item5"> Book5 </div>
		</div> 
	</div>

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
	<title>BookExplorer: Search & Save Books</title>
	<link rel="stylesheet" type="text/css" href="WebApp.css" />

	<meta charset="UTF-8">

</head>

<body>
	<div class="header-img">
		<h1> BookExplorer </h1>
	</div>

	<ul>
  		<li><a class="active" href="#home">Home</a></li>
  		<!--<li><a href="profile.html">Profile</a></li>-->
  		<li><a href="contact.php">Contact</a></li>
  		<!--<li style="float:right"><button class="logout-button">Log out</button></li>-->
  		<li style="float:right"><a href="createAccount.php">Sign up</a></li>
  		<li style="float:right"><a href="login.php">Login</a></li>
	</ul>

	<div class="grid-container">
		<div class="empty">  </div> <!-- this is here to create the space between the search bar and the nav bar --> 
		<div class="inner-search-row">  
			<div class="empty"></div>   <!-- this is here to create space and try to center the search box --> 
			<div class="search">
				<form class="search-field">
  					<input type="text" placeholder="Search.." name="search">
  					<input type="submit" value="Search">
				</form>
			</div>
		</div>
	    

		<div class="inner-grid-container"> 
			<div class="item1"> 
			<h3 class="book-listing-spacing">Title1  <br></h3>
			<h4 class="book-listing-spacing">Author <br></h4>
			<img class="book-listing-spacing" src="harrypotter.jpg" alt="HarryPotter" style="width:100px"> <br>
			<a class="book-listing-spacing" href="bookinfo.html"> More Info </a><br>
			</div>
			<div class="item2"> Book2 </div>
			<div class="item3"> Book3 </div>
			<div class="item4"> Book4 </div>
			<div class="item5"> Book5 </div>
		</div> 
	</div>

</body>

</html>

<?php
}
?>
