<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['edit_account_users'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$ra = $_POST['username'];
		// remove a barra e o traço e deixa apenas os números
		$username = str_replace(array('/', '-'), '', $ra);
		$funcao = $_POST['funcao'];
		$email = $_POST['email'];
		$fone = $_POST['contactno'];
		$contactno = preg_replace('/[\s()-]+/', '', $fone);
		$cpf = $_POST['cpf'];
		$password = $_POST['password'];
		$conn->query("UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `username` = '$username', `funcao` = '$funcao', `email` = '$email', `contactno` = '$contactno', `cpf` = '$cpf', `password` = '$password' WHERE `users_id` = '$_REQUEST[users_id]'") or die(mysqli_error());
		$conn->query("INSERT INTO `activities` set mensagens_id = 6, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
		header("location:reservlab.php");
	}
?>	