<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['add_account'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$status = $_POST['status'];
		$funcao = $_POST['funcao'];
		$email = $_POST['email'];
		$fone = $_POST['contactno'];
        $contactno = preg_replace('/[\s()-]+/', '', $fone);
		$cpf = $_POST['cpf'];
		$password = $_POST['password'];
		$query = $conn->query("SELECT email  FROM `users` WHERE `email` = '$email'") or die(mysqli_error());
		$valid = $query->num_rows;
		if($valid > 0){
			echo "<center><label style = 'color:red;'>Usuário já existe</label></center>";
		}else{
			$conn->query("INSERT INTO `users` (firstname, lastname, funcao, email, contactno, cpf, password, status) VALUES('$firstname', '$lastname', '$funcao', '$email','$contactno', '$cpf', '$password', '$status')") or die(mysqli_error());
			$conn->query("INSERT INTO `activities` set mensagens_id = 1, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
		}
	}
?>