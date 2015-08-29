<?php
/**
 *
 * Copyright (c) 2015 Malte Bublitz, http://malte-bublitz.de
 * All rights reserved.
 *
 */

require_once("config.inc.php");
require_once("login.inc.php");

if (@$_POST["do_edit"] == "foo") {
	if (!empty($_POST["name"])) {
		$a_id      = $_POST["id"];
		$a_name    = $_POST["name"];
		$a_email   = $_POST["email"];
		$a_phone   = $_POST["phone"];
		$a_address = $_POST["address"];
		$a_notes   = $_POST["notes"];
		
		$stmt      = $db->prepare("UPDATE addresses SET name=?, email=?, phone=?, address=?, notes=? WHERE id=?");
		$stmt->bind_param(
			"sssssi",
			$a_name,
			$a_email,
			$a_phone,
			$a_address,
			$a_notes,
			$a_id
		);
		$stmt->execute();
		
		header("Location: ./?edited=1");
		die();
	} else {
		die("Error!");
	}
} else {
	$id   = $_GET["id"];
	$result = $db->query("SELECT * FROM addresses WHERE id=".$id." AND user_id = 1;");
	$row = $result->fetch_assoc();
	$a = Array(
		"id"      => $row["id"],
		"name"    => $row["name"],
		"email"   => $row["email"],
		"phone"   => $row["phone"],
		"address" => $row["address"],
		"notes"   => $row["notes"]
	);

	$TITLE = "Edit entry #$id";
	
	ob_start();
?>
			<h3>Editing entry #<?=$id?></h3>
			<p>
				<a href="./">&laquo; Back</a>
			</p>
			<form action="edit.php" method="POST">
				<input type="hidden" name="do_edit" value="foo">
				<input type="hidden" name="id" value="<?=$a["id"]?>">
				<table>
					<tr>
						<td><label for="name">Name</label></td>
						<td><input type="text" name="name" value="<?=$a["name"]?>"></td>
					</tr>
					<tr>
						<td><label for="email">EMail</label></td>
						<td><input type="email" name="email" value="<?=$a["email"]?>"></td>
					</tr>
					<tr>
						<td><label for="phone">Phone</label></td>
						<td><input type="text" name="phone" value="<?=$a["phone"]?>"></td>
					</tr>
					<tr>
						<td><label for="address">Address</label></td>
						<td><textarea name="address" cols="80" rows="6"><?=$a["address"]?></textarea></td>
					</tr>
					<tr>
						<td><label for="address">Notes</label></td>
						<td><textarea name="notes" cols="80" rows="6"><?=$a["notes"]?></textarea></td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<a href="./"><button>Cancel</button></a>
							<button type="submit">Save</button>
						</td>
					</tr>
				</table>
			</form>
			<form action="delete.php" method="POST">
				<input type="hidden" name="id" value="<?=$a["id"]?>">
				<button type="submit" class="red">Delete</button>
			</form>
<?php
	$CONTENT = ob_get_clean();
	require_once("template.inc.php");
}
?>
