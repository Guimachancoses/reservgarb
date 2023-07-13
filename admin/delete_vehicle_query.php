<?php
	require_once 'connect.php';
	require_once 'validate.php';
	$conn->query("DELETE FROM `vehicles` WHERE `vehicle_id` = '$_REQUEST[vehicle_id]'") or die(mysqli_error());
	$conn->query("INSERT INTO `activities` set mensagens_id = 31, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
	header("location:reservlab.php?vehicles");
?>