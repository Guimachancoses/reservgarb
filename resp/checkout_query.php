<?php
	require_once 'connect.php';
	require_once 'validate.php';
	$status_id = 4;
	$mensagens_id= 4;
	$conn->query("UPDATE `locacao` SET `status_id` = $status_id, `mensagens_id` = $mensagens_id WHERE `locacao_id` = '$_REQUEST[locacao_id]'") or die(mysqli_error());
	$conn->query("INSERT INTO `activities` set mensagens_id = 4, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
	header('location:reservlab.php?reslab')
?>