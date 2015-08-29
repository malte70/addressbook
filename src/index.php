<?php
/**
 * List all addresses
 * 
 * Copyright (c) 2015 Malte Bublitz, http://malte-bublitz.de
 * All rights reserved.
 */

require_once("config.inc.php");

$result = $db->query("SELECT * FROM addresses");

?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Addressbook</title>
		<style>
			a:link, a:visited {
				color: #0074D9;
			}
		</style>
	</head>
	<body>
		<p>
			<a href="add.php">Add a new address</a>
		</p>
		<table border="1">
			<thead>
				<tr>
					<th>Name</th>
					<th>EMail</th>
					<th>Phone</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
<?php
while ($address = $result->fetch_assoc()) {
	print "\t\t\t\t<tr>\n";
	print "\t\t\t\t\t<td>".$address["name"]."</td>\n";
	print "\t\t\t\t\t<td>".$address["email"]."</td>\n";
	print "\t\t\t\t\t<td>".$address["phone"]."</td>\n";
	print "\t\t\t\t\t<td><a href=\"view.php?id=".$address["id"]."\">View</a> :: <a href=\"edit.php?id=".$address["id"]."\">Edit</a></td>\n";
	print "\t\t\t\t</tr>\n";
}
?>
			</tbody>
		</table>
	</body>
</html>
