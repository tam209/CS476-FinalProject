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
  		<li><a href="homepage.html">Home</a></li>
  		<li><a class="active" href="profile.html">Profile</a></li>
  		<li><a href="contact.html">Contact</a></li>
		<li style="float:right"><button class="logout-button">Log out</button></li>
	</ul>

	<div class="profile-info">
  		<div class="user-avatar"> 
  			<br> <!-- using <br> to give the space between nav bar and the image -->
			<img src="sunflower.jpg" alt="sunflower" style="width:200px">
		</div>
		<div class="user-info">
			<h3> Welcome, username! </h3>
			<p3> User's first name and last name</p3> <br>
			<p3> User's email</p3> <br>
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
