<?php

session_start();
$_SESSION["user"] = NULL;
session_destroy();

header("Location: ./");

?>
