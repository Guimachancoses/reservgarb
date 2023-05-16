<?php
	require_once 'connect.php';
	if(ISSET($_POST['alter_account'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$fone = $_POST['contactno'];
        $contactno = preg_replace('/[\s()-]+/', '', $fone);
		$password = $_POST['password'];
		$query = $conn->query("SELECT users.username  FROM `users` WHERE `username` = '$username'") or die(mysqli_error());
		$valid = $query->num_rows;
		if($valid > 0){
			echo "<center><label style = 'color:red;'>Usuário já existe</label></center>";
		}else{
			$conn->query("UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `email` = '$email', `contactno` = '$contactno', `password` = '$password' WHERE `users_id` = '$_REQUEST[users_id]'") or die(mysqli_error());
			$conn->query('INSERT INTO `activities` set mensagens_id = 6') or die(mysqli_error());
		}
	}


?>