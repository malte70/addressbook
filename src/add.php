<?php
/**
 *
 * Copyright (c) 2015 Malte Bublitz, http://malte-bublitz.de
 * All rights reserved.
 *
 */

require_once("config.inc.php");
require_once("login.inc.php");

if (@$_POST["do_add"] == "foo") {
	if (!empty($_POST["name"])) {
		$stmt      = $db->prepare("INSERT INTO addresses VALUES (NULL, 1, ?, ?, ?, ?, NULL);");
		$stmt->bind_param("ssss", $a_name, $a_email, $a_phone, $a_address);
		$a_name    = $_POST["name"];
		$a_email   = $_POST["email"];
		$a_phone   = $_POST["phone"];
		$a_address = $_POST["address"];
		$stmt->execute();
		
		header("Location: ./?added=1");
		die();
	} else {
		die("Error!");
	}
} else {
	$TITLE = "Add a new entry";
	$CONTENT = <<<EOF
			<h3>Creating a new entry</h3>
			<p>
				<a href="./">&laquo; Back</a>
			</p>
			<form action="add.php" method="POST">
				<input type="hidden" name="do_add" value="foo">
				<table>
					<tr>
						<td><label for="name">Name</label></td>
						<td><input type="text" name="name"></td>
					</tr>
					<tr>
						<td><label for="email">EMail</label></td>
						<td><input type="email" name="email"></td>
					</tr>
					<tr>
						<td><label for="phone">Phone</label></td>
						<td><input type="text" name="phone"></td>
					</tr>
					<tr>
						<td><label for="address">Address</label></td>
						<td><textarea name="address" cols="80" rows="6"></textarea></td>
					</tr>
					<tr>
						<td colspan="2">
							<button type="submit">Add address</button>
						</td>
					</tr>
				</table>
			</form>
EOF;
	require_once("template.inc.php");
}
?>
