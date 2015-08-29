<?php
/**
 *
 * Copyright (c) 2015 Malte Bublitz, http://malte-bublitz.de
 * All rights reserved.
 *
 */

require_once("config.inc.php");
require_once("login.inc.php");

$id   = intval($_GET["id"]);
$uid  = intval($_SESSION["user"]["id"]);

$result = $db->query("SELECT * FROM addresses WHERE id=".$id." AND user_id = ".$uid);
$row = $result->fetch_assoc();
$a = Array(
	"id"      => $row["id"],
	"name"    => $row["name"],
	"email"   => $row["email"],
	"phone"   => $row["phone"],
	"address" => $row["address"],
	"notes"   => $row["notes"]
);
if (empty($a["name"]))
	$a["name"]    = "<i>(empty)</i>";
if (empty($a["email"]))
	$a["email"]   = "<i>(empty)</i>";
if (empty($a["phone"]))
	$a["phone"]   = "<i>(empty)</i>";
if (empty($a["address"]))
	$a["address"] = "<i>(empty)</i>";
if (empty($a["notes"]))
	$a["notes"]   = "<i>(empty)</i>";

$TITLE = "Viewing entry #".$id." :: ".$APP_NAME;
	
ob_start();
?>
			<h3>Viewing entry #<?=$id?></h3>
			<p>
				<a href="./">&laquo; Back</a>
			</p>
			<table border="1" class="view-table">
				<tbody>
					<tr>
						<th>ID</th>
						<td><?=$a["id"]?></td>
					</tr>
					<tr>
						<th>Name</th>
						<td><?=$a["name"]?></td>
					</tr>
					<tr>
						<th>EMail</th>
						<td><?=$a["email"]?></td>
					</tr>
					<tr>
						<th>Phone</th>
						<td><?=$a["phone"]?></td>
					</tr>
					<tr>
						<th>Address</th>
						<td><?=nl2br($a["address"])?></td>
					</tr>
					<tr>
						<th>Notes</th>
						<td><?=nl2br($a["notes"])?></td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<a href="edit.php?id=<?=$id?>"><button>Edit</button></a>
						</td>
					</tr>
				</tbody>
			</table>
<?php

$CONTENT = ob_get_clean();
require_once("template.inc.php");

?>
