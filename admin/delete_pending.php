<?php
	require_once 'connect.php';
	require_once 'validate.php';
	$conn->query("DELETE FROM `locacao` WHERE `locacao_id` = '$_REQUEST[locacao_id]'") or die(mysqli_error());
	$conn->query("INSERT INTO `activities` set mensagens_id = 8, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
	header('location:reservlab.php?penlab')
?>