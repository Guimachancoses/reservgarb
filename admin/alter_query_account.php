<?php
// Função responsável por alterar as informações do usuario da sessão
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['alter_query_account'])){
		$firstname = ucwords(strtolower(trim($_POST['firstname'])));
		$lastname = ucwords(strtolower(trim($_POST['lastname'])));
		$email = trim($_POST['email']);
		$fone = $_POST['contactno'];
		$identid = $_POST['cpf'];
		$cpf = str_replace(array('.', '-'), '', $identid);
		$contactno = preg_replace('/[\s()-]+/', '', $fone);
		$password = trim($_POST['password']);

		// Gera um hash criptográfico da senha usando o algoritmo bcrypt
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		$conn->query("UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `email` = '$email', `contactno` = '$contactno', `cpf` = '$cpf', `password` = '$hashedPassword' WHERE `users_id` = '$_SESSION[users_id]'") or die(mysqli_error($conn));
		$conn->query("INSERT INTO `activities` set mensagens_id = 28, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));
		echo "<script>alert('Seus dados foram alterados com sucesso!'); window.location.href = 'reservlab.php';</script>";
	}
	
?>