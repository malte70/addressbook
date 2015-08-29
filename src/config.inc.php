<?php

/**
 * Generic application settings
 */
$APP_NAME      = "addressbook";
$APP_SITE      = "Malte's $APP_NAME";
$APP_VERSION   = "0.1";
$APP_URL       = "https://github.com/malte70/addressbook";
$APP_COPYRIGHT = "Copyright © 2015 Malte Bublitz";

/**
 * Database configuration
 */
$CONFIG = Array(
	"DBHost"     => "localhost",
	"DBUser"     => "addressbook",
	"DBPassword" => "foobar42",
	"DBDatabase" => "addressbook"
);

/**
 * Ignore login (for information-only subpages, needed
 * in the template)
 */
$IGNORE_LOGIN = false;

/**
 * Connect to database
 */
$db = new MySQLi(
	$CONFIG["DBHost"],
	$CONFIG["DBUser"],
	$CONFIG["DBPassword"],
	$CONFIG["DBDatabase"]
);


?>
