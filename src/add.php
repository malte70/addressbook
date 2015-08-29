<?php
/**
 * Add an address
 * 
 * Copyright (c) 2015 Malte Bublitz, http://malte-bublitz.de
 * All rights reserved.
 */

require_once("config.inc.php");

if (@$_POST["do_add"] == "foo") {
	$stmt     = $db->prepare("INSERT INTO addresses VALUES (NULL, 1, ?, ?, ?, ?, NULL);");
	$stmt->bind_param("ssss", $_name, $_email, $_phone, $_address);
	$_name    = $_POST["name"];
	$_email   = $_POST["email"];
	$_phone   = $_POST["phone"];
	$_address = $_POST["address"];
	$stmt->execute();
	
	header("Location: ./");
	die();
}


?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Add :: Addressbook</title>
		<style>
			a:link, a:visited {
				color: #0074D9;
			}
		</style>
	</head>
	<body>
		<form action="add.php" method="POST">
			<label for="name">Name</label>
			<input type="text" name="name">
			<br>
			<label for="email">EMail</label>
			<input type="email" name="email">
			<br>
			<label for="phone">Phone</label>
			<input type="text" name="phone">
			<br>
			<label for="address">Address</label>
			<textarea name="address"></textarea>
			<br>
			<button type="submit">Add</button>
		</form>
	</body>
</html>
