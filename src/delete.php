<?php
/**
 *
 * Copyright (c) 2015 Malte Bublitz, http://malte-bublitz.de
 * All rights reserved.
 *
 */

require_once("config.inc.php");
require_once("login.inc.php");

$id = @$_POST["id"];

if ($id > 0) {
	$db->query("DELETE FROM addresses WHERE id=$id AND user_id = 1;");
	header("Location: ./?deleted=1");
} else {
		die("Error!");
}
?>
