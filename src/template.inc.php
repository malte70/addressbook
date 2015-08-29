<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?=(!empty($TITLE)?$TITLE." :: ":"").$APP_SITE?></title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body id="top">
		<header>
			<h1><a href="./"><?=$APP_SITE?></a></h1>
		</header>
		<main>
<?=$CONTENT?>
		</main>
		<footer>
<?php
if (!$IGNORE_LOGIN) {
	if ($ALLOW_ACCESS && is_array(@$_SESSION["user"])) {
		$USER = $_SESSION["user"]["username"];
?>
			<p>
				Logged in as <?=$USER?> ::<?php
				if ($_SESSION["user"]["is_admin"]) print ' <a href="./admin.php">Admin</a> ::';
?> <a href="logout.php">Log out</a>
			</p>
<?php
	}
}
?>
			<p>
				<a href="./about.php"><?=$APP_NAME?></a> ::
				<?=$APP_COPYRIGHT?>
			</p>
		</footer>
	</body>
</html>
