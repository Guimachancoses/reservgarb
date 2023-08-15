<?php
	require_once 'connect.php';
	require_once 'validate.php';
	$conn->query("DELETE FROM `chamados` WHERE `chamado_id` = '$_REQUEST[chamado_id]'") or die(mysqli_error());
	$conn->query("INSERT INTO `activities` set mensagens_id = 25, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
	header('location:reservlab.php?listcall')
?>