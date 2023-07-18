<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['edit_account_users'])){
		$firstname = ucwords(strtolower(trim($_POST['firstname'])));
		$lastname = ucwords(strtolower(trim($_POST['lastname'])));
		$status = $_POST['status'];
		$funcao = $_POST['funcao'];
		$email = trim($_POST['email']);
		$fone = $_POST['contactno'];
		$contactno = preg_replace('/[\s()-]+/', '', $fone);
		$identid = $_POST['cpf'];
		$cpf = str_replace(array('.', '-'), '', $identid);
		$password = $_POST['password'];

		// Gera um hash criptográfico da senha usando o algoritmo bcrypt
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		$conn->query("UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `status` = '$status', `funcao` = '$funcao', `email` = '$email', `contactno` = '$contactno', `cpf` = '$cpf', `password` = '$hashedPassword' WHERE `users_id` = '$_REQUEST[users_id]'") or die(mysqli_error($conn));
		$conn->query("INSERT INTO `activities` set mensagens_id = 6, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));
		header("location:reservlab.php?edituser");
	}
?>	