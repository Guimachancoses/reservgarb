<?php
	// Função responsável por adicionar um novo usuário
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['add_account'])){
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

		$query = $conn->query("SELECT email  FROM `users` WHERE `email` = '$email'") or die(mysqli_error($conn));
		$valid = $query->num_rows;
		if($valid > 0){
			echo "<center><label style = 'color:red;'>Usuário já existe</label></center>";
		}else{
			$conn->query("INSERT INTO `users` (firstname, lastname, funcao, email, contactno, cpf, password, status) VALUES('$firstname', '$lastname', '$funcao', '$email','$contactno', '$cpf', '$hashedPassword', '$status')") or die(mysqli_error());
			$conn->query("INSERT INTO `activities` set mensagens_id = 1, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));
			echo "<script>window.location.href = 'reservlab.php?edituser';</script>";
		}
	}
?>