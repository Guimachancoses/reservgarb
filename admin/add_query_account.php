<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['add_account'])){
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
		$query = $conn->query("SELECT users.username  FROM `users` WHERE `username` = '$username'") or die(mysqli_error());
		$valid = $query->num_rows;
		if($valid > 0){
			echo "<center><label style = 'color:red;'>Usuário já existe</label></center>";
		}else{
			$conn->query("INSERT INTO `users` (firstname, lastname, username, funcao, email, contactno, cpf, password) VALUES('$firstname', '$lastname', '$username', '$funcao', '$email','$contactno', '$cpf', '$password')") or die(mysqli_error());
			$conn->query("INSERT INTO `activities` set mensagens_id = 1, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
		}
	}
?>