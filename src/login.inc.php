<?php

$ALLOW_ACCESS = in_array($_SERVER["REMOTE_ADDR"], Array("127.0.0.1", "::1"));
$ALLOW_ACCESS = true;

session_start();

if (!$ALLOW_ACCESS) {   // Access denied by client IP
	$TITLE   = "Access Denied :: $APP_NAME";
	$CONTENT = <<<EOF
<h3>Access denied.</h3>
<p>
	$APP_NAME may only be accessed locally. I'm sorry.
</p>
EOF;
	require_once("template.inc.php");
	die();
} elseif ( // User not logged in
	@empty($_SESSION["user"]) && @empty($_POST["token"])
) {
	// display login page
	$TITLE = "Login :: $APP_NAME";
	$CONTENT = <<<EOF
<h3>Login required</h3>
<form action="./" method="POST">
	<input type="hidden" name="token" value="asdf123">
	<table>
		<tbody>
			<tr>
				<td><label for="username">Username</label></td>
				<td><input type="text" name="username" required></td>
			</tr>
			<tr>
				<td><label for="password">Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><button type="submit">Login</button></td>
			</tr>
		</tbody>
	</table>
</form>
EOF;
	require_once("template.inc.php");
	die();
} elseif (!@empty($_POST["token"])) { // Try to login user
	$result = $db->query("SELECT * FROM users WHERE name = \"".$_POST["username"]."\" AND password IS NULL OR password = \"".sha1($_POST["password"])."\";");
	if ($user = $result->fetch_assoc()) { // Non-empty result
		$_SESSION["user"] = Array(
			"id"       => $user["id"],
			"username" => $user["name"],
			"realname" => $user["realname"],
			"is_admin" => $user["is_admin"] == 1
		);
		header("Location: ./");
		die();
	} else { // Login failed
		$TITLE = "Login failed! :: $APP_NAME";
		$CONTENT = <<<EOF
<h3>Login failed</h3>
<p>
	We're sorry, but your username and/or password was wrong.
</p>
<p>
	<a href="./"><button>Try again</button></a>
</p>
EOF;
	}
	require_once("template.inc.php");
	die();
}

?>
