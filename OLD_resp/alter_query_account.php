<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['alter_query_account'])){
		// $email = $_POST['email'];
		$fone = $_POST['contactno'];
        $contactno = preg_replace('/[\s()-]+/', '', $fone);
		$password = trim($_POST['password']);

		// Gera um hash criptográfico da senha usando o algoritmo bcrypt
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		// $query = $conn->query("SELECT email FROM `users` WHERE `email` = '$email'") or die(mysqli_error($conn));
		// $valid = $query->num_rows;
		// if($valid > 0){
		// 	echo "<script>alert('Nenhuma alteração foi realizada!'); window.location.href = 'reservlab.php';</script>";
		// }else{
			$conn->query("UPDATE `users` SET `contactno` = '$contactno', `password` = '$hashedPassword' WHERE `users_id` = '$_REQUEST[users_id]'") or die(mysqli_error($conn));
			$conn->query("INSERT INTO `activities` set mensagens_id = 28, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));
			echo "<script>alert('Seus dados foram alterados com sucesso!'); window.location.href = 'reservlab.php';</script>";
		// }
	}


?>