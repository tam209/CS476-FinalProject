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

CREATE TABLE Books (
book_id INT NOT NULL AUTO_INCREMENT,
title VARCHAR(100),
author VARCHAR(100),
genre VARCHAR(100),
pic VARCHAR(200),
link VARCHAR(200),
PRIMARY KEY(book_id) );


CREATE TABLE SavedBooks (
s_book_id INT NOT NULL AUTO_INCREMENT,
user_id INT,
book_id INT,
PRIMARY KEY(s_book_id),
FOREIGN KEY(user_id) REFERENCES Users(user_id),
FOREIGN KEY(book_id) REFERENCES Books(book_id) );