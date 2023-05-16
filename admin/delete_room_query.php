<?php
	require_once 'connect.php';
	require_once 'validate.php';
	$conn->query("DELETE FROM `laboratorios` WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysqli_error());
	$conn->query("INSERT INTO `activities` set mensagens_id = 10, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
	header("location:reservlab.php");
?>