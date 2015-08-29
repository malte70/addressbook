<?php
/**
 *
 * Copyright (c) 2015 Malte Bublitz, http://malte-bublitz.de
 * All rights reserved.
 *
 */

require_once("config.inc.php");
require_once("login.inc.php");

if ($_SESSION["user"]["is_admin"]) {
	$result = $db->query("SELECT * FROM addresses ORDER BY name;");
} else {
	$uid    = intval($_SESSION["user"]["id"]);
	$result = $db->query("SELECT * FROM addresses WHERE user_id = $uid ORDER BY name;");
}

$TITLE = "Home";

ob_start();
if (@$_GET["edited"] == 1) {
	print "			<p><em>Saved all changes.</em></p>\n";
} elseif (@$_GET["added"] == 1) {
	print "			<p><em>Added the new entry.</em></p>\n";
} elseif (@$_GET["deleted"] == 1) {
	print "			<p><em>Entry successfully removed.</em></p>\n";
}
	print "			<p><a href=\"add.php\">Add an address</a></p>\n";
	print "			<table border=\"1\" width=\"1ßß%\">\n";
	print "				<thead>\n";
	print "					<tr>\n";
	print "						<th>Name</th>\n";
	print "						<th>EMail</th>\n";
	print "						<th>Phone</th>\n";
	print "						<th>Actions</th>\n";
	print "					</tr>\n";
	print "				</thead>\n";
	print "				<tbody>\n";

while ($address = $result->fetch_assoc()) {
	$_id = $address["id"];
	$_name = $address["name"];
	if (empty($_name))
		$_name = "<i>(empty)</i>";
	$_email = $address["email"];
	if (empty($_email))
		$_email = "<i>(empty)</i>";
	$_phone = $address["phone"];
	if (empty($_phone))
		$_phone = "<i>(empty)</i>";
	$_address = $address["address"];
	if (empty($_address))
		$_address = "<i>(empty)</i>";
	
	print "					<tr>\n";
	print "						<td>$_name</td>\n";
	print "						<td>".$_email."</td>\n";
	print "						<td>".$_phone."</td>\n";
	print "						<td>\n";
	print "							<a href=\"view.php?id=".$address["id"]."\">View</a>";
	if ($_SESSION["user"]["is_admin"]) {
		print " :: \n";
		print "							<a href=\"edit.php?id=$_id\">Edit</a>\n";
	}
	print "						</td>\n";
	print "					</tr>\n";
}

print "				</tbody>\n";
print "			</table>\n";

$CONTENT = ob_get_clean();
require_once("template.inc.php");

?>
