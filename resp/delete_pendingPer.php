<?php
	require_once 'connect.php';
	require_once 'validate.php';
	$conn->query("DELETE FROM `locacao` WHERE `lc_period_id` = '$_REQUEST[lc_period_id]'") or die(mysqli_error($conn));
	$conn->query("DELETE FROM `lc_period` WHERE `lc_period_id` = '$_REQUEST[lc_period_id]'") or die(mysqli_error($conn));
	$conn->query("INSERT INTO `activities` set mensagens_id = 8, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));
	header('location:reservlab.php?perpen')
?>