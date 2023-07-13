<?php
	require_once 'connect.php';
	require_once 'validate.php';
	$conn->query("DELETE FROM `equipment` WHERE `equip_id` = '$_REQUEST[equip_id]'") or die(mysqli_error());
	$conn->query("INSERT INTO `activities` set mensagens_id = 33, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
	header("location:reservlab.php?editequip");
?>