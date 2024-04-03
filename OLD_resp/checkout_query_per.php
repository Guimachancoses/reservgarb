<?php
	require_once 'connect.php';
	require_once 'validate.php';
	$status_id = 4;
	$mensagens_id= 4;
	$conn->query("UPDATE `locacao` SET `status_id` = $status_id, `mensagens_id` = $mensagens_id WHERE `lc_period_id` = '$_REQUEST[lc_period_id]'") or die(mysqli_error($conn));
	$conn->query("UPDATE `lc_period` SET `mensagens_id` = $mensagens_id WHERE `lc_period_id` = '$_REQUEST[lc_period_id]'") or die(mysqli_error($conn));
	$conn->query("INSERT INTO `activities` set mensagens_id = 4, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));
	header('location:reservlab.php?perres')
?>