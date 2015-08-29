<?php
/**
 *
 * admin.php
 *
 * Copyright (c) 2015 Malte Bublitz, http://malte-bublitz.de
 * All rights reserved.
 *
 */

require_once("config.inc.php");
require_once("login.inc.php");

if (!$_SESSION["user"]["is_admin"]) {
	$TITLE   = "Access Denied";
	$CONTENT = <<<EOF
<h3>Access denied.</h3>
<p>
	You are not logged in as an admin.
</p>
EOF;
	require_once("template.inc.php");
	die();
} else {
	if (@$_GET["action"] == "add_user") { // Add user
		if (!empty($_POST["username"]) && !empty($_POST["realname"]) && $_POST["password1"] == $_POST["password2"]) {
			$stmt = $db->prepare("INSERT INTO users VALUES (NULL, ?, ?, ?, 0);");
			$stmt->bind_param("sss", $u_name, $u_realname, $u_password);
			$u_name     = $_POST["username"];
			$u_realname = $_POST["realname"];
			$u_password = sha1($_POST["password1"]);
			$stmt->execute();
			
			header("Location: ./admin.php?user_added=$u_name#useradmin");
			die();
		}
	} elseif (@$_GET["action"] == "delete_user") {
		$uid = $_GET["uid"];
		$stmt = $db->prepare("DELETE FROM users WHERE id = ?;");
		$stmt->bind_param("i", $uid);
		$stmt->execute();
		
		header("Location: ./admin.php?user_deleted=$uid#useradmin");
		die();
	} elseif (@$_GET["action"] == "user_makeadmin") {
		$uid = $_GET["uid"];
		$stmt = $db->prepare("UPDATE users SET is_admin = 1 WHERE id = ?;");
		$stmt->bind_param("i", $uid);
		$stmt->execute();
		
		header("Location: ./admin.php?user_made_admin=$uid#useradmin");
	} elseif (@$_GET["action"] == "user_makenonadmin") {
		$uid = $_GET["uid"];
		$stmt = $db->prepare("UPDATE users SET is_admin = 0 WHERE id = ?;");
		$stmt->bind_param("i", $uid);
		$stmt->execute();
		
		header("Location: ./admin.php?user_made_nonadmin=$uid#useradmin");
	} elseif (@$_GET["action"] == "edit_user") {
		$uid = intval($_GET["uid"]);

		$result = $db->query("SELECT * FROM users WHERE id = $uid");
		if (!$result)
			die("User not found.");
		$user = $result->fetch_assoc();

		$TITLE = "Edit $user[name] :: Administration";
		ob_start();
		
		print "				<p>\n";
		print "					<a href=\"./admin.php\">&laquo; Back</a>\n";
		print "				</p>\n";
		print "				<h2>Administration</h2>\n";
		print "				<h3>Edit user #$user[id]</h3>\n";
		print "				<form method=\"POST\">\n";
		print "				<table>\n";
		print "					<tr>\n";
		print "						<td><label for=\"id\">#ID</label></td>\n";
		print "						<td><input type=\"text\" name=\"id\" value=\"$user[id]\" readonly></td>\n";
		print "					</tr>\n";
		print "					<tr>\n";
		print "						<td><label for=\"name\">Name</label></td>\n";
		print "						<td><input type=\"text\" name=\"name\" value=\"$user[name]\" readonly></td>\n";
		print "					</tr>\n";
		print "					<tr>\n";
		print "						<td><label for=\"realname\">Real name</label></td>\n";
		print "						<td><input type=\"text\" name=\"realname\" value=\"$user[realname]\"></td>\n";
		print "					</tr>\n";
		print "					<tr>\n";
		print "						<td><label for=\"password1\">Password <em>(Leave blank to keep current one)</em></label></td>\n";
		print "						<td><input type=\"password\" name=\"password1\"></td>\n";
		print "					</tr>\n";
		print "					<tr>\n";
		print "						<td><label for=\"password2\">Password (repeat)</label></td>\n";
		print "						<td><input type=\"password\" name=\"password2\"></td>\n";
		print "					</tr>\n";
		print "					<tr>\n";
		print "						<td><label for=\"is_admin\">Admin?</label></td>\n";
		print "						<td><input type=\"checkbox\" name=\"is_admin\"".($user["is_admin"]==1?" checked":"")."></td>\n";
		print "					</tr>\n";
		print "					<tr>\n";
		print "						<td colspan=\"2\">\n";
		print "							<button type=\"submit\">Save changes...</button>\n";
		print "						</td>\n";
		print "					</tr>\n";
		print "				</table>\n";

		$CONTENT = ob_get_clean();
		
		require_once("template.inc.php");
	} else {
		$TITLE    = "Administration";
		$CONTENT  = "			<h2>Administration</h2>\n";
		$MSG_USER = "";
		if (!empty(@$_GET["user_added"])) {
			$MSG_USER = "Added user <tt>".$_GET["user_added"]."</tt>";
		} elseif (!empty(@$_GET["user_deleted"])) {
			$MSG_USER = "Deleted user #".$_GET["user_deleted"];
		} elseif (!empty(@$_GET["user_made_admin"])) {
			$MSG_USER = "Made user #".$_GET["user_made_admin"]." admin";
		} elseif (!empty(@$_GET["user_made_nonadmin"])) {
			$MSG_USER = "Removed admin privileges from user #".$_GET["user_made_nonadmin"];
		}
		
		$CONTENT .= <<<EOF
			<section id="info">
				<h3>Info</h3>
				<p>
					Site name: $APP_SITE<br>
					Application: $APP_NAME $APP_VERSION<br>
					Application's website: <a href="$APP_URL">$APP_URL</a><br>
					License: 2-clause BSD license - <a href="about.php#license">Details/license text</a><br>
					Database: MySQL server on $CONFIG[DBHost], user $CONFIG[DBUser], database $CONFIG[DBDatabase]
				</p>
			</section>
			<section id="useradmin">
				<h3>User administration</h3>

EOF;
		if (!empty($MSG_USER))
			$CONTENT .= "			<p><em>$MSG_USER</em></p>\n";
		$CONTENT .= <<<EOF
				<fieldset>
					<legend>Add a user</legend>
					<form action="admin.php?action=add_user" method="POST">
						<table>
							<tr>
								<td><label for="username">Username</label></td>
								<td><input type="text" name="username"></td>
							</tr>
							<tr>
								<td><label for="realname">Real name</label></td>
								<td><input type="text" name="realname"></td>
							</tr>
							<tr>
								<td><label for="password1">Password</label></td>
								<td><input type="password" name="password1"></td>
							</tr>
							<tr>
								<td><label for="password2">Password (repeat)</label></td>
								<td><input type="password" name="password2"></td>
							</tr>
							<tr>
								<td colspan="2">
									<button type="submit">Add user</button>
								</td>
							</tr>
						</table>
					</form>
				</fieldset>
				<fieldset>
					<legend>User list</legend>
					<table border="1">
						<thead>
							<tr>
								<th>#ID</th>
								<th>Name</th>
								<th>Real name</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>

EOF;
		$result = $db->query("SELECT * FROM users");
		ob_start();
		while ($row = $result->fetch_assoc()) {
			print "\t\t\t\t\t\t\t<tr>\n";
			print "\t\t\t\t\t\t\t\t<td>".$row["id"]."</td>\n";
			print "\t\t\t\t\t\t\t\t<td>".$row["name"]."</td>\n";
			print "\t\t\t\t\t\t\t\t<td>".$row["realname"]."</td>\n";
			print "\t\t\t\t\t\t\t\t<td><a href=\"admin.php?action=edit_user&uid=$row[id]\">Edit</a></td>\n";
			print "\t\t\t\t\t\t\t</tr>\n";
		}
		$CONTENT .= ob_get_clean();
		$CONTENT .= <<<EOF
						</tbody>
					</table>
				</fieldset>
			</section>

EOF;
		require_once("template.inc.php");
	}
}
?>
