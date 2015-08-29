--
-- Database Layout
--

-- Database

CREATE DATABASE addressbook DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
USE addressbook;

-- User
CREATE USER addressbook@localhost;
GRANT ALL PRIVILEGES ON addressbook.* TO addressbook@localhost IDENTIFIED BY "foobar42";

-- User accounts
CREATE TABLE users (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	realname VARCHAR(150) DEFAULT NULL,
	password VARCHAR(150) DEFAULT NULL,
	is_admin INT(1) DEFAULT 0
);

-- Only one user at the moment since user management is not implemented yet.
INSERT INTO users VALUES (
	1,
	"user",
	"The User",
	NULL,
	1
);

-- Address list table
CREATE TABLE addresses (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id INT NOT NULL,
	name VARCHAR(200) DEFAULT NULL,
	email VARCHAR(250) DEFAULT NULL,
	phone VARCHAR(50) DEFAULT NULL,
	address TEXT DEFAULT NULL,
	notes TEXT DEFAULT NULL
);

-- An example entry
INSERT INTO addresses (
	user_id,
	name,
	email,
	phone,
	address
) VALUES (
	1,
	"Malte Bublitz",
	"malte70@mcbx.de",
	"+49 (0) 123 / 666 42 666",
	"Linux-Str. 42\n12345 Unix Town"
);

