<?php
session_start();

/* User object is created by the UserFactory */
class User {
	protected $row;
	
	public function __construct($row) 
	{
		$this->row = $row;
	}
	public function getId() 
	{
		return $this->row["user_id"];
	}
	public function getFirst() 
	{
		return $this->row["first_name"];
	}
	public function getLast() 
	{
		return $this->row["last_name"];
	}
	public function getEmail() 
	{
		return $this->row["email"];
	}
	public function getAvatar() 
	{
		return $this->row["pic"];
	}	
}

/* Book object is created by the BookFactory */
class Book {
	protected $row;
	
	public function __construct($row) 
	{
		$this->row = $row;
	}
	public function getTitle() 
	{
		return $this->row["title"];
	}
	public function getAuthor() 
	{
		return $this->row["author"];
	}
	public function getGenre() 
	{
		return $this->row["genre"];
	}
	public function getPic() 
	{
		return $this->row["pic"];
	}
	public function getLink() 
	{
		return $this->row["link"];
	}	
}

/* 
User Factory creates executes the query for retrieving user information. It stores the information
in the User object.
*/
class UserFactory {
	public function build($db)
	{	
		$username = $_SESSION["username"];
		// MySQL query for user information
		$q1 = "SELECT user_id, first_name, last_name, email, pic FROM Users WHERE username = '$username'";
		$r1 = $db->query($q1);
		$row = $r1->fetch_assoc();

		return new User($row);
	}
}

/* 
Book Factory extends the User Factory, and executes the query for retrieving user information. 
It stores the information in the Book object.
*/
class BookFactory extends UserFactory {
	public function build($db)
	{	
		$book_id = $_GET['id'];
		// MySQL query for book information
		$q1 = "SELECT title, author, genre, pic, link FROM Books WHERE book_id = '$book_id'";
		$r1 = $db->query($q1);
		$row = $r1->fetch_assoc();

		return new Book($row);
	}
}


/* Database object, can create new objects if using more than one database. */
class MySQLConnect
{
	public function setHost($host)
	{
		$this->host = $host;
	}
	public function setDB($dbname)
	{
		$this->dbname = $dbname;
	}
	public function setUserName($user)
	{
		$this->user = $user;
	}	
	public function setPassword($pwd)
	{
		$this->pwd = $pwd;  	
	}
	public function connect()
	{
		$db = new mysqli($this->host, $this->user, $this->pwd, $this->dbname);
		if ($db->connect_error) {
			die("Connection failed: " . $db->connect_error);
		}
		return $db;
	}
}

/*
DB Factory allows for extention of the number of databases used. 
For each database object, modify factory to call the specified 
database according to a 'driver' that could be provided.
*/
class DBFactory
{
		public function makeDB($host, $user, $pwd, $dbname)
		{
			$db = new MySQLConnect();

			$db->setHost($host);
			$db->setDB($dbname);
			$db->setUserName($user);
			$db->setPassword($pwd);
			$db->connect();

			return $db;
		}
}

?>
