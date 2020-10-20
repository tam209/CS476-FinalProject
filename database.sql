/* Code for the database tables used in the BookExplorer Application
Written October 15, 2020
*/

-- Creating tables
CREATE TABLE Users (
user_id INT NOT NULL AUTO_INCREMENT,
first_name VARCHAR(100),
last_name VARCHAR(100), 
email VARCHAR(100),
username VARCHAR(100),
password VARCHAR(100),
dob DATE,
pic VARCHAR(200),
PRIMARY KEY(user_id) );

CREATE TABLE SavedBooks (
book_id INT NOT NULL AUTO_INCREMENT, 
user_id INT,
title VARCHAR(100),
author VARCHAR(100),
genre VARCHAR(100), 
book_link VARCHAR(200),
PRIMARY KEY(book_id), 
FOREIGN KEY (user_id) REFERENCES Users(user_id) );

/* 
The following code is just for reference and may be used within the other files later

-- Insert a book into saved books
INSERT INTO SavedBooks
(user_id, title, author, genre, book_link)
VALUES
(1, "Harry Potter", "Author name", "genre type", "https://www.goodreads.com/"); // example values


Some others:
- Retrieve matching books given a title or author or genre
- Retrieve user from database 
*/
