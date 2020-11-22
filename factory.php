<?php
session_start();

/* 
User object executes query to retrieve user information.
The user information is stored in an associative array 'row'.
*/
class User {
	protected $row;
	protected $db;
	
	public function __construct($db) 
	{
		$this->db = $db;
	}
	public function setUser()
	{
		$username = $_SESSION["username"];
		// MySQL query for user information
		$q1 = "SELECT user_id, first_name, last_name, email, pic FROM Users WHERE username = '$username'";
		$r1 = $this->db->query($q1);
		$this->row = $r1->fetch_assoc();
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

/* 
Book object executes query to retrieve book information.
The book information is stored in an associative array 'row'.
 */
class Book {
	protected $row;
	protected $db;
	
	public function __construct($db) 
	{
		$this->db = $db;
	}
	public function setBook()
	{
		$book_id = $_GET['id'];
		// MySQL query for book information
		$q1 = "SELECT title, author, genre, pic, link FROM Books WHERE book_id = '$book_id'";
		$r1 = $this->db->query($q1);
		$this->row = $r1->fetch_assoc();
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
User Factory creates the User object.
*/
class QueryFactory {
	public function build($db, $class)
	{
		return new $class($db);
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
